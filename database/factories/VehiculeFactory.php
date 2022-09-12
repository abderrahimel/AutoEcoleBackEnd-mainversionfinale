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
            'auto_ecole_id'=>2,
            'matricule'=>'1245698',
            'type'=>'Voiture',
            'marque'=>'tesla',
            'fourniseur'=>$this->faker->name(),
            'modele'=>'model 3',
            'categorie' =>'B',
            'date_visite'=>$this->faker->dateTime(),
            'date_prochain_visite'=>$this->faker->dateTime(),
            'date_vidange'=>$this->faker->dateTime(),
            'date_prochain_vidange'=>$this->faker->dateTime(),
            'date_assurance'=>$this->faker->dateTime(),
            'date_expiration_assurance'=>$this->faker->dateTime(),
            'carte_grise'=>'1649165322.jpeg',
            'vignette'=>'1655213064.jpeg',
            'assurance'=>'1649165454.jpeg',
            'visite'=>'1649165323.jpeg',    
        ];
    }
}
