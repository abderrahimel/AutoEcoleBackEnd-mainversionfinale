<?php

namespace App\Http\Controllers;
use App\Models\AutoEcole;
use App\Models\CourPratique;
use App\Models\CourTheorique;
use Illuminate\Http\Request;

class CourController extends Controller
{
    public function getcourT($ecole_id)
    {
        $ecole=AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"Auto Ecole n'est pas trouvée"],404);
        }
        $cour = $ecole->courThoeriques;
        $cour ->moniteurTherique;
        return response()->json($cour,200);
        
    }

    public function getcourP($ecole_id)
    {
        $ecole=AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"Auto Ecole n'est pas trouvée"],404);
        }
        $cour = $ecole->courPratiques;
        $cour ->moniteurPratique;
        $cour ->vehicule;
        return response()->json($cour,200);
        
    }

    public function getcourTById($id)
    {
        $cour = CourTheorique::find($id);
        if(is_null($cour)){
            return response()->json(['message'=> "Cour n'est pas trouvée"],404);
        }
        $cour ->moniteurTherique;
        return response()->json($cour,200);
        
    }

    public function getcourPById($id)
    {
        $cour = CourPratique::find($id);
        if(is_null($cour)){
            return response()->json(['message'=> "Cour n'est pas trouvée"],404);
        }
        $cour ->moniteurPratique;
        $cour ->vehicule;
        return response()->json($cour,200);
        
    }

    public function addcourT($ecole_id,Request $request)
    {    
        $ecole=AutoEcole::find($ecole_id);
        $cour = CourTheorique::create([
            'auto_ecole_id'=>$ecole_id,
            'moniteur_theorique_id'=>$request->moniteur_theorique_id,
            'date'=>$request->date,
            'date_debut'=>$request->date_debut,
            'date_fin'=>$request->date_fin,
            'permis'=>$request->permis,
            'type'=>$request->type,
            'candidat'=>$request->candidat,
        ]);
        $cour->save();
        $ecole ->courTheriques()->save($cour);
        $cour ->moniteurTherique;
        return response($cour,201);
    }

    public function addcourP($ecole_id,Request $request)
    {   
        $ecole=AutoEcole::find($ecole_id);
        $cour = new CourPratique($request->all()); 
        $ecole -> courPratiques()->save($cour);
        $cour ->moniteurPratique;
        $cour ->vehicule;
        return response($cour,201);
    }

    public function updatecourT($id,Request $request)
    {
        $cour=CourTheorique::find($id);
        if (is_null($cour)) {
            return response()->json(['message'=>"Cour n'est pas trouvée"],404);
        }
        $cour->moniteur_theorique_id = $request -> moniteur_theorique_id;
        $cour->jour = $request -> jour;
        $cour->date_debut = $request -> date_debut;
        $cour->date_fin = $request -> date_fin;
        $cour->nombre_place = $request -> nombre_place;
        $cour->description = $request -> description;
        $cour->save();
        $cour ->moniteurTherique;
        return response($cour,200);
    }

    public function updatecourP($id,Request $request)
    {
        $cour=CourTheorique::find($id);
        if (is_null($cour)) {
            return response()->json(['message'=>"Cour n'est pas trouvée"],404);
        }
        $cour->moniteur_theorique_id = $request -> moniteur_theorique_id;
        $cour->jour = $request -> jour;
        $cour->date_debut = $request -> date_debut;
        $cour->date_fin = $request -> date_fin;
        $cour->nombre_place = $request -> nombre_place;
        $cour->description = $request -> description;
        $cour->vehicule_id = $request -> vehicule_id;
        $cour->save();
        $cour ->moniteurPratique;
        $cour ->vehicule;
        return response($cour,200);
    }

    public function deletecourT($id)
    {
        $cour = CourTheorique::find($id);
        if (is_null($cour)) {
            return response()->json(['message'=>"Cour n'est pas trouvée"],404);
        }
        $cour->delete();
        return response()->json(null,204);
    }

    public function deletecourP($id)
    {
        $cour = CourPratique::find($id);
        if (is_null($cour)) {
            return response()->json(['message'=>"Cour n'est pas trouvée"],404);
        }
        $cour->delete();
        return response()->json(null,204);
    }


}
