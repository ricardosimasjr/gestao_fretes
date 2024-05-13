<?php

namespace App\Console\Commands;

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
        $return = Http::withHeaders(
            [
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic aW50ZWdyYWRvcmVycDptOE9SQ3JUZ3VTcHFkeDE=',
            ])->get('https://agaplastic.nomus.com.br/agaplastic/rest/clientes');

            $json = $return->json();

            dd($json);

            return Command::SUCCESS;
    }
}
