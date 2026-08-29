<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Cliente extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nome',
        'telefone',
        'email',
        'senha'
    ];

    protected $hidden = [
        'senha',
    ];

    public function getAuthPassword()
    {
        return $this->senha;
    }

    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class);
    }
}
