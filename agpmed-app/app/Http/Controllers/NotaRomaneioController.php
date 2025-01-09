<?php

namespace App\Http\Controllers;

use App\Models\NotaRomaneio;
use Illuminate\Http\Request;

class NotaRomaneioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $romaneio = $request->romaneio;

        return view('romaneios.createnota', [
            'romaneio' => $romaneio,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(NotaRomaneio $notaRomaneio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NotaRomaneio $notaRomaneio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NotaRomaneio $notaRomaneio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NotaRomaneio $notaRomaneio)
    {
        //
    }
}
