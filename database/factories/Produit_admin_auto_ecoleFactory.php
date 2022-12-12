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
    {  //  boutique categorie: 'equipement vehicule' 'bureau immobilier' 'materiel informatique'
        return [
            'titre'=>$this->faker->paragraph,
            'prix'=>'200',
            'marque'=>null,
            // 'categorie'=>$this->faker->randomElement(['materiel informatique', 'equipement vehicule', 'bureau immobilier']),
            'categorie'=>'vehicule occasion',
            'modele'=>null,
            'carburant'=>$this->faker->randomElement(['Carburant','Diesel', 'Essence']),   
            // 'carburant'=>null,   
            'kilometrage'=>"1000",
            'prixPromotion'=>"20",
            'description'=>$this->faker->paragraph,
            'image'=> '1659563880.jpeg',
        ];
    }
}
