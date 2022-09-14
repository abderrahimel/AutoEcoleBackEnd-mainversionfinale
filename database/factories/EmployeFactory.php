<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeFactory extends Factory
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
            'nom'=> $this->faker->name(),
            'prenom'=>$this->faker->lastName(),
            'cin'=>'df15489',
            'type'=>'commercial',
            'date_naissance'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
            'lieu_naissance'=>'meknes',
            'email'=>$this->faker->unique()->safeEmail(),
            'telephone'=>'0612459875',
            'date_embauche'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
            'capn'=>'dfgdkg',
            'conduire'=>'sdsgftjg',
            'adresse'=>$this->faker->address(),
            'observations'=>'gjkhkfhkhkh',
        ];
    }
}
