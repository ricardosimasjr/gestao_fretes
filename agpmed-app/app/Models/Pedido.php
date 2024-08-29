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
        'valor',
        'vlr_cotado',
        'nr_nota',
        'bonificado',
        'status_id',

    ];

    public function cotacao()
    {
        return $this->hasMany(Cotacao::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
