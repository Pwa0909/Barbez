<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HorarioDisponivel extends Model
{
    protected $table = 'horarios_disponiveis';

    protected $fillable = [
        'barbeiro_id',
        'data',
        'hora',
        'disponivel'
    ];

    public function barbeiro()
    {
        return $this->belongsTo(Barbeiro::class);
    }

    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class);
    }
}