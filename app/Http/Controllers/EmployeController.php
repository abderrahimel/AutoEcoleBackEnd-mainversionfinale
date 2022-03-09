<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AutoEcole;
use App\Models\Employe;
use App\Models\MoniteurPratique;
use App\Models\MoniteurTheorique;

class EmployeController extends Controller
{
    public function getEmploye($ecole_id)
    {
        $ecole=AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"Auto Ecole n'est pas trouvée"],404);
        }
        $employes = $ecole->employes;
        return response()->json($employes,200);
        
    }

    public function getEmployeById($id)
    {
        $employe = Employe::find($id);
        if(is_null($employe)){
            return response()->json(['message'=> "Employé n'est pas trouvée"],404);
        }
        return response()->json($employe,200);
    }

    public function getEmployeByRole($role,$ecole_id)
    {
        $employe = $this->getEmploye($ecole_id)->original;
        $employe = $employe::where('role',$role);
        if(is_null($employe)){
            return response()->json(['message'=> "Employé n'est pas trouvée"],404);
        }
        return response()->json($employe,200);
    }


    public function addEmploye($ecole_id,Request $request)
    {
        $ecole=AutoEcole::find($ecole_id);
        $employe = new Employe($request->all()); 
        $ecole -> employes()->save($employe);
        if($request->role=="moniteur pratique"){
            $moniteurp = MoniteurPratique::create(["auto_ecole_id"=>$ecole->id,"employe_id"=>$employe->id]);
            $employe->MoniteurPratique;
        }
        if($request->role=="moniteur théorique"){
            $moniteurt = MoniteurTheorique::create(["auto_ecole_id"=>$ecole->id,"employe_id"=>$employe->id]);
            $employe->MoniteurTheorique;
        }
        return response()->json($employe,201);
    }


    public function updateEmploye($id,Request $request)
    {
        $employe=Employe::find($id);
        if (is_null($employe)) {
            return response()->json(['message'=>"Employé n'est pas trouvée"],404);
        }
        $employe->nom = $request -> nom;
        $employe->prenom = $request -> prenom;
        $employe->CIN = $request -> CIN;
        if($request->role != $employe->role){
            if ($request->role=="moniteur pratique") {
                $moniteurp = MoniteurPratique::create(["auto_ecole_id"=>$employe->auto_ecole_id,"employe_id"=>$employe->id]);
                $employe->MoniteurPratique;
                if($employe->role=="moniteur théorique"){
                    $ex_moniteur=MoniteurTheorique::where('employe_id',$employe->id)->delete();
                }
            }
            
            if ($request->role=="moniteur théorique") {
                $moniteurt = MoniteurTheorique::create(["auto_ecole_id"=>$employe->auto_ecole_id,"employe_id"=>$employe->id]);
                $employe->MoniteurTheorique;
                if($employe->role=="moniteur pratique"){
                    $ex_moniteur=MoniteurPratique::where('employe_id',$employe->id)->delete();     
                }
            }

            if($request->role !="moniteur théorique" && $request->role !="moniteur pratique"){
                if($employe->role=="moniteur théorique"){
                    $ex_moniteur=MoniteurTheorique::where('employe_id',$employe->id)->delete();
                } 
                if($employe->role=="moniteur pratique"){
                    $ex_moniteur=MoniteurPratique::where('employe_id',$employe->id)->delete();     
                    
                }
                dd("hoo");
            }
            
            
            $employe->role = $request -> role;
            
        }
        $employe->date_naissance = $request -> date_naissance;
        $employe->lieu_naissance = $request -> lieu_naissance;
        $employe->email = $request -> email;
        $employe->telephone = $request -> telephone;
        $employe->date_embauche = $request -> date_embauche;
        $employe->poste = $request -> poste;
        $employe->CAPN = $request -> CAPN;
        $employe->adresse = $request -> adresse;
        $employe->observations = $request -> observations;
        $employe->save();
        return response($employe,200);
    }

    public function deleteEmploye($id)
    {
        $employe = Employe::find($id);
        if (is_null($employe)) {
            return response()->json(['message'=>"Véhicule n'est pas trouvée"],404);
        }
        if($employe->role == "moniteur théorique"){
            $moniteur = MoniteurTheorique::where('employe_id',$id)->delete();
        }
        if($employe->role == "moniteur pratique"){
            $moniteur = MoniteurPratique::where('employe_id',$id)->delete();
        }
        $employe->delete();
        
        return response()->json(null,204);
    }
}
