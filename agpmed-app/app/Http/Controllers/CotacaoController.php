<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transportador;
use App\Models\Cotacao;
use App\Models\User;

class CotacaoController extends Controller
{
    public function list(Request $request)
    {
        $cotacoes = Cotacao::with('transportador')->get();
        $transportadores = Transportador::get();
        
        return view('cotacoes.list', ['cotacoes' => $cotacoes, 'transportadores' => $transportadores]);


    }

    public function create()
    {
        $transportadores = Transportador::get();

        return view('cotacoes.create', ['transportadores' => $transportadores]);
    }
}
