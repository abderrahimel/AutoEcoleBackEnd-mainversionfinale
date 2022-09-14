<?php
// App\Models\AutoEcole::factory()->create()
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\AutoEcole;
class AutoEcoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = AutoEcole::class;
    public function definition()
    {
        return [
            'user_id'=> rand(1,11),
            'etat'=> 'en_attente',
            'nom_auto_ecole'=> $this->faker->name(),
            'telephone'=> '0612458965',
            'pays'=> 'maroc',
            'ville'=> 'fes',
            'fax'=> '0512456987',
            'site_web'=> 'web.com',
            'adresse'=> $this->faker->address,
            'image'=> rand(1,10),
            'image_rc'=> rand(1,10),
            'image_cin'=> rand(1,10),
            'image_agrement'=> rand(1,10),
            'ice'=> rand(1,10),
            'tva'=> rand(1,10),
            'n_register_de_commerce'=> rand(1,10),
            'n_compte_bancaire'=> rand(1,10),
            'n_agrement'=> rand(1,10),
            'n_cnss'=> rand(1,10),
            'n_patente'=> rand(1,10),
            'date_autorisation'=> $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'date_ouverture'=> $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'identification_fiscale'=> rand(1,10),
            'cin_responsable'=> 'df12598',
            'nom_responsable'=> $this->faker->name(),
            'prenom_responsable'=> $this->faker->lastName ,
            'tel_responsable'=> '0612549832',
            'adresse_responsable'=> $this->faker->address,
            'contrat'=> null
        ];
    }
}
