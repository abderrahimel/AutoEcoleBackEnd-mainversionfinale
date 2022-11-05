<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Produit;
class ProduitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Produit::class;
    public function definition()
    {
        return [
            'auto_ecole_id'=>2,
            'fournisseur'=>$this->faker->name(),
            'telephone'=>'0612459874',
            'libelle'=> 'libelle1	',
            'prix'=>'200',
            'quantite'=>10,
            'description'=>$this->faker->paragraph
        ];
    }
}
