<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transportador;
use App\Models\Cotacao;
use App\Models\User;
use App\Services\ErpNomus\ErpNomusService;

class CotacaoController extends Controller
{
    public function list(Request $request)
    {
        $cotacoes = Cotacao::with('transportador')->get();
        $transportadores = Transportador::get();

        return view('cotacoes.list', ['cotacoes' => $cotacoes, 'transportadores' => $transportadores]);
    }

    public function create(Request $request)
    {
        $pedido = $request->request->filter('pedido');



        if ($pedido == '') {
            return view('cotacoes.create');
        } else {
            //GET Pedido de Vendas - API Nomus

            $servicePedidos = new ErpNomusService();
            $return = $servicePedidos
                ->pedidos()
                ->get($pedido);
            $json = $return->json();



            if (isset($json[0]))  # Caso o Request tenha um retorno válido
            {
                # Informações do Pedido

                $dadosPedido = $json[0];
                $codigoPedido = $json[0]['codigoPedido'];
                $dataEmissao = $json[0]['dataEmissao'];
                $idPessoaCliente = $json[0]['idPessoaCliente'];
                $idPessoaVendedor = $json[0]['idPessoaVendedor'];
                $dateFormat = \DateTime::createFromFormat('d/m/Y', $dataEmissao);
                $dataPedido = $dateFormat->format('Y-m-d');

                # -------------------------------------------------------------------------------

                #Informações do Cliente

                $serviceClientes = new ErpNomusService();
                $return = $serviceClientes
                    ->clientes()
                    ->get($idPessoaCliente);
                $clientePedido = $return->json();

                $nomePessoa = $clientePedido['razaoSocial'];
                $ufPessoa = $clientePedido['uf'];
                $grupoPessoa = $clientePedido['grupoPessoa'];

                if (isset($clientePedido['cnpj'])) {
                    $cpf_cnpj = $clientePedido['cnpj'];
                } else {
                    $cpf_cnpj = $clientePedido['cpf'];
                }

                # -------------------------------------------------------------------------------

                # Informações do Vendedor

                $serviceVendedor = new ErpNomusService();
                $return = $serviceVendedor
                    ->pessoas()
                    ->get($idPessoaVendedor);
                $vendedorPedido = $return->json();

                $vendedor = $vendedorPedido['nome'];

                # Informações do Representante


                if (isset($dadosPedido['idPessoaRepresentante'])) {
                    $idPessoaRepresentante = $dadosPedido['idPessoaRepresentante'];
                    $serviceRepresentante = new ErpNomusService();
                    $return = $serviceRepresentante
                        ->pessoas()
                        ->get($idPessoaRepresentante);
                    $representantePedido = $return->json();
                    $representante = $representantePedido['nome'];
                }else{
                    $representante = '';
                }

                dump($representante);


                # Retorno da Função

                return view('cotacoes.create', [
                    'codigoPedido' => $codigoPedido,
                    'dataPedido' => $dataPedido,
                    'idPessoaCliente' => $idPessoaCliente,
                    'idPessoaVendedor' => $idPessoaVendedor,
                    'nomePessoa' => $nomePessoa,
                    'cpf_cnpj' => $cpf_cnpj,
                    'ufPessoa' => $ufPessoa,
                    'vendedor' => $vendedor,
                    'representante' => $representante,

                ]);
            } else # Caso o Request tenha um retorno nulo
            {
                return view('cotacoes.create');
            }


            //-----------------------------------------------------


        }
    }

    public function store()
    {

    }
}
