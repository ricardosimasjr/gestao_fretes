<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;

    protected $table = 'notas';

    protected $fillable = [
        'nfe',
        'cpfcnpj',
        'razaosocial',
        'ufcliente',
        'emissao',
        'vendedor',
        'representante',
        'volumes',
        'peso',
        'vfrete',
        'vnota',
        'canhoto',
    ];
}
