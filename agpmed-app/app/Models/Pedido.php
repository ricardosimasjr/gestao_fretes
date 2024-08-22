<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $fillable = [
        'codigopedido',
        'cpfcnpj',
        'nomecliente',
        'ufcliente',
        'datapedido',
        'vendedorpedido',
        'representantepedido',
        'volumes',
        'peso',
        'valor'
    ];
}
