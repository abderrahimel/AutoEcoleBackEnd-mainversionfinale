<?php
// App\Models\Vehicule::factory()->count(12)->create();
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VehiculeFactory extends Factory
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
            'matricule'=>'1245698',
            'type'=>'Voiture',
            'marque'=>'tesla',
            'fourniseur'=>$this->faker->name(),
            'modele'=>'model 3',
            'categorie' =>$this->faker->randomElement(['A', 'B', 'C', 'D', 'E', 'F']),
            'date_visite'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
            'date_prochain_visite'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
            'date_vidange'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
            'date_prochain_vidange'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
            'date_assurance'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
            'date_expiration_assurance'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
            'carte_grise'=>'1649165322.jpeg',
            'vignette'=>'1655213064.jpeg',
            'assurance'=>'1649165454.jpeg',
            'visite'=>'1649165323.jpeg',    
        ];
    }
}
