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

        return view('cotacoes.list', ['cotacoes' => $cotacoes]);
    }

    public function create(Request $request)
    {
        $transportadoras = Transportador::orderBy('nome', 'asc')->get();
        //dd($transportadoras);
        return view('cotacoes.create', ['transportadoras' => $transportadoras]);
    }

    public function store(Request $request)
    {

        //Formatando Campo Valor;
        $valor = $request->request->get('valor');
        $valorFinal = str_replace('.', '', $valor);
        $valorFinalFormat = str_replace(',', '.', $valorFinal);
        $request->request->set('valor', $valorFinalFormat);

        //Formatando Campo Desconto
        $vlr_desconto = $request->request->get('vlr_desconto');
        $vlr_descontoFinal = str_replace('.', '', $vlr_desconto);
        $vlr_descontoFormat = str_replace(',', '.', $vlr_descontoFinal);
        $request->request->set('vlr_desconto', $vlr_descontoFormat);

        //Tratando TDE
        if(isset($cotacao->tx_dificulty)){

        }
        else
        {
            $request->request->set('tx_dificulty', 1);
        }

        $cotacao = Cotacao::create($request->all());
        $cotacao->save();
        return redirect(route('pedidos.show', $request->pedido_id));
    }

    public function show (Cotacao $cotacao)
    {
        $cotacao = Cotacao::with('transportador')->find($cotacao->id);
        return view('cotacoes.show', ['cotacao' => $cotacao]);
    }

    public function winner (Cotacao $cotacao)
    {
        if($cotacao->winner == 0)
        {
            $cotacao->update([
                'winner' => 1
            ]);
        }
        else
        {
            $cotacao->update([
                'winner' => 0
            ]);
        }

        return redirect(route('pedidos.show', ['pedido' => $cotacao->pedido_id]));
    }

    public function destroy(Cotacao $cotacao)
    {
        $cotacao->destroy($cotacao->id);
        return redirect(route('pedidos.show', ['pedido' => $cotacao->pedido_id]));
    }
}
