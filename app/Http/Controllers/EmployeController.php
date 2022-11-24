<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AutoEcole;
use App\Models\Employe;
use App\Models\MoniteurPratique;
use App\Models\MoniteurTheorique;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class EmployeController extends Controller
{
    public function getEmploye($ecole_id)
    {
        $ecole=AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"Auto Ecole n'est pas trouvée"],404);
        }
        $employes = Employe::where('auto_ecole_id', $ecole_id)->get();
        
        return response()->json($employes,200);
        
    }

    public function getEmployeById($id)
    {
        $employe = Employe::findOrFail($id);
        return response()->json($employe,200);
    }
    
    public function  addEmploye($ecole_id,Request $request)
    {
        $ecole=AutoEcole::find($ecole_id);
        if(is_null($ecole)){
            return response()->json(['message'=>"Employé n'est pas trouvée"],404);
        }
        $validator = Validator::make($request->all(), [
            'nom' =>'required',
            'prenom' => 'required',
            'cin' => 'required',
            'date_naissance' => 'required',
            'lieu_naissance' => 'required',
            'email' => 'required',
            'type' => 'required',
            'telephone' => 'required',
            'date_embauche' => 'required',
            'adresse' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()], 422);
        }
        $employe = Employe::create([
        'auto_ecole_id'=> $ecole_id,
        'nom'=> $request->nom,
        'prenom'=>$request->prenom,
        'cin'=>$request->cin,
        'type'=>$request->type,
        'date_naissance'=>$request->date_naissance,
        'lieu_naissance'=>$request->lieu_naissance,
        'email'=>$request->lieu_naissance,
        'telephone'=>$request->telephone,
        'date_embauche'=>$request->date_embauche,
        'capn'=>$request->capn,
        'conduire'=>$request->conduire,
        'adresse'=>$request->adresse,
        'observations'=>$request->observations,
        ]);
        $employe->save();
       
        if($request->type=="Moniteur Pratique"){
            $moniteurp = MoniteurPratique::create([
                "auto_ecole_id"=>$ecole->id,
                "employe_id"=>$employe->id
            ]);
            $moniteurp->save();
            $employe->MoniteurPratique;
        }
        if($request->role=="Moniteur Théorique"){
            $moniteurt = MoniteurTheorique::create([
                "auto_ecole_id"=>$ecole->id,
                "employe_id"=>$employe->id
            ]);
            $moniteurt->save();
            $employe->MoniteurTheorique;
        }
        return response()->json($employe,200);
    }


    public function updateEmploye($id,Request $request)
    {
        $employe = Employe::find($id);
        if (is_null($employe)) {
            return response()->json(['message'=>"Employé n'est pas trouvée"],404);
        }
        $validator = Validator::make($request->all(), [
            'nom' =>'required',
            'prenom' => 'required',
            'cin' => 'required',
            'date_naissance' => 'required',
            'lieu_naissance' => 'required',
            'email' => 'required',
            'type' => 'required',
            'telephone' => 'required',
            'date_embauche' => 'required',
            'adresse' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()], 422);
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

    public function deleteEmploye($id)
    {
        $employe = Employe::find($id);
        if (is_null($employe)) {
            return response()->json(['message'=>"Véhicule n'est pas trouvée"],404);
        }
        if($employe->type == "moniteur théorique"){
            $moniteur = MoniteurTheorique::where('employe_id',$id)->delete();
        }
        if($employe->type == "moniteur pratique"){
            $moniteur = MoniteurPratique::where('employe_id',$id)->delete();
        }
        $employe->delete();
        
        return response()->json(['message'=>"employee deleted"],200);
    }
}
