<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Romaneio extends Model
{
    use HasFactory;
    protected $table = 'romaneios';
    protected $fillable = [
        'data',
        'user_id',
        'transportador_id',
        'status_id',
        'motorista',
        'placa',
        'tipo_ident',
        'identificacao',
        'datahoracoleta',
        'assinatura',
        'obs',
    ];

    public function transportador(){
        return $this->belongsTo(Transportador::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
