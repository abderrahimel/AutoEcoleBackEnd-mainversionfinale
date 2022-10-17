<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class Notes_MinisteriellesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category'=>$this->faker->randomElement(['المذكرات الوزارية', 'بلاغ صحفي', 'دفتر تحملات المتعلق بفتح واستغلال مؤسسات تعليم السياقة', 'قرارات ومراسيم خاصة بمدونة السير 52.05']),
            'titre'=>$this->faker->randomElement(['1مذكرة حول بطائق مدربي تعليم السياقة	', 'بلاغ بخصوص العمل بالأدوات البيداغوجية	', 'رخصة السياقة مرقتة صالحة لمدة ستين يوما	']),    
            'lien'=>'https://gestionautoecole.com/',
            'fichier'=>'1662456961.pdf',
        ];
    }
}
