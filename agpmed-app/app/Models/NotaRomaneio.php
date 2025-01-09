<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaRomaneio extends Model
{
    use HasFactory;

    protected $table = 'notas_romaneio';
    protected $fillable = [
        'romaneio_id',
        'nfe',
        'emissao',
        'razaosocial',
        'cnpj',
        'cidade',
        'uf',
        'volumes',
        'peso',
        'valor',
        'bonificacao',
    ];

}
