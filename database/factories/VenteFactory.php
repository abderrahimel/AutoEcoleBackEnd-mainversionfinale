<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Vente;
use App\Models\Candidat;
use App\Models\Produit;

class VenteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Vente::class;
    public function definition()
    {
        return [
            'auto_ecole_id'=>2,
            'candidat_id'=> Candidat::factory(),
            'produit_id'=>Produit::factory(),
            'prixUnitaire'=>'2500',
            'prixTotale'=>'250',
            'quantiteDisponible'=>'2547',
            'quantite'=>'50',
            'date'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
        ];
    }
}
