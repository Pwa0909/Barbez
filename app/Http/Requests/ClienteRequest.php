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
            'email' => ['required', 'email', 'max:100', 'regex:/^(?:[A-Za-z0-9._%+-]+@gmail\.com|admin@barbearia\.com)$/i']
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O nome é obrigatório.',
            'telefone.required' => 'O telefone é obrigatório.',
            'telefone.max' => 'O telefone deve ter no máximo 20 caracteres.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
            'email.max' => 'O e-mail deve ter no máximo 100 caracteres.',
            'email.regex' => 'O e-mail deve terminar com @gmail.com ou ser o e-mail do admin.',
        ];
    }
}