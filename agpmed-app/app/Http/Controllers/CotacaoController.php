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

            if (isset($json[0])) {
                $dadosPedido = $json[0];
                $codigoPedido = $json[0]['codigoPedido'];
                $dataEmissao = $json[0]['dataEmissao'];
                $idPessoaCliente = $json[0]['idPessoaCliente'];
                $idPessoaVendedor = $json[0]['idPessoaVendedor'];

                return view('cotacoes.create', [
                    'codigoPedido' => $codigoPedido,
                    'dataEmissao' => $dataEmissao,
                    'idPessoaCliente' => $idPessoaCliente,
                    'idPessoaVendedor' => $idPessoaVendedor,
                
                ]);
            }
            else
            {
                return view('cotacoes.create');
            }




            //-----------------------------------------------------


        }
    }
}
