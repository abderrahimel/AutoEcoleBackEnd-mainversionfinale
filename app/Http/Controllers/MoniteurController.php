<?php

namespace App\Http\Controllers;
use App\Models\AutoEcole;
use App\Models\MoniteurPratique; 
use App\Models\Employe; 
use App\Models\MoniteurTheorique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MoniteurController extends Controller
{
    public function getMoniteurP($ecole_id)
    {
        $ecole=AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"Moniteur Pratique n'est pas trouvée"],404);
        }
        $moniteurs = MoniteurPratique::where('auto_ecole_id',$ecole_id)->get();
        foreach ($moniteurs as $moniteur) {
            $moniteur->employe;
        }

        return response()->json($moniteurs,200);
        
    }
    // deleteMoniteurt , deleteMoniteurp
    public function deleteMoniteurt($id){
              $moniteurT = MoniteurTheorique::find($id);
              if(is_null($moniteurT)){
                return response()->json(['message'=> "moniteur theorique n'est pas trouvé"],404);
            }
            $moniteurT->delete();
            return response()->json(['message'=>'moniteur theorique deleted'],200);
    }
    public function deleteMoniteurp($id){
              $moniteurP = MoniteurPratique::find($id);
              if(is_null($moniteurP)){
                return response()->json(['message'=> "moniteur pratique n'est pas trouvé"],404);
            }
            $moniteurP->delete();
            return response()->json(['message'=>'moniteur pratique deleted'],200);
    }

    public function updateMoniteurT($id, Request $request){

            $moniteurt = MoniteurTheorique::find($id);
             if(is_null($moniteurt)){
                return response()->json(['message'=> "moniteur theorique n'est pas trouvé"],404);
            }
            $employe = Employe::find($moniteurt->employe_id);

            if (is_null($employe)) {
                return response()->json(['message'=>"Employé n'est pas trouvée"],404);
            }
            if($request->carteMoniteur != ''){
                $namecarteMoniteur = time().'.' . explode('/', explode(':', substr($request->carteMoniteur, 0, strpos($request->carteMoniteur, ';')))[1])[1];
                \Image::make($request->carteMoniteur)->save(public_path('carteMoniteur/').$namecarteMoniteur);
                $moniteurt->carteMoniteur = $namecarteMoniteur;
                $moniteurt->save();
            }
           
            $employe->nom = $request->nom;
            $employe->prenom =$request->prenom;
            $employe->cin    = $request->cin;
            $employe->type   = $request->type;
            $employe->date_naissance = $request->date_naissance;
            $employe->lieu_naissance = $request->lieu_naissance;
            $employe->email = $request->lieu_naissance;
            $employe->telephone = $request->telephone;
            $employe->date_embauche = $request->date_embauche;
            $employe->capn = $request->capn;
            $employe->conduire = $request->conduire;
            $employe->adresse = $request->adresse;
            $employe->observations = $request->observations;
            $employe->save();
            return response($employe,200);
        
    }

    public function updateMoniteurp($id, Request $request){

        $moniteurp = MoniteurPratique::find($id);
         if(is_null($moniteurp)){
            return response()->json(['message'=> "moniteur pratique n'est pas trouvé"],404);
        }
        $employe = Employe::find($moniteurp->employe_id);

        if (is_null($employe)) {
            return response()->json(['message'=>"Employé n'est pas trouvée"],404);
        }
        if($request->carteMoniteur != ''){
            $namecarteMoniteur = time().'.' . explode('/', explode(':', substr($request->carteMoniteur, 0, strpos($request->carteMoniteur, ';')))[1])[1];
            \Image::make($request->carteMoniteur)->save(public_path('carteMoniteur/').$namecarteMoniteur);
            $moniteurp->carteMoniteur = $namecarteMoniteur;
        }
        $moniteurp->save();
        $employe->nom = $request->nom;
        $employe->prenom =$request->prenom;
        $employe->cin    = $request->cin;
        $employe->type   = $request->type;
        $employe->date_naissance = $request->date_naissance;
        $employe->lieu_naissance = $request->lieu_naissance;
        $employe->email = $request->lieu_naissance;
        $employe->telephone = $request->telephone;
        $employe->date_embauche = $request->date_embauche;
        $employe->capn = $request->capn;
        $employe->conduire = $request->conduire;
        $employe->adresse = $request->adresse;
        $employe->observations = $request->observations;
        $employe->save();
        return response($employe,200);
    
}
    public function getMoniteurT($ecole_id)
    {
        $ecole=AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"Moniteur Théorique n'est pas trouvée"],404);
        }
        $moniteurs = MoniteurTheorique::all()->where('auto_ecole_id',$ecole_id);
        foreach ($moniteurs as $moniteur) {
            $moniteur->employe;
            $categories = $moniteur->employe;
            // "['A', 'B']"
            $input = substr("['A', 'B']", 1, -1);
            $moniteur['categories'] = str_replace("'","", $input);
        }
        
        return response()->json($moniteurs,200);
        
    }

    
    public function getMoniteurpById($moniteur_id)
    {
        $moniteur=MoniteurPratique::find($moniteur_id);
        if (is_null($moniteur)) {
            return response()->json(['message'=>"Moniteur n'est pas trouvé"],404);
        }
        $moniteur->employe;
        return response()->json($moniteur,200);
    }

    public function getMoniteurtById($moniteur_id)
    {
        $moniteur=MoniteurTheorique::find($moniteur_id);
        if (is_null($moniteur)) {
            return response()->json(['message'=>"Moniteur n'est pas trouvé"],404);
        }
        $moniteur->employe;
        return response()->json($moniteur,200);
    }

    public function addMoniteurt($ecole_id,Request $request)
    {   
        // var_dump($request->all());
        $ecole=AutoEcole::find($ecole_id);
        if(is_null($ecole)){
            return response()->json(['message'=> "ecole n'est pas trouvé"],404);
        }
       
        $employe = Employe::create([
            'auto_ecole_id'=>$ecole_id,
            'nom'=>$request->nom,
            'prenom'=>$request->prenom,
            'cin'=>$request->cin,
            'type'=>$request->type,
            'date_naissance'=>$request->date_naissance,
            'lieu_naissance'=>$request->lieu_naissance,
            'email'=>$request->email,
            'telephone'=>$request->telephone,
            'date_embauche'=>$request->date_embauche,
            'capn'=>$request->capn,
            'conduire'=>$request->conduire,
            'adresse'=>$request->adresse,
            'observations'=>$request->observations
        ]);
        $employe->save();

        if($request->carteMoniteur != ''){
            $namecarteMoniteur = time().'.' . explode('/', explode(':', substr($request->carteMoniteur, 0, strpos($request->carteMoniteur, ';')))[1])[1];
            \Image::make($request->carteMoniteur)->save(public_path('carteMoniteur/').$namecarteMoniteur);
        }
        $moniteurt = MoniteurTheorique::create([
            'employe_id'=>$employe->id,
            'auto_ecole_id'=>$ecole_id,
            'carteMoniteur'=>$namecarteMoniteur,
            'categorie'=> explode(",", $request->categorie)
        ]);
        $moniteurt->save();
        $ecole->moniteurTheoriques()->save($moniteurt);
        $moniteurt->employe;
        return response($moniteurt,201);
    }

    public function addMoniteurp($ecole_id,Request $request)
    {
        $ecole=AutoEcole::find($ecole_id);
        if(is_null($ecole)){
            return response()->json(['message'=> "ecole n'est pas trouvé"],404);
        }
        $employe = Employe::create([
            'auto_ecole_id'=>$ecole_id,
            'nom'=>$request->nom,
            'prenom'=>$request->prenom,
            'cin'=>$request->cin,
            'type'=>$request->type,
            'date_naissance'=>$request->date_naissance,
            'lieu_naissance'=>$request->lieu_naissance,
            'email'=>$request->email,
            'telephone'=>$request->telephone,
            'date_embauche'=>$request->date_embauche,
            'capn'=>$request->capn,
            'conduire'=>$request->conduire,
            'adresse'=>$request->adresse,
            'observations'=>$request->observations
        ]);
        $employe->save();
        if($request->carteMoniteur != ''){
            $namecarteMoniteur = time().'.' . explode('/', explode(':', substr($request->carteMoniteur, 0, strpos($request->carteMoniteur, ';')))[1])[1];
            \Image::make($request->carteMoniteur)->save(public_path('carteMoniteur/').$namecarteMoniteur);
        }
        $moniteurp = MoniteurPratique::create([
            'employe_id'=>$employe->id,
            'auto_ecole_id'=>$ecole_id,
            'carteMoniteur'=>$namecarteMoniteur,
            'categorie'=> explode(",", $request->categorie)
        ]);
        $moniteurp->save();
        $ecole->moniteurPratiques()->save($moniteurp);
        $moniteurp->employe;
        return response($moniteurp,201);
    }

}
