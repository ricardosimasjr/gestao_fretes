<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $table = 'status';
    protected $fillable = [
        'status',
    ];

    public function status()
    {
        return $this->hasMany(Pedido::class);
    }

    public function romaneio()
    {
        return $this->hasMany(Romaneio::class);
    }
}
