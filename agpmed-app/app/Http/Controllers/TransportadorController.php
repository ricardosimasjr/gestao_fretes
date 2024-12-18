<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transportador;

class TransportadorController extends Controller
{
    public function list(Request $request)
    {
        $transportadores = Transportador::when($request->has('transportadora'), function($whenQuery) use ($request){
            $whenQuery->where('nome', 'like', '%' . $request->transportadora . '%');
        })
        ->orderByDesc('id')
        ->paginate(3)
        ->withQueryString();
        return view('transportadores.list', [
            'transportadores' => $transportadores,
            'transportadora' => $request->nome,
        ]);
    }

    public function create()
    {
        return view('transportadores.create');
    }

    public function store(Request $request)
    {
       $transportador = Transportador::create($request->all());
       $transportador->save();

       return redirect()->route('transportador.list');
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
