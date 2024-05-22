<?php

namespace App\Services\ErpNomus\Endpoints;

use App\Services\ErpNomus\ErpNomusService;

class Pessoas
{
    private ErpNomusService $service;

    public function __construct()
    {
        $this->service = new ErpNomusService();
    }

    public function get($pessoaId)
    {
        return $this->service
        ->api
        ->get('/pessoas/'.$pessoaId);
    }
}
