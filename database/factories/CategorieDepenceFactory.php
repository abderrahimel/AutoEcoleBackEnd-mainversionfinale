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
        return [
            'auto_ecole_id'=>2,
            'categorie'=> 'categorie local 1',
            'type'=>'local'
        ];
    }
}
