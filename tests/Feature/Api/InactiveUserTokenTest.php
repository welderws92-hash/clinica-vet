<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InactiveUserTokenTest extends TestCase
{
    use RefreshDatabase;

    public function test_inactive_user_cannot_access_api_with_old_token(): void
    {
        // Cria um usuário ativo para o teste.
        $user = User::factory()->create([
            'role' => 'veterinario',
            'status' => true,
        ]);

        // Gera um token válido para esse usuário.
        $token = $user->createToken('dispositivo-teste')->plainTextToken;

        // Simula a desativação da conta pelo administrador.
        $user->update([
            'status' => false,
        ]);

        // Tenta acessar a API usando o token antigo.
        $response = $this
            ->withToken($token)
            ->getJson('/api/animals');

        // Esperamos que a API negue o acesso.
        $response->assertForbidden();
    }
}
