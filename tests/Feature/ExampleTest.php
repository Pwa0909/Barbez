<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_agendamento_calendar_disables_sundays(): void
    {
        $response = $this->get('/agendamentos');

        $response->assertRedirect();
        $this->assertStringEndsWith('/login', $response->headers->get('Location'));
    }

    public function test_cliente_register_requires_gmail_email(): void
    {
        $response = $this->post('/register/cliente', [
            'nome' => 'Cliente Teste',
            'telefone' => '(11) 99999-9999',
            'email' => 'cliente@outlook.com',
            'password' => 'senha123',
            'password_confirmation' => 'senha123',
        ]);

        $response->assertSessionHasErrors('email');

        $validResponse = $this->post('/register/cliente', [
            'nome' => 'Cliente Gmail',
            'telefone' => '(11) 99999-9999',
            'email' => 'cliente@gmail.com',
            'password' => 'senha123',
            'password_confirmation' => 'senha123',
        ]);

        $validResponse->assertRedirect();
        $this->assertDatabaseHas('clientes', ['email' => 'cliente@gmail.com']);
    }
}
