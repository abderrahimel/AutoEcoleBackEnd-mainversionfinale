<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CategorieDepence;
use App\Models\Employe;

class DepenceFactory extends Factory
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
            'categorie_depence_id'=>CategorieDepence::factory(),
            'employe_id'=>Employe::factory(),
            'date'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
            'montant'=>'5625',
            'remarques'=>$this->faker->paragraph
        ];
    }
}