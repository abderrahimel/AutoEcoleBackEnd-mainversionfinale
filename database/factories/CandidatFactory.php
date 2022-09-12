<?php
// App\Models\Candidat::factory()->count(12)->create();
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CandidatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    { 
        $array = array();
        $array[0] = 'oui';
        $array[1] = 'non';

        return [
            'auto_ecole_id'=>2,
            'cin'=>'fd12547',
            'date_inscription'=>$this->faker->dateTime(),
            'numero_contrat'=> '364764545',
            'ref_web'=>'web.fr',
            'nom_fr'=>$this->faker->name(),
            'prenom_fr'=>$this->faker->lastName(),
            'nom_ar'=>$this->faker->name(),
            'prenom_ar'=>$this->faker->lastName(),
            'date_naissance'=>$this->faker->dateTime(),
            'lieu_naissance'=>$this->faker->dateTime(),
            'adresse_fr'=>$this->faker->address(),
            'adresse_ar'=>$this->faker->address(),
            'telephone'=>'0612459874',
            'email'=>'email@gmail.com',
            'type_formation'=>'basic',
            'profession'=>'student',
            'langue'=>'Francais',
            'image'=>'43545454543.png',
            'date_fin_contrat'=>$this->faker->dateTime(),
            'categorie_demandee'=>'B',
            'nbr_heure_pratique'=>'30',
            'nbr_heure_theorique'=>'30',
            'possede_permis'=> strval($array[rand(0,(count($array)-1))]),
            'date_obtention'=>$this->faker->dateTime(),
            'lieu_obtention_fr'=>'meknes',
            'lieu_obtention_ar'=>'meknes',
            'montant'=>'345334',
            'pcn'=>'jjkjkljkl',
            'categorie'=>'B',
            'observations'=>'JGHHGG HHGHHJK',
            'moniteur_theorique_id'=>rand(1,10),
            'moniteur_pratique_id'=>rand(1,10),
            'vehicule_id'=>rand(1,10),
        ];
    }
}
