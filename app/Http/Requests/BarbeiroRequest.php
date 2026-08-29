<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarbeiroRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|max:100',
            'telefone' => 'nullable|max:20',
            'especialidade' => 'nullable|max:100',
            'ativo' => 'required|boolean'
        ];
    }
}