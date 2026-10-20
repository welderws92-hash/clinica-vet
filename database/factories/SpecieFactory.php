<?php

namespace Database\Factories;

use App\Models\Specie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Specie>
 */
class SpecieFactory extends Factory
{
    protected $model = Specie::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
        ];
    }
}
