<?php

namespace App\Services\ErpNomus\Endpoints;

use App\Services\ErpNomus\ErpNomusService;

class Clientes
{
    private ErpNomusService $service;

    public function __construct()
    {
        $this->service = new ErpNomusService();
    }

    public function get()
    {
        return $this->service
        ->api
        ->get('/clientes?pagina=102');
    }
}
