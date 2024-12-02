<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Romaneio extends Model
{
    use HasFactory;
    protected $table = 'romaneio';
    protected $fillable = [
        'data',
        'user_id',
        'transportador_id',
        'nota_id',
        'obs',
    ];

}
