<?php

namespace App\Services\ErpNomus\Endpoints;

use App\Services\ErpNomus\ErpNomusService;

class Notas
{
    private ErpNomusService $service;

    public function __construct()
    {
        $this->service = new ErpNomusService();
    }

    public function get($nota)
    {
        if ($nota != null) {
            return $this->service
            ->api
            ->get('/nfes?query=numero=' . $nota);
        }
    }
}
