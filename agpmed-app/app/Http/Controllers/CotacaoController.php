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

        if($pedido != null)
        {
            $service = new ErpNomusService();
            $return = $service
            ->pedidos()
            ->get($pedido);
            $pedido = $return->json();
            if($pedido != null)
            {
                $pedidoNomus = $pedido[0];
            }
            else
            {
                $pedidoNomus = null;
            }

        }

        if($pedidoNomus != null)
        {
            return view('cotacoes.create', ['pedido' => $pedido]);
        }
        else
        {
            return view('cotacoes.create');
        }


    }
}
