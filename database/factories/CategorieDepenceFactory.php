<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CategorieDepence;
class CategorieDepenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * 
     * @return array
     */
    protected $model = CategorieDepence::class;
    public function definition()
    { //personnel  vehicule local
        return [ // personnel   vehicule  local
            'auto_ecole_id'=>32,
            'categorie'=> 'categorie vehicule '. $this->faker->numberBetween(1,300),
            'type'=>'vehicule'
        ];
    }
}
