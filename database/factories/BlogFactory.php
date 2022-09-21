<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'titre'=>$this->faker->paragraph,
            'description'=>$this->faker->paragraph,
            'image'=>'1654513547.jpeg'
        ];
    }
}
