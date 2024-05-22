<?php

namespace App\Services\ErpNomus\Endpoints;

trait HasPessoas
{
    public function pessoas(){
        return new Pessoas();
    }
}
