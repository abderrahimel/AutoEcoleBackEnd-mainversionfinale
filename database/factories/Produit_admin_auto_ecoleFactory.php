<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class Produit_admin_auto_ecoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {  // 
        return [
            'titre'=>$this->faker->paragraph,
            'prix'=>'200',
            'marque'=>'tesla',
            'categorie'=>$this->faker->randomElement(['materiel informatique','vehicule occasion', 'equipement vehicule', 'bureau immobilier']),
            'modele'=>'modele 1',
            'carburant'=>$this->faker->randomElement(['Carburant','Diesel', 'Essence']),   
            'kilometrage'=>'200',
            'prixPromotion'=>'20',
            'description'=>$this->faker->paragraph,
            'image'=> '1659563880.jpeg',
        ];
    }
}
