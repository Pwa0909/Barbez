<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgendamentoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if ($this->routeIs('agendamentos.store') && auth('cliente')->check()) {
            $this->merge([
                'cliente_id' => auth('cliente')->id(),
            ]);
        }

        if ($this->routeIs('admin.agendamentos.update') && !$this->filled('cliente_id')) {
            $agendamento = $this->route('agendamento');
            if ($agendamento) {
                $this->merge([
                    'cliente_id' => $agendamento->cliente_id,
                ]);
            }
        }
    }

    public function rules(): array
    {
        return [
            'cliente_id' => 'required|exists:clientes,id',
            'nome' => 'nullable|string|max:255',
            'servico_id' => 'required|exists:servicos,id',
            'horario_disponivel_id' => 'required|exists:horarios_disponiveis,id',
            'status' => 'nullable|string|max:50',
            'observacoes' => 'nullable|string'
        ];
    }
}

