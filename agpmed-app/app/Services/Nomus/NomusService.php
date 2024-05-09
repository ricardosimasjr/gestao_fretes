<?php

namespace App\Services\NomusService;

class NomusService
{
    public PendingRequest $api;

    public function __construct()
    {
        $this->api = Http::with([
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic aW50ZWdyYWRvcmVycDptOE9SQ3JUZ3VTcHFkeDE=',
        ]);
    }
}x