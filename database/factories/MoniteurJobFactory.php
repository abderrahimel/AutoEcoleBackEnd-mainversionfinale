<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MoniteurJobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom'=>$this->faker->name,
            'description'=>$this->faker->paragraph,
            'salaire'=>'5232',
            'date'=> $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'image'=>'1659002845.jpeg'
        ];
    }
}
