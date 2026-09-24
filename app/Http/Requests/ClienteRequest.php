<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|max:100',
            'telefone' => 'required|max:20',
            'email' => ['required', 'email', 'max:100', 'regex:/^[A-Za-z0-9._%+-]+@gmail\.com$/i']
        ];
    }

    public function messages(): array
    {
        return [
            'email.regex' => 'O e-mail deve terminar com @gmail.com.',
        ];
    }
}