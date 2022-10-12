<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CategorieDepence;
use App\Models\Vehicule;
class DepenseVehiculeFactory extends Factory
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
            'categorie_depence_id'=>CategorieDepence::factory(),
            'vehicule_id'=>Vehicule::factory(),
            'date'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
            'montant'=>'5625',
            'remarques'=>$this->faker->paragraph
        ];
    }
}
