<?php

namespace App\Http\Controllers;

use App\Models\Romaneio;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RomaneioController extends Controller
{

    public function list()
    {
        return view('romaneios.list');
    }

    public function create()
    {
        $today = Carbon::today();
        // dd($today->format('Y-m-d'));
        $formatToday = $today->format('Y-m-d');
        return view('romaneios.create', ['today' => $formatToday]);

    }

    public function store(Request $request)
    {
        //
    }


    public function show(Romaneio $romaneio)
    {
        //
    }

    public function edit(Romaneio $romaneio)
    {
        //
    }

    public function update(Request $request, Romaneio $romaneio)
    {
        //
    }

    public function destroy(Romaneio $romaneio)
    {
        //
    }
}
