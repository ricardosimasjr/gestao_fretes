<?php

namespace App\Services\ErpNomus\Endpoints;

trait HasPedidos
{
    public function pedidos(){
        return new Pedidos();
    }
}
