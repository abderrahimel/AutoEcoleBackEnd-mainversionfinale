<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\AutoEcole;
use App\Models\Employe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class AbsenceController extends Controller
{
    public function getAbsence($ecole_id)
    {
        $ecole=AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"Auto Ecole n'est pas trouvée"],404);
        }

        $absences = Absence::where('auto_ecole_id', $ecole_id)->get();
        foreach ($absences as $absence) {
            $absence->candidat;
            $absence->employe;
        }
        return response()->json($absences,200);
    }

    public function getAbsenceByemploye($employe_id)
    {
        $employe=Employe::find($employe_id);
        if (is_null($employe)) {
            return response()->json(['message'=>"Employé n'est pas trouvé"],404);
        }
        $absence = $employe->absences;
        return response()->json($absence,200);
    }

    public function getAbsenceById($id)
    {
        $absence = Absence::find($id);
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
            'employe_id'=>'required',
            'type_absence'=>'required',
            'date_debut'=>'required',
            'date_fin'=>'required',
            'remarque'=>'required',
        ]);
        
        if ($validator->fails()) {
            return new JsonResponse(['success' => false, 'message' => $validator->errors()], 422);
        }
        $absence = Absence::create([
            'auto_ecole_id' =>$ecole_id,
            'employe_id'    => $request->employe_id,
            'type_absence'  =>$request->type_absence,
            'date_debut'    =>$request->date_debut,
            'date_fin'      =>$request->date_fin,
            'remarque'      =>$request->remarque,
        ]);
        $ecole->absences()->save($absence);
        $absence->employe;
        return response($absence,201);
    }

    public function updateAbsence($id,Request $request)
    {
        $absence= Absence::find($id);
        if(is_null($absence)){
            return response()->json(['message'=> "absence n'est pas trouvé"],404);
        }
        $validator = Validator::make($request->all(), [
            'employe_id'=>'required',
            'type_absence'=>'required',
            'date_debut'=>'required',
            'date_fin'=>'required',
            'remarque'=>'required',
        ]);
        
        if ($validator->fails()) {
            return new JsonResponse(['success' => false, 'message' => $validator->errors()], 422);
        }
        $absence->employe_id   = $request->employe_id;
        $absence->type_absence = $request->type_absence;
        $absence->date_debut   = $request->date_debut;
        $absence->date_fin     = $request->date_fin;
        $absence->remarque     = $request->remarque;
        $absence->save();
        return response($absence,201);
    }
    
    public function deleteAbsence($id)
    {
        $absence = Absence::find($id);
        if (is_null($absence)) {
            return response()->json(['message'=>"absence n'est pas trouvée"],404);
        }
        $absence->delete();
        return response()->json(['message'=>"deleted absence:", "id"=> $id],200);
    }
}
