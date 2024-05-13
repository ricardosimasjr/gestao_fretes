<?php

namespace App\Services\NomusService;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class NomusService
{
    public PendingRequest $api;

    public function __construct()
    {
        $this->api = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic aW50ZWdyYWRvcmVycDptOE9SQ3JUZ3VTcHFkeDE=',
        ])->get('https://agaplastic.nomus.com.br/agaplastic/rest/clientes');
    }
}
