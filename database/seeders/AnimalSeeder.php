<?php

namespace Database\Seeders;

use App\Models\Animal;
use App\Models\Specie;
use App\Models\Tutor;
use Illuminate\Database\Seeder;

class AnimalSeeder extends Seeder
{
    public function run(): void
    {
        $tutors = Tutor::all();

        if ($tutors->isEmpty()) {
            $this->command->warn(
                'Nenhum tutor encontrado. Cadastre tutores antes de gerar animais.'
            );

            return;
        }

        $speciesWithRaces = Specie::with('races')
            ->whereIn('name', ['Cão', 'Gato', 'Ave'])
            ->get()
            ->filter(fn($specie) => $specie->races->isNotEmpty());

        if ($speciesWithRaces->isEmpty()) {
            $this->command->warn(
                'Nenhuma espécie com raças cadastradas foi encontrada.'
            );

            return;
        }

        // Corrige os animais existentes sem criar outros 25 registros.
        foreach (Animal::all() as $animal) {
            $specie = $speciesWithRaces->random();
            $race = $specie->races->random();

            $animal->update([
                'tutor_id' => $animal->tutor_id ?: $tutors->random()->id,
                'specie_id' => $specie->id,
                'race_id' => $race->id,
            ]);
        }
    }
}
