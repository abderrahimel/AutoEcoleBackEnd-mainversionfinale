<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Employe;

class AbsenceFactory extends Factory
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
            'employe_id'=>Employe::factory(),
            'type_absence'=>$this->faker->randomElement(['Congé', 'Maladie', 'Non justifié', 'Préparation papier', 'Problèmes familiaux']),
            'date_debut'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
            'date_fin'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
            'remarque'=>$this->faker->paragraph
        ];
    }
}
