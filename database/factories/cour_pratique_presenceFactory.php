<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MoniteurPratique;
use App\Models\CourPratique;
class cour_pratique_presenceFactory extends Factory
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
            'moniteur_pratique_id'=>MoniteurPratique::factory(),
            'cour_pratique_id'=>CourPratique::factory(),
            'date'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
            'heure_debut'=>'10:25',
            'heure_fin'=>'12:30',
            'categorie' =>$this->faker->randomElement(['A', 'B', 'C', 'D', 'E', 'F']),
            'candidat'=>[91, 90],
            'presence'=>'{90: "P", 91: "P"}'
        ];
    }
}