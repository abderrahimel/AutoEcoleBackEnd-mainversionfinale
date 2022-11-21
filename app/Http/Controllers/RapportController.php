<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employe;
use App\Models\AutoEcole; 
use App\Models\Rapport;
use Illuminate\Support\Facades\Validator;


class RapportController extends Controller
{
    
    public function getRapport($ecole_id)
    {
        $ecole=AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"Auto Ecole n'est pas trouvée"],404);
        }
        $rapports = $ecole->dossiers;
        foreach ($rapports as $rapport) {
            $rapport->employe;
        }
        return response()->json($rapports,200);
        
    }

    public function getRapportById($id)
    {
        $rapport = Rapport::find($id);
        if(is_null($rapport)){
            return response()->json(['message'=> "Dossier n'est pas trouvée"],404);
        }
        $rapport->employe;
        return response()->json($rapport,200);
        
    }

    public function addRapport($ecole_id,Request $request)
    {
        $ecole=AutoEcole::find($ecole_id);
        $rapport = new Rapport($request->all()); 
        $ecole -> rapports()->save($rapport);
        $rapport->employe;
        return response($rapport,201);
    }

    public function updateRapport($id,Request $request)
    {
        $rapport=Rapport::find($id);
        if (is_null($rapport)) {
            return response()->json(['message'=>"Controle n'est pas trouvée"],404);
        }
        $rapport->date = $request -> date;
        $rapport->employe_id = $request -> employe_id;
        $rapport->nombre_cours = $request -> nombre_cours;
        $rapport->valeur_carburant = $request -> valeur_carburant;
        $rapport->km_aller = $request -> km_aller;
        $rapport->km_retour = $request -> km_retour;
        $rapport->description = $request -> description;
        $rapport->save();
        $rapport->employe;
        return response($rapport,200);
    }

    public function deleteRapport($id)
    {
        $rapport = Rapport::find($id);
        if (is_null($rapport)) {
            return response()->json(['message'=>"Controle n'est pas trouvée"],404);
        }
        $rapport->delete();
        return response()->json(null,204);
    }
    

}
