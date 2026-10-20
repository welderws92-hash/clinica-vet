<?php

namespace Database\Factories;

use App\Models\Tutor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tutor>
 */
class TutorFactory extends Factory
{
    protected $model = Tutor::class;

    public function definition(): array
    {
        return [
            'name' => fake('pt_BR')->name(),
            'cpf' => fake('pt_BR')->unique()->cpf(),
            'phone' => fake('pt_BR')->cellphoneNumber(),
            'address' => fake('pt_BR')->address(),
        ];
    }
}
