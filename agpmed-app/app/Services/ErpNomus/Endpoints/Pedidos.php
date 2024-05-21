<?php

namespace App\Services\ErpNomus\Endpoints;

use App\Services\ErpNomus\ErpNomusService;

class Pedidos
{
    private ErpNomusService $service;

    public function __construct()
    {
        $this->service = new ErpNomusService();
    }

    public function get($pedido)
    {
        if ($pedido != null) {
            return $this->service
            ->api
            ->get('/pedidos?query=codigoPedido=' . $pedido);
        }
    }
}
