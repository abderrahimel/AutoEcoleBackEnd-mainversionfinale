<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\AbsenceTheoriqueMoniteur;
use App\Models\MoniteurTheorique;

class AbsenceTheoriqueMoniteurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = AbsenceTheoriqueMoniteur::class;
    public function definition()
    {
        return [
            'auto_ecole_id'=>2,
            'moniteur_theorique_id'=>MoniteurTheorique::factory(),
            'type_absence'=>$this->faker->randomElement(['Congé', 'Maladie', 'Non justifié', 'Préparation papier', 'Problèmes familiaux']),
            'date_debut'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
            'date_fin'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
            'remarque'=>'hnfgfvnhg',
        ];
    }
}
