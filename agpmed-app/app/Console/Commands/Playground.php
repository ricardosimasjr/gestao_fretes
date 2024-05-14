<?php

namespace App\Console\Commands;

use App\Services\ErpNomus\ErpNomusService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Laravel\Tinker\Console\TinkerCommand;
use Laravel\Tinker\TinkerCaster;

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
        $json = $return->json(['0']['nome']);
        ds($json);
    }
}
