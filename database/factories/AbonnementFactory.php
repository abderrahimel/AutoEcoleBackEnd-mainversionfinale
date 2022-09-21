<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\AutoEcole;

class AbonnementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'auto_ecole_id'=> 49,
            'prix'=>'10000',
            'date_fin'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
            'date_debut'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
        ];
    }
}
