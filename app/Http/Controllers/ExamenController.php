<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AutoEcole;
use App\Models\Examen;
use App\Models\Candidat;
use App\Models\CategoriePermis;


class ExamenController extends Controller
{
    public function getExamen($ecole_id)
    {
        $ecole=AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"Auto Ecole n'est pas trouvée"],404);
        }
        $examens = $ecole->examens;
        foreach ($examens as $examen) {
            $examen->candidat;
            $examen->permis;
        }
        return response()->json($examens,200);
        
    } 

    public function getExamenById($id)
    {
        $examen = Examen::find($id);
        if(is_null($examen)){
            return response()->json(['message'=> "Dossier n'est pas trouvée"],404);
        }
        $examen->candidat;
        $examen->permis;
        return response()->json($examen,200);
        
    }

    public function addExamen($ecole_id,Request $request)
    {
        $ecole=AutoEcole::find($ecole_id);
        $examen = new Examen($request->all()); 
        $ecole -> rapports()->save($examen);
        $examen->candidat;
        $examen->permis;
        return response($examen,201);
    }

    public function updateExamen($id,Request $request)
    {
        $examen=Examen::find($id);
        if (is_null($examen)) {
            return response()->json(['message'=>"Controle n'est pas trouvée"],404);
        }
        $examen->candidat_id = $request -> candidat_id;
        $examen->categorie_permis_id = $request -> categorie_permis_id;
        $examen->date_examen = $request -> date_examen;
        $examen->date_depot = $request -> date_depot;
        $examen->save();
        $examen->candidat;
        $examen->permis;
        return response($examen,200);
    }

    public function deleteExamen($id)
    {
        $examen = Examen::find($id);
        if (is_null($examen)) {
            return response()->json(['message'=>"Controle n'est pas trouvée"],404);
        }
        $examen->delete();
        return response()->json(null,204);
    }
}
