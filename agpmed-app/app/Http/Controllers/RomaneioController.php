<?php

namespace App\Http\Controllers;

use App\Models\Romaneio;
use Illuminate\Http\Request;

class RomaneioController extends Controller
{

    public function list()
    {
        return view('romaneios.list');
    }

    public function create()
    {
        //
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
