<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MoniteurTheoriqueFactory extends Factory
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
        'type'=>'Moniteur Théorique',
        'date_naissance'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
        'lieu_naissance'=>'meknes',
        'email'=>$this->faker->unique()->safeEmail(),
        'telephone'=>'0612459876',
        'date_embauche'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
        'capn'=>'iljsklj',
        'conduire'=>'ghjg',
        'adresse'=>$this->faker->address(),
        'observations'=>'gfhjhjhjhjjgh',
        'categorie'=>["B"],
        'namecarteMoniteur'=>'carte1'
        ];
    }
}
