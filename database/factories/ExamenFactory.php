<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
USE App\Models\Candidat;
USE App\Models\MoniteurPratique;

class ExamenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'auto_ecole_id'=>31,
            'candidat_id' => Candidat::factory(),
            'moniteur_pratique_id'=> MoniteurPratique::factory(),
            'categorie'=>$this->faker->randomElement(['A', 'B', 'C', 'D', 'E']),
            'date_examen'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
            'date_depot'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
            'resultat'=>'1'
        ];
    }
}
