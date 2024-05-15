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

        if ($json == null) {
            ds("Vazio");
        } else {
            ds($json);    
        }
        
        

        ##foreach ($json as $cliente) {
          ##  ds($cliente['id'] . '-' . $cliente['nome']);    
        ##}
        
    }
}
