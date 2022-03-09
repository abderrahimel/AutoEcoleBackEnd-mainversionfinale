<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use Illuminate\Http\Request;
use App\Models\AutoEcole;
use App\Models\MoniteurPratique;
use App\Models\MoniteurTheorique;

class CandidatController extends Controller
{
    public function getCandidat($ecole_id)
    {
        $ecole=AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"Auto Ecole n'est pas trouvée"],404);
        }
        $candidats = $ecole->candidats;
        return response()->json($candidats,200);
        
    }

    public function getCandidatById($id)
    {
        $candidat= Candidat::find($id);
        if(is_null($candidat)){
            return response()->json(['message'=> "Candidat n'est pas trouvé"],404);
        }
        $candidat-> moniteurPratique; 
        $candidat-> moniteurTheorique;
        return response()->json($candidat,200);
        
    }

    public function addCandidat($ecole_id,Request $request)
    {
        $ecole=AutoEcole::find($ecole_id);
        $idt = (int) $request->moniteur_theorique_id;
        $idp = (int) $request->moniteur_pratique_id;
        $moniteurt =MoniteurTheorique::find($idt);
        $moniteurp =MoniteurPratique::find($idp);
        $candidat = new Candidat($request->all()); 
        $ecole -> candidats()->save($candidat);
        if($moniteurt != null && $moniteurp != null) {
            $moniteurt-> candidats()->save($candidat);
            $moniteurp-> candidats()->save($candidat); 
        }
        $candidat-> moniteurPratique; 
        $candidat-> moniteurTheorique;
        return response()->json($candidat,200);
    }

    public function updateCandidat($id,Request $request)
    {
        $candidat=Candidat::find($id);
        if (is_null($candidat)) {
            return response()->json(['message'=>"Employé n'est pas trouvée"],404);
        }
        $candidat->nom = $request -> nom;
        $candidat->prenom = $request -> prenom;
        $candidat->type = $request -> type;
        $candidat->CIN = $request -> CIN;
        $candidat->date_naissance = $request -> date_naissance;
        $candidat->lieu_naissance = $request -> lieu_naissance;
        $candidat->email = $request -> email;
        $candidat->nationalite = $request -> nationalite;
        $candidat->telephone = $request -> telephone;
        $candidat->email = $request -> email;
        $candidat->date_insc = $request -> date_insc;
        $candidat->permis = $request -> permis;
        $candidat->connaissance = $request -> connaissance;
        $candidat->adresse = $request -> adresse;
        $candidat->num_dossier = $request -> num_dossier;
        $candidat->langue = $request -> langue;
        $candidat->moniteur_theorique_id = $request -> moniteur_theorique_id;
        $candidat->moniteur_pratique_id = $request -> moniteur_pratique_id; 
        $candidat->vehicule_id = $request -> vehicule_id;
        $candidat->nbr_theo = $request -> nbr_theo;
        $candidat->nbr_pra = $request -> nbr_pra;
        $candidat->frais_insc = $request -> frais_insc;
        $candidat->frais_heure = $request -> frais_heure;
        $candidat->date_dossier = $request -> date_dossier;
        $candidat->frais_examen = $request -> frais_examen;
        $candidat->avance = $request -> avance;
        $candidat->save();
        $candidat-> moniteurPratique; 
        $candidat-> moniteurTheorique; 
        return response($candidat,200);
    }



    public function deleteCandidat($id)
    {
        $candidat = Candidat::find($id);
        if (is_null($candidat)) {
            return response()->json(['message'=>"Candidat n'est pas trouvée"],404);
        }
        $candidat->delete();
        return response()->json(null,204);
    }
}
