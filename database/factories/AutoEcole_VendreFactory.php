<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AutoEcole_VendreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'titre'=>$this->faker->name(),
            'description'=>$this->faker->paragraph,
            'prix'=>'2000',
            'date'=> $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'image'=>'1659008382.jpeg'
        ];
    }
}
