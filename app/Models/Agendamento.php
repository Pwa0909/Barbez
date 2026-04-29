<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    protected $fillable = [
        'cliente',
        'servico_id',
        'data',
        'hora'
    ];

    public function servico()
    {
        return $this->belongsTo(Servico::class);
    }
}