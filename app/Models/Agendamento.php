<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    protected $fillable = [
        'cliente_id',
        'barbeiro_id',
        'servico_id',
        'horario_disponivel_id',
        'data',
        'hora',
        'status'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function barbeiro()
    {
        return $this->belongsTo(Barbeiro::class);
    }

    public function servico()
    {
        return $this->belongsTo(Servico::class);
    }

    public function horario()
    {
        return $this->belongsTo(HorarioDisponivel::class, 'horario_disponivel_id');
    }
}
