<?php

namespace App\Http\Controllers;

use App\Models\Romaneio;
use App\Models\Status;
use App\Models\Transportador;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class RomaneioController extends Controller
{

    public function list()
    {
        $romaneios = Romaneio::with('status')
            ->with('transportador')
            ->with('user')
            ->get();
        return view('romaneios.list', [
            'romaneios' => $romaneios,
        ]);
    }

    public function create()
    {

        $transportadoras = Transportador::get();
        // dd($transportadoras);
        $today = Carbon::today();
        // dd($today->format('Y-m-d'));
        $formatToday = $today->format('Y-m-d');
        return view('romaneios.create', [
            'today' => $formatToday,
            'transportadoras' => $transportadoras,
        ]);
    }

    public function store(Request $request)
    {
        $romaneio = Romaneio::create($request->all());
        return redirect(route('romaneios.list'));
    }


    public function show(Romaneio $romaneio)
    {
        //
    }

    public function edit(Romaneio $romaneio)
    {
        $today = Carbon::today();
        $transportadora = Transportador::find($romaneio->transportador_id);
        $transportadoras = Transportador::get();
        $user = User::find($romaneio->user_id);
        $status = Status::find($romaneio->status_id);
        return view('romaneios.edit', [
            'transportadora' => $transportadora,
            'transportadoras' => $transportadoras,
            'status' => $status,
            'user' => $user,
            'today' => $today,
            'romaneio' => $romaneio,
        ]);
    }

    public function update(Request $request, Romaneio $romaneio)
    {

        try {
            $romaneio->updateOrFail([
                'data' => $request->data,
                'transportador_id' => $request->transportador_id,
                'datahoracoleta' => $request->datahoracoleta,
                'user_id' => $request->status_id,
                'motorista' => $request->motorista,
                'tipo_ident' => $request->tipo_ident,
                'identificacao' => $request->identificacao,
                'obs' => $request->obs,
            ]);
        } catch (\Throwable $th) {
            dd($th);
        }

    }

    public function destroy(Romaneio $romaneio)
    {
        //
    }
}
