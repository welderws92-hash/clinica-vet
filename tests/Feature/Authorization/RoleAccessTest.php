<?php

namespace Tests\Feature\Authorization;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_veterinarian_cannot_access_user_management(): void
    {
        $user = User::factory()->create([
            'role' => 'veterinario',
            'status' => true,
        ]);

        $response = $this->actingAs($user)->get('/users');

        $response->assertForbidden();
    }

    public function test_receptionist_cannot_access_user_management(): void
    {
        $user = User::factory()->create([
            'role' => 'recepcionista',
            'status' => true,
        ]);

        $response = $this->actingAs($user)->get('/users');

        $response->assertForbidden();
    }

    public function test_receptionist_cannot_access_vaccinations(): void
    {
        $user = User::factory()->create([
            'role' => 'recepcionista',
            'status' => true,
        ]);

        $response = $this->actingAs($user)->get('/vaccinations');

        $response->assertForbidden();
    }

    public function test_receptionist_cannot_access_prescriptions(): void
    {
        $user = User::factory()->create([
            'role' => 'recepcionista',
            'status' => true,
        ]);

        $response = $this->actingAs($user)->get('/prescriptions');

        $response->assertForbidden();
    }
}

