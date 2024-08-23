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
        $cotacoes = Cotacao::with('transportador')->get()->with('transportador');

        dd($cotacoes);

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
        $valor = $request->request->get('valor');
        $valorFinal = str_replace('.', '', $valor);
        $valorFinalFormat = str_replace(',', '.', $valorFinal);
        $request->request->set('valor', $valorFinalFormat);
        $cotacao = Cotacao::create($request->all());
        $cotacao->save();
        return redirect(route('pedidos.list'));
    }
}
