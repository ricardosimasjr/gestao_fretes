<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotacao extends Model
{
    use HasFactory;

    protected $table = 'cotacao';

    protected $fillable = [
        'cliente',
        'usuario',
        'pedido',
        'transportadora',
        'valorcotado',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function transportador()
    {
        return $this->belongsTo(Transportador::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
