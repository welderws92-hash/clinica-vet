<?php

namespace Database\Seeders;

use App\Models\Race;
use App\Models\Specie;
use Illuminate\Database\Seeder;

class SpecieRaceSeeder extends Seeder
{
    public function run(): void
    {
        $speciesAndRaces = [
            'Cão' => [
                'Golden Retriever',
                'Labrador Retriever',
                'SRD (Sem Raça Definida)',
            ],
            'Gato' => [
                'Persa',
                'Siamês',
                'SRD (Sem Raça Definida)',
            ],
            'Ave' => [
                'Calopsita',
            ],
        ];

        foreach ($speciesAndRaces as $speciesName => $races) {
            $specie = Specie::firstOrCreate([
                'name' => $speciesName,
            ]);

            foreach ($races as $raceName) {
                Race::firstOrCreate([
                    'specie_id' => $specie->id,
                    'name' => $raceName,
                ]);
            }
        }
    }
}
