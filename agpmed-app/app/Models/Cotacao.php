<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotacao extends Model
{
    use HasFactory;

    protected $table = 'cotacao';

    protected $fillable = [
        'id_transportador',
        'id_cliente',
        'id_usuario',
        'valor'
    ];

    public function transportador()
    {
        return $this->belongsTo(Transportador::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
