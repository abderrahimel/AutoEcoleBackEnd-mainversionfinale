<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Faker\Factory;

class AutoEcoleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {  
      for ($i=0; $i<10; $i++) {
        DB::table('users')->insert([   
          [
            'name'=>'user'.$i,
            'email'=> Str::random(10)."@email.com",
            'password'=> bcrypt('123456'),
            'nombre'=> rand(1,4),
            'nombre_autorise'=> rand(1,4),
            'date_debut'=> Carbon::now()->format('Y-m-d H:i:s'),
            'date_fin'=> Carbon::now()->addYears(2)->format('Y-m-d H:i:s'),
          ]
        ]);
      }


        for ($i=0; $i<10; $i++) {
            DB::table('auto_ecoles')->insert([   
              [
                'user_id'=> rand(1,10),
                'nom'=> Str::random(10),
                'registre_commerce'=> Str::random(10),
                'num_agrement'=> rand(1,10),
                'num_patente'=> rand(1,10),
                'photo1'=> Str::random(10),
                'photo2'=> Str::random(10),
                'date_autorisation'=> Carbon::now()->format('Y-m-d H:i:s'),
                'ident_fiscale'=> rand(1,10),
                'date_ouverture'=> Carbon::now()->format('Y-m-d H:i:s'),
                'CNSS'=> Str::random(10),
                'ICE'=> Str::random(10),
                'compte_bancaire' => Str::random(10),
                'TVA' => rand(1,10),
                'pays'=> Str::random(10),
                'ville'=> Str::random(10),
                'telephone'=> Str::random(10),
                'fax'=> Str::random(10),
                'site_web'=> Str::random(10),
                'adresse'=> Str::random(10),
                'CIN_responsable'=> Str::random(10),
                'nom_responsable'=> Str::random(10),
                'prenom_responsable'=> Str::random(10),
                'tele_responsable'=> Str::random(10),
                'photo_cin'=> Str::random(10),
                'adresse_responsable'=> Str::random(10)
              ]
                
            ]);
            
      }
    }

}
