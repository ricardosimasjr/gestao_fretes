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

    public function get($pessoaId)
    {
        return $this->service
        ->api
        ->get('/clientes/'.$pessoaId);
    }

    public function getCpf($cpf)
    {
        return $this->service
        ->api
        ->get('/clientes?query=cpf='.$cpf);
    }

    public function getCnpj($cnpj)
    {
        return $this->service
        ->api
        ->get('/clientes?query=cnpj='.$cnpj);
    }
}
