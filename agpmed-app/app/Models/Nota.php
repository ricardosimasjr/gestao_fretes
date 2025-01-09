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
        'romaneio_id',
        'cpfcnpj',
        'razaosocial',
        'municipio',
        'ufcliente',
        'emissao',
        'vendedor',
        'representante',
        'volumes',
        'peso',
        'vfrete',
        'vnota',
        'canhoto',
        'transportadora',
        'status',
        'tpfrete',
        'vfretecotado',
        'previsaoentrega',
    ];
}
