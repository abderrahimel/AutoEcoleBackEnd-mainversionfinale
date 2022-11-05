<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MoniteurTheorique;
use App\Models\Vehicule;

class CourTheoriqueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'auto_ecole_id'=>2,
            'moniteur_theorique_id'=> MoniteurTheorique::factory(),
            'date'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
            'type'=>'cours',
            'date_debut'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
            'date_fin'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
            'permis'=>$this->faker->randomElement(['A', 'B', 'C', 'D', 'E', 'F']),
            'candidat'=>[91,90],
        ];
    }
}


