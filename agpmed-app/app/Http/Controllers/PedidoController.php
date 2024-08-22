<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Services\ErpNomus\ErpNomusService;
use Illuminate\Http\Request;
use LaraDumps\LaraDumps\Livewire\Attributes\Ds;
use PhpParser\Node\Stmt\TryCatch;
use Spatie\LaravelIgnition\Recorders\DumpRecorder\Dump;

use function Pest\Laravel\get;

class PedidoController extends Controller
{
    public function list(Request $request)
    {
       $pedidos = Pedido::when($request->has('cliente'), function($whenQuery) use ($request){
            $whenQuery->where('nomecliente', 'like', '%' . $request->cliente . '%');
       })
       ->paginate(3)
       ->withQueryString();
       return view('pedidos.list', [
        'pedidos' => $pedidos,
        'cliente' => $request->cliente

    ]);
    }

    public function create(Request $request)
    {
        $pedido = $request->request->filter('pedido');

        if ($pedido == '') {
            return view('pedidos.create');
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
                $parcelas = $json[0]['parcelas'];
                $totalPedido = 0;
                foreach ($parcelas as $parcela) {
                    $valor = (str_replace('.', '', $parcela['valorParcela']));
                    $valorFinal = floatval(str_replace(',', '.', $valor));
                    $totalPedido += $valorFinal;
                };
                $valorTotalPedido = $totalPedido;
                # -------------------------------------------------------------------------------

                #Informações do Cliente

                $serviceClientes = new ErpNomusService();
                $return = $serviceClientes
                    ->clientes()
                    ->get($idPessoaCliente);
                $clientePedido = $return->json();

                $nomePessoa = $clientePedido['razaoSocial'];
                $ufPessoa = $clientePedido['uf'];

                if(isset($clientePedido['grupoPessoa']))
                {
                    $grupoPessoa = $clientePedido['grupoPessoa'];
                }
                else
                {
                    $grupoPessoa = '';
                }


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
                } else {
                    $representante = '';
                }

                # Retorno da Função

                return view('pedidos.create', [
                    'codigoPedido' => $codigoPedido,
                    'dataPedido' => $dataPedido,
                    'idPessoaCliente' => $idPessoaCliente,
                    'idPessoaVendedor' => $idPessoaVendedor,
                    'nomePessoa' => $nomePessoa,
                    'cpf_cnpj' => $cpf_cnpj,
                    'ufPessoa' => $ufPessoa,
                    'vendedor' => $vendedor,
                    'representante' => $representante,
                    'valorTotalPedido' => $valorTotalPedido
                ]);
            } else # Caso o Request tenha um retorno nulo
            {
                return view('pedidos.create');
            }


            //-----------------------------------------------------


        }
    }

    public function store(Request $request)
    {
        $peso = $request->request->get('peso');
        $pesoBruto = str_replace(',','.', $peso);


        $request->request->set('peso', $pesoBruto);

        try {
            $pedido = Pedido::create($request->all());
            $pedido->save();
            return "Pedido Cadastrado com Sucesso!";
        } catch (\Throwable $th) {

            var_dump($th);
            $erno = $th->getCode();

            if($erno == "23000")
            {

                return "Pedido já cadastrado!". $th;
            }

        }





    }

    public function show(Pedido $pedido)
    {
        //Chama View
        return view('pedidos.show', ['pedido' => $pedido]);
    }

    public function updateNota()
    {
        $pedidos = Pedido::get('codigopedido');

        ds($pedidos);
    }
}
