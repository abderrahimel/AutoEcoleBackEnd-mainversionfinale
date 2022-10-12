<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Candidat;

class PaimentCandidatFactory extends Factory
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
            'candidat_id'=>Candidat::factory(),
            'date'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
            'montant'=>'2000',
            'nom_banque'=>null,
            'image'=>'1649755936.jpeg',
            'type_p'=>'Espece',
            'numero'=>null,
            'remarque'=>$this->faker->paragraph
        ];
    }
}
