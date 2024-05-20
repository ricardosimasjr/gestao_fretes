<?php

namespace App\Console\Commands;

use App\Services\ErpNomus\ErpNomusService;
use Illuminate\Console\Command;

class Playground extends Command
{
    protected $signature = 'play';


    protected $description = 'Playground command';


    public function handle()
    {
        $service = new ErpNomusService();
        $return = $service
        ->clientes()
        ->get();
        $json = $return->json();

        ds($json);
        
        #if ($json == null) {
        #    ds("Vazio");
        #} else {
        #    $cliente = $json[0];
        #    ds($cliente);

        #if(isset($cliente['cpf'])){
        #    $cpf_cnpj = $cliente['cpf'];
        #}

        #if(isset($cliente['cnpj'])){
        #    $cpf_cnpj = $cliente['cnpj'];
        #}

        #$nome = $cliente['nome'];
        #$municipio = $cliente['municipio'];
        #$uf = $cliente['uf'];

        #ds($cpf_cnpj . " - " . $nome . " - " . $municipio . " - " . $uf);
        #}
        
    }
}
