<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barbeiro extends Model
{
    protected $fillable = [
        'nome',
        'telefone',
        'especialidade',
        'ativo'
    ];

    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class);
    }

    public function horarios()
    {
        return $this->hasMany(HorarioDisponivel::class);
    }
}
