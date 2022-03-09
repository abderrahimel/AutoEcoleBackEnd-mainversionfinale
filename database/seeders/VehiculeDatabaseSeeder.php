<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class VehiculeDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        for ($i=0; $i<10; $i++) {
            DB::table('vehicules')->insert([
                [
                    'auto_ecole_id'=> rand(1,10),
                    'matricule'=> Str::random(10),
                    'type'=> Str::random(10),
                    'marque' => Str::random(10),
                    'modele' => Carbon::now()->format('Y-m-d H:i:s'),
                    'date_visite' => Carbon::now()->format('Y-m-d H:i:s'),
                    'date_vidange' => Carbon::now()->format('Y-m-d H:i:s'),
                    'carte_grise' => Str::random(10),
                    'vignette' => Str::random(10),
                    'assurance' => Str::random(10),
                    'visite' => Str::random(10),

                ],
            ]);
        }
    }
}
