<?php

namespace App\Http\Controllers;

use App\Models\AutoEcole;
use App\Models\Dossier;
use App\Models\MoniteurPratique;
use App\Models\MoniteurTheorique;
use Illuminate\Http\Request;

class DossierController extends Controller
{
    public function getDossier($ecole_id)
    {
        $ecole=AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"Auto Ecole n'est pas trouvée"],404);
        }
        $dossiers = $ecole->dossiers;
        foreach ($dossiers as $dossier) {
            $dossier->candiat;
            $dossier->moniteurTheorique;
            $dossier->moniteurPratique;
        }
        return response()->json($dossiers,200);
        
    }

    public function getDossierById($id)
    {
        $dossier = Dossier::find($id);
        if(is_null($dossier)){
            return response()->json(['message'=> "Dossier n'est pas trouvée"],404);
        }
        $dossier->candiat;
        $dossier->moniteurTheorique;
        $dossier->moniteurPratique;
        return response()->json($dossier,200);
        
    }

    public function addDossier($ecole_id,Request $request)
    {
        $ecole=AutoEcole::find($ecole_id);
        $dossier = new Dossier($request->all()); 
        $ecole -> dossiers()->save($dossier);
        $dossier->candiat;
        $dossier->moniteurTheorique;
        $dossier->moniteurPratique;
        return response($dossier,201);
    }

    public function updateControle($id,Request $request)
    {
        $dossier=Dossier::find($id);
        if (is_null($dossier)) {
            return response()->json(['message'=>"Dossier n'est pas trouvée"],404);
        }
        $dossier->candidat_id = $request -> candidat_id;
        $dossier->CIN = $request -> CIN;
        $dossier->type = $request -> type;
        $dossier->moniteur_theorique_id = $request -> moniteur_theorique_id;
        $dossier->moniteur_pratique_id = $request -> moniteur_pratique_id;
        $dossier->prix = $request -> prix;
        $dossier->prix_inscription = $request -> prix_inscription;
        $dossier->heures_pratiques = $request -> heures_pratiques;
        $dossier->heures_theoriques = $request -> heures_theoriques;
        $dossier->date_dossier = $request -> date_dossier;
        $dossier->prix_examen = $request -> prix_examen;
        $dossier->avance = $request -> avance;
        $dossier->save();
        $dossier->candiat;
        $dossier->moniteurTheorique;
        $dossier->moniteurPratique;
        return response($dossier,200);
    }

    public function deleteDossier($id)
    {
        $dossier = Dossier::find($id);
        if (is_null($dossier)) {
            return response()->json(['message'=>"Dossier n'est pas trouvée"],404);
        }
        $dossier->delete();
        return response()->json(null,204);
    }


}
