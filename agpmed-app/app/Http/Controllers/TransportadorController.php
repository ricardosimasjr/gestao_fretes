<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transportador;

class TransportadorController extends Controller
{
    public function list()
    {
        $transportadores = Transportador::orderByDesc('id')->get();
        dd($transportadores);
        
        return view('transportadores.list', ['transportadores' => $transportadores]);
    }

    public function create()
    {
        return view('transportadores.create');
    }

    public function store(Request $request)
    {
       $transportador = Transportador::create($request->all());
       $transportador->save();

       return redirect()->route('transportador.show', $transportador->id)->with('sucess', 'Transportadora Cadastrada com Sucesso!');
    }

    public function show()
    {
        return view('transportadores.show');
    }

    public function edit()
    {
        return view('transportadores.edit');
    }

    public function update()
    {
        dd('Atualiza Transportadora');
    }

    public function destroy()
    {
        dd('Deleta Transportadora');
    }
}
