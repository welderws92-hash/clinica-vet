<?php

namespace Tests\Feature\Authorization;
use App\Models\User;
use App\Models\Tutor;
use App\Models\Specie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
class ApiRoleAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_rejects_requests_without_authentication(): void
    {
        $this->getJson('/api/animals')
            ->assertUnauthorized();

        $this->getJson('/api/consultations')
            ->assertUnauthorized();

        $this->getJson('/api/exams')
            ->assertUnauthorized();
    }

    public function test_receptionist_can_access_animals_api(): void
    {
        $user = User::factory()->create([
            'role' => 'recepcionista',
            'status' => true,
        ]);

        Sanctum::actingAs($user);

        $this->getJson('/api/animals')
            ->assertOk();
    }

    public function test_veterinarian_can_access_consultations_api(): void
    {
        $user = User::factory()->create([
            'role' => 'veterinario',
            'status' => true,
        ]);

        Sanctum::actingAs($user);

        $this->getJson('/api/consultations')
            ->assertOk();
    }

    public function test_receptionist_can_access_exams_api(): void
    {
        $user = User::factory()->create([
            'role' => 'recepcionista',
            'status' => true,
        ]);

        Sanctum::actingAs($user);

        $this->getJson('/api/exams')
            ->assertOk();
    }

    public function test_receptionist_can_create_animal_through_api(): void
    {
        $user = User::factory()->create([
            'role' => 'recepcionista',
            'status' => true,
        ]);

        $tutor = Tutor::create([
            'name' => 'Tutor de Teste',
            'cpf' => fake('pt_BR')->unique()->cpf(),
            'phone' => '24999999999',
            'address' => 'Rua de Teste',
        ]);

        $specie = Specie::create([
            'name' => 'Canina',
        ]);

        Sanctum::actingAs($user);

        $response = $this->postJson('/api/animals', [
            'tutor_id' => $tutor->id,
            'name' => 'Rex',
            'specie_id' => $specie->id,
            'gender' => 'male',
        ]);

        $response->assertOk();

        $this->assertDatabaseHas('animals', [
            'name' => 'Rex',
            'tutor_id' => $tutor->id,
            'specie_id' => $specie->id,
        ]);
    }

    public function test_admin_can_access_user_management(): void
    {
        $user = User::factory()->create([
            'role' => 'admin',
            'status' => true,
        ]);

        $response = $this->actingAs($user)->get('/users');

        $response->assertOk();
    }

}
