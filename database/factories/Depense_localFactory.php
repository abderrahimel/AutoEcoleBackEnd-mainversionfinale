<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CategorieDepence;

class Depense_localFactory extends Factory
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
            'date'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
            'montant'=>'5625',
            'remarques'=>$this->faker->paragraph
        ];
    }
}
