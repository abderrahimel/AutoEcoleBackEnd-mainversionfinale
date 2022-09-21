<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Facture;
use App\Models\Candidat;

class FactureFactory extends Factory
{
    /**Facture
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Facture::class;
    public function definition()
    {
        return [
            'auto_ecole_id'=>32,
            'date'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
            'candidat_id'=> Candidat::factory(),
            'montant_ttc'=>25,
            'montant_ht'=>14,
            'tva'=>0.25,
            'remarque'=>'ghjudfhhgytrytrytrtr'
        ];
    }
}
