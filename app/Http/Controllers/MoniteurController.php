<?php

namespace App\Http\Controllers;
use App\Models\AutoEcole;
use App\Models\MoniteurPratique; 
use App\Models\Employe; 
use App\Models\MoniteurTheorique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class MoniteurController extends Controller
{
    public function getMoniteurPtrash($ecole_id)
    {
        $ecole=AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"Moniteur Pratique n'est pas trouvée"],404);
        }
        $moniteurs = MoniteurPratique::where('auto_ecole_id', $ecole_id)->get();
        

        return response()->json($moniteurs,200);
        
    }
    public function count($ecole_id){
       $countT =  MoniteurTheorique::where('auto_ecole_id', $ecole_id)->where('deleted_at','=', null)->count();
       $countP =  MoniteurPratique::where('auto_ecole_id', $ecole_id)->where('deleted_at','=', null)->count();
       return response()->json(['countT'=>$countT, 'countP'=>$countP],200);
    }
    public function getMoniteurP($ecole_id){
        $ecole=AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"Moniteur Pratique n'est pas trouvée"],404);
        }
        $moniteurs = MoniteurPratique::where('auto_ecole_id', $ecole_id)->get();

        return response()->json($moniteurs,200);
    }
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

          
            if($request->carteMoniteur != ''){
                $namecarteMoniteur = time().'.' . explode('/', explode(':', substr($request->carteMoniteur, 0, strpos($request->carteMoniteur, ';')))[1])[1];
                \Image::make($request->carteMoniteur)->save(public_path('carteMoniteur/').$namecarteMoniteur);
                $moniteurt->namecarteMoniteur = $namecarteMoniteur;
                $moniteurt->save();
            }
           
            $moniteurt->nom = $request->nom;
            $moniteurt->prenom = $request->prenom;
            $moniteurt->cin    = $request->cin;
            $moniteurt->type   = $request->type;
            $moniteurt->date_naissance = $request->date_naissance;
            $moniteurt->lieu_naissance = $request->lieu_naissance;
            $moniteurt->email = $request->email;
            $moniteurt->telephone = $request->telephone;
            $moniteurt->date_embauche = $request->date_embauche;
            $moniteurt->capn = $request->capn;
            $moniteurt->conduire = $request->conduire;
            $moniteurt->adresse = $request->adresse;
            $moniteurt->observations = $request->observations;
            $moniteurt->categorie =  explode(",", $request->categorie);
            $moniteurt->save();
            return response()->json(['message'=>'updated successfully moniteur theorique', 'data'=>$moniteurt],200);
        
    }

    public function updateMoniteurp($id, Request $request){

        $moniteurp = MoniteurPratique::find($id);
         if(is_null($moniteurp)){
            return response()->json(['message'=> "moniteur pratique n'est pas trouvé"],404);
        }

        if($request->carteMoniteur != ''){
            $namecarteMoniteur = time().'.' . explode('/', explode(':', substr($request->carteMoniteur, 0, strpos($request->carteMoniteur, ';')))[1])[1];
            \Image::make($request->carteMoniteur)->save(public_path('carteMoniteur/').$namecarteMoniteur);
            $moniteurp->namecarteMoniteur = $namecarteMoniteur;
        }
        $moniteurp->nom = $request->nom;
        $moniteurp->prenom =$request->prenom;
        $moniteurp->cin    = $request->cin;
        $moniteurp->type   = $request->type;
        $moniteurp->date_naissance = $request->date_naissance;
        $moniteurp->lieu_naissance = $request->lieu_naissance;
        $moniteurp->email = $request->email;
        $moniteurp->telephone = $request->telephone;
        $moniteurp->date_embauche = $request->date_embauche;
        $moniteurp->capn = $request->capn;
        $moniteurp->conduire = $request->conduire;
        $moniteurp->adresse = $request->adresse;
        $moniteurp->observations = $request->observations;
        $moniteurp->categorie =  explode(",", $request->categorie);
        $moniteurp->save();
        return response()->json(['message'=>'updated succesfully moniteur pratique', 'data'=>$moniteurp],200);
    
}
    public function getMoniteurT($ecole_id)
    {
        $ecole=AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"Moniteur Théorique n'est pas trouvée"],404);
        }
        $moniteurs = MoniteurTheorique::where('auto_ecole_id',$ecole_id)->get();
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
        $ecole=AutoEcole::find($ecole_id);
        if(is_null($ecole)){
            return response()->json(['message'=> "ecole n'est pas trouvé"],404);
        }
        $validator = Validator::make($request->all(), [
            'nom'=>'required',
            'prenom'=>'required',
            'cin'=>'required',
            'type'=>'required',
            'date_naissance'=>'required',
            'lieu_naissance'=>'required',
            'email'=>'required',
            'telephone'=>'required',
            'date_embauche'=>'required',
            'capn'=>'required',
            'conduire'=>'required',
            'adresse'=>'required',
            'categorie'=>'required',
        ]);
        $namecarteMoniteur = null;
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()], 422);
        }
        if($request->carteMoniteur != ''){
            $namecarteMoniteur = time().'.' . explode('/', explode(':', substr($request->carteMoniteur, 0, strpos($request->carteMoniteur, ';')))[1])[1];
            \Image::make($request->carteMoniteur)->save(public_path('carteMoniteur/').$namecarteMoniteur);
        }
        $moniteurt = MoniteurTheorique::create([
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
            'observations'=>$request->observations,
            'carteMoniteur'=>$namecarteMoniteur,
            'categorie'=> explode(",", $request->categorie)
        ]);
        $moniteurt->save();
        return response()->json(['message'=>'succesfully created new moniteur pratique', 'data'=>$moniteurt],200);
    }

    public function addMoniteurp($ecole_id,Request $request)
    {
        $ecole = AutoEcole::find($ecole_id);
        if(is_null($ecole)){
            return response()->json(['message'=> "ecole n'est pas trouvé"],404);
        }
        $validator = Validator::make($request->all(), [
            'nom'=>'required',
            'prenom'=>'required',
            'cin'=>'required',
            'type'=>'required',
            'date_naissance'=>'required',
            'lieu_naissance'=>'required',
            'email'=>'required',
            'telephone'=>'required',
            'date_embauche'=>'required',
            'capn'=>'required',
            'conduire'=>'required',
            'adresse'=>'required',
             'categorie'=>'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()], 422);
        }
        $namecarteMoniteur = null;
        if($request->carteMoniteur != ''){
            $namecarteMoniteur = time().'.' . explode('/', explode(':', substr($request->carteMoniteur, 0, strpos($request->carteMoniteur, ';')))[1])[1];
            \Image::make($request->carteMoniteur)->save(public_path('carteMoniteur/').$namecarteMoniteur);
        }
        $moniteurp = MoniteurPratique::create([
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
            'observations'=>$request->observations,
            'carteMoniteur'=>$namecarteMoniteur,
            'categorie'=> explode(",", $request->categorie)
        ]);
        $moniteurp->save();
        return response()->json(['message'=>'succesfully created new moniteur pratique', 'data'=>$moniteurp],200);
    }

}
