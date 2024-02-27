<?php

namespace Database\Seeders;

use App\Models\Etat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EtatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Etat::create([
            'name' => 'A programmer',
        ]);

        Etat::create([
            'name' => 'Confirmer',
        ]);

        Etat::create([
            'name' => 'Attente',
        ]);

        Etat::create([
            'name' => 'Passer',
        ]);

        Etat::create([
            'name' => 'Annuller',
        ]);
    }
}
