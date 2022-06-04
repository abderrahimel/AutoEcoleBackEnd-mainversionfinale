<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\AutoEcole;
use App\Models\Employe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsenceController extends Controller
{
    public function getAbsence($ecole_id)
    {
        $ecole=AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"Auto Ecole n'est pas trouvée"],404);
        }
        $absence = $ecole->absences;
        $absences = DB::table('absences')->where('auto_ecole_id', $ecole_id)->get();
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
        $absence = Absence::create([
            'auto_ecole_id'=>$ecole_id,
            'employe_id'=> $request->employe_id,
            'type_absence'=>$request->type_absence,
            'date_debut'=>$request->date_debut,
            'date_fin'=>$request->date_fin,
            'remarque'=>$request->remarque,
        ]);
        $ecole->absences()->save($absence);
        $absence->employe;
        return response($absence,201);
    }

    public function updateAbsence($id,Request $request)
    {
        $absence= Absence::find($id);
        if (is_null($absence)) {
            return response()->json(['message'=>"salaire n'est pas trouvée"],404);
        }
        $absence->employe_id = $request -> employe_id;
        $absence->justfication = $request -> justfication;
        $absence->date_debut = $request -> date_debut;
        $absence->date_fin = $request -> date_fin;
        $absence->remarques = $request -> remarques;
        if($request->hasFile('image')){
            $completeFileName = $request->file('image')->getClientOriginalName();
            $fileNameOnly= pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $compPic= str_replace(' ','_',$fileNameOnly).'-'.rand().'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/absence',$compPic);
            $absence->image = $compPic;
            $absence->save();
        } 
        $absence->save();
        return response($absence,200);
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
