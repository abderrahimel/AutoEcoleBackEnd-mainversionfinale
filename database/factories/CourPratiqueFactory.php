<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MoniteurPratique;
use App\Models\Vehicule;

class CourPratiqueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'auto_ecole_id'=>32,
            'moniteur_pratique_id'=> MoniteurPratique::factory(),
            'date'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
            'type'=>'cours',
            'date_debut'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
            'date_fin'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
            'permis'=>$this->faker->randomElement(['A', 'B', 'C', 'D', 'E', 'F']),
            'candidat'=>[91,90],
            'vehicule_id'=> Vehicule::factory()
        ];
    }
}
