<?php

namespace App\Services\ErpNomus;

use App\Services\ErpNomus\Endpoints\HasClientes;
use App\Services\ErpNomus\Endpoints\HasPedidos;
use App\Services\ErpNomus\Endpoints\HasPessoas;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class ErpNomusService
{
    use HasClientes;
    use HasPedidos;
    use HasPessoas;

    public PendingRequest $api;

    public function __construct()
    {
        $this->api = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic aW50ZWdyYWRvcmVycDptOE9SQ3JUZ3VTcHFkeDE=',
        ])->baseUrl('https://agaplastic.nomus.com.br/agaplastic/rest');
    }
}
