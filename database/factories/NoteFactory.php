<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Note;
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Note::class;
    public function definition()
    {  

        return [
            'auto_ecole_id'=>2,
            'categorie'=> $this->faker->randomElement(['A', 'B', 'C']),
            'moyen'=>'20',
            'note_generale'=>'20',
        ];
    }
}
