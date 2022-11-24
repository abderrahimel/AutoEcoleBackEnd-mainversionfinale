<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\AbsenceTheoriqueMoniteur;
use App\Models\AutoEcole;
use App\Models\MoniteurTheorique;
use Illuminate\Support\Facades\Validator;

class AbsenceTheoriqueMoniteurController extends Controller
{
    public function getAbsence($ecole_id)
    {
        $ecole=AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"Auto Ecole n'est pas trouvée"],404);
        }

        $absences = AbsenceTheoriqueMoniteur::where('auto_ecole_id', $ecole_id)->get();
        foreach ($absences as $absence) {
            $absence['moniteur'] = MoniteurTheorique::find($absence->moniteur_theorique_id);
        }
        return response()->json($absences,200);
    }



    public function getAbsenceById($id)
    {
        $absence = AbsenceTheoriqueMoniteur::find($id);
        if(is_null($absence)){
            return response()->json(['message'=> "absence n'est pas trouvée"],404);
        }
        

        return response()->json($absence,200);
    }

    public function addAbsence($ecole_id,Request $request)
    {   
        $ecole=AutoEcole::find($ecole_id);
        if(is_null($ecole)){
            return response()->json(['message'=> "Ecole n'est pas trouvé"],404);
        }
        $validator = Validator::make($request->all(), [
            'moniteur_theorique_id'=>'required',
            'type_absence'=>'required',
            'date_debut'=>'required',
            'date_fin'=>'required',
            'remarque'=>'required',
        ]);
       
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()], 422);
        }
        $absence = AbsenceTheoriqueMoniteur::create([
            'auto_ecole_id' =>$ecole_id,
            'moniteur_theorique_id'    => $request->moniteur_theorique_id,
            'type_absence'  =>$request->type_absence,
            'date_debut'    =>$request->date_debut,
            'date_fin'      =>$request->date_fin,
            'remarque'      =>$request->remarque,
        ]);
        $absence->save();
        return response()->json(['message'=>'added absence for moniteur theorique', 'data'=>$absence],200);
    }

    public function updateAbsence($id,Request $request)
    {   
        $absence= AbsenceTheoriqueMoniteur::find($id);
        if(is_null($absence)){
            return response()->json(['message'=> "absence moniteur theorique n'est pas trouvé"],404);
        }
        $validator = Validator::make($request->all(), [
            'type_absence'=>'required',
            'date_debut'=>'required',
            'date_fin'=>'required',
            'remarque'=>'required',
        ]);
       
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()], 422);
        }
        $absence->type_absence = $request->type_absence;
        $absence->date_debut   = $request->date_debut;
        $absence->date_fin     = $request->date_fin;
        $absence->remarque     = $request->remarque;
        $absence->save();
        return response()->json($request->all(),200);
    }
    
    public function deleteAbsence($id)
    {
        $absence = AbsenceTheoriqueMoniteur::find($id);
        if (is_null($absence)) {
            return response()->json(['message'=>"absence n'est pas trouvée"],404);
        }
        $absence->delete();
        return response()->json(['message'=>"deleted absence moniteur theorique:"],200);
    }
}
