<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class HorarioDisponivelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'data' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    if (Carbon::parse($value)->isSunday()) {
                        $fail('Não é permitido cadastrar ou selecionar horários aos domingos.');
                    }
                },
            ],
            'hora' => 'required',
            'disponivel' => 'required|boolean'
        ];
    }
}