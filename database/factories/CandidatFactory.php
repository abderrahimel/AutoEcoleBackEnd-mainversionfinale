<?php
// App\Models\Candidat::factory()->count(12)->create();
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MoniteurTheorique;  
use App\Models\MoniteurPratique;
use App\Models\Vehicule;
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
        $b_s = array();
        $b_s[0] = 'basic';
        $b_s[1] = 'supplementaire';
        
        return [
            'auto_ecole_id'=>32,
            'cin'=>'fd12547',
            'date_inscription'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
            'numero_contrat'=> '364764545',
            'ref_web'=>'web.fr',
            'nom_fr'=>$this->faker->name(),
            'prenom_fr'=>$this->faker->lastName(),
            'nom_ar'=>$this->faker->name(),
            'prenom_ar'=>$this->faker->lastName(),
            'date_naissance'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
            'lieu_naissance'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
            'adresse_fr'=>$this->faker->address(),
            'adresse_ar'=>$this->faker->address(),
            'telephone'=>'0612459874',
            'email'=>'email@gmail.com',
            'type_formation'=> 'basic',
            'profession'=>'student',
            'langue'=>'Francais',
            'image'=>'43545454543.png',
            'date_fin_contrat'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
            'categorie_demandee'=>'B',
            'nbr_heure_pratique'=>'30',
            'nbr_heure_theorique'=>'30',
            'possede_permis'=> strval($array[rand(0,(count($array)-1))]),
            'date_obtention'=>$this->faker->date($format = 'Y-m-d', $max = 'now'),
            'lieu_obtention_fr'=>'meknes',
            'lieu_obtention_ar'=>'meknes',
            'montant'=>'345334',
            'pcn'=>'jjkjkljkl',
            'categorie'=>'B',
            'actif'=>'0',
            'observations'=>'JGHHGG HHGHHJK',
            'moniteur_theorique_id'=> MoniteurTheorique::factory(),
            'moniteur_pratique_id'=> MoniteurPratique::factory(),
            'vehicule_id'=> Vehicule::factory(),
        ];
    }
}
