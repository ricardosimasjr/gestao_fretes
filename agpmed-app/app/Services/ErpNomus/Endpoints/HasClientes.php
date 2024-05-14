<?php

namespace App\Services\ErpNomus\Endpoints;

trait HasClientes
{
    public function clientes(){
        return new Clientes();
    }
}
