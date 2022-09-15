<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\AbsencePratiqueMoniteur;
use App\Models\AutoEcole;
use App\Models\MoniteurPratique;

class AbsencePratiqueMoniteurController extends Controller
{
    public function getAbsence($ecole_id)
    {
        $ecole=AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"Auto Ecole n'est pas trouvée"],404);
        }

        $absences = AbsencePratiqueMoniteur::where('auto_ecole_id', $ecole_id)->get();
        foreach ($absences as $absence) {
            $absence['moniteur'] = MoniteurPratique::find($absence->moniteur_pratique_id);
        }
        return response()->json($absences,200);
    }



    public function getAbsenceById($id)
    {
        $absence = AbsencePratiqueMoniteur::find($id);
        if(is_null($absence)){
            return response()->json(['message'=> "absence n'est pas trouvée"],404);
        }
        
        $absence['moniteur'] = MoniteurPratique::find($absence->moniteur_pratique_id);
        return response()->json($absence,200);
    }

    public function addAbsence($ecole_id,Request $request)
    {   
        $ecole=AutoEcole::find($ecole_id);
        if(is_null($ecole)){
            return response()->json(['message'=> "Ecole n'est pas trouvé"],404);
        }
        $absence = AbsencePratiqueMoniteur::create([
            'auto_ecole_id' =>$ecole_id,
            'moniteur_pratique_id'    => $request->moniteur_pratique_id,
            'type_absence'  =>$request->type_absence,
            'date_debut'    =>$request->date_debut,
            'date_fin'      =>$request->date_fin,
            'remarque'      =>$request->remarque,
        ]);
        $absence->save();
        return response($absence,201);
    }

    public function updateAbsence($id,Request $request)
    {
        $absence= AbsencePratiqueMoniteur::find($id);
        if(is_null($absence)){
            return response()->json(['message'=> "absence n'est pas trouvé"],404);
        }
        $absence->type_absence = $request->type_absence;
        $absence->date_debut   = $request->date_debut;
        $absence->date_fin     = $request->date_fin;
        $absence->remarque     = $request->remarque;
        $absence->save();
        return response($absence,200);
    }
    
    public function deleteAbsence($id)
    {
        $absence = AbsencePratiqueMoniteur::find($id);
        if (is_null($absence)) {
            return response()->json(['message'=>"absence n'est pas trouvée"],404);
        }
        $absence->delete();
        return response()->json(['message'=>"deleted absence:", "id"=> $id],200);
    }
}
