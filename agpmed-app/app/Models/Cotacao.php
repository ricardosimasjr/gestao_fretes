<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotacao extends Model
{
    use HasFactory;

    protected $table = 'cotacao';

    protected $fillable = [
        'transportador_id',
        'dataCotacao',
        'pedido_id',
        'codcotacao',
        'valor',
        'winner',
        'dt_previsao_entrega',
        'vlr_desconto',
        'tx_dificulty',
        'obs',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function cotacao()
    {
        return $this->belongsTo(Cotacao::class);
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
