<?php

namespace App\Services\ErpNomus\Endpoints;

trait HasNotas
{
    public function notas(){
        return new Notas();
    }
}
