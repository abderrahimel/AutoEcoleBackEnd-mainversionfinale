<?php

namespace App\Http\Controllers;
use App\Models\AutoEcole;
use App\Models\CourPratique;
use App\Models\CourTheorique;
use App\Models\MoniteurTheorique;
use App\Models\cour_theorique_presence;
use App\Models\cour_pratique_presence;
use App\Models\Employe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourController extends Controller
{
    public function getcourT($ecole_id)
    {  
        $ecole=AutoEcole::find($ecole_id);
        $cours = $ecole->courTheriques;
        foreach ($cours as $cour) {
            $id = MoniteurTheorique::find($cour->moniteur_theorique_id)->employe_id;
            $cour->moniteurth = Employe::find($id);
        }
       
        return response()->json($cours,200);
        
    }

    public function getcourP($ecole_id)
    {
        $ecole=AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"Auto Ecole n'est pas trouvée"],404);
        }
        $cour = $ecole->courPratiques;
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
        $array = array_map('intval', explode(',', $request->candidat));
        
        foreach( $array as $val){
            if($val != null){
                $items[] = $val;
            }
        }
      
        $cour = CourTheorique::create([
            'auto_ecole_id'=>$ecole_id,
            'date'=>$request->date,
            'date_debut'=>$request->date_debut,
            'date_fin'=>$request->date_fin,
            'permis'=>$request->permis,
            'type'=>$request->type,
            'candidat'=>$items,
            'moniteur_theorique_id'=>$request->moniteur_theorique_id
        ]);
        $cour->save();
        $courPresence = cour_theorique_presence::create([
            'auto_ecole_id'=>$ecole_id,
            'moniteur_theorique_id'=>$request->moniteur_theorique_id,
            'cour_theorique_id'=>$cour->id,
            'date'=>$request->date,
            'heure_debut'=>$request->date_debut,
            'heure_fin'=>$request->date_fin,
            'categorie'=>$request->permis,
            'candidat'=>$items,
            'presence'=>$request->presence,
        ]);
        $courPresence->save();
        $cour->moniteurTherique;
        return response($cour,201);
    }

    public function addcourP($ecole_id,Request $request)
    {   
        $ecole=AutoEcole::find($ecole_id);
        $array = array_map('intval', explode(',', $request->candidat));
        
        foreach( $array as $val){
            if($val != null){
                $items[] = $val;
            }
        }

         $cour = CourPratique::create([
            'auto_ecole_id'=>$ecole_id,
            'moniteur_pratique_id'=>$request->moniteur_pratique_id,
            'date'=>$request->date,
            'type'=>$request->type,
            'date_debut'=>$request->date_debut,
            'date_fin'=>$request->date_fin,
            'permis'=>$request->permis,
            'candidat'=>$items,
            'vehicule_id'=>$request->vehicule_id
         ]);
        $ecole -> courPratiques()->save($cour);
        $courPresence = cour_pratique_presence::create([
            'auto_ecole_id'=>$ecole_id,
            'moniteur_pratique_id'=>$request->moniteur_pratique_id,
            'cour_pratique_id'=>$cour->id,
            'date'=>$request->date,
            'heure_debut'=>$request->date_debut,
            'heure_fin'=>$request->date_fin,
            'categorie'=>$request->permis,
            'candidat'=>$items,
            'presence'=>$request->presence,
        ]);
        $courPresence->save();
        $cour ->moniteurPratique;
        $cour ->vehicule;
        return response($cour,201);
    }

    public function updatecourT($auto_id, $id,Request $request)
    {   
        $cour = CourTheorique::find($id);
        if (is_null($cour)) {
            return response()->json(['message'=>"Cour n'est pas trouvée"],404);
        }
        $array = array_map('intval', explode(',', $request->candidat));
        
        foreach( $array as $val){
            if($val != null){
                $items[] = $val;
            }
        }
        $cour->moniteur_theorique_id = $request->moniteur_theorique_id;
        $cour->date = $request->date;
        $cour->type = $request->type;
        $cour->date_debut = $request->date_debut;
        $cour->date_fin = $request->date_fin;
        $cour->permis = $request->permis;
        $cour->candidat = $items;
        $cour->save();
        $presenceCourT = cour_theorique_presence::where('auto_ecole_id',$auto_id)->where('cour_theorique_id',$cour->id)->first();
        $presenceCourT->presence = $request->presence;
        $presenceCourT->candidat = $items;
        $presenceCourT->save();
        $cour ->moniteurTherique;
        return response($presenceCourT,200);
    }

    public function updatecourP($auto_id, $id,Request $request)
    {
        $cour=CourPratique::find($id);
        if (is_null($cour)) {
            return response()->json(['message'=>"Cour n'est pas trouvée"],404);
        }
        $array = array_map('intval', explode(',', $request->candidat));
        
        foreach( $array as $val){
            if($val != null){
                $items[] = $val;
            }
        }
        $cour->moniteur_pratique_id = $request->moniteur_pratique_id;
        $cour->date = $request->date;
        $cour->type = $request->type;
        $cour->date_debut = $request->date_debut;
        $cour->date_fin = $request->date_fin;
        $cour->permis = $request->permis;
        $cour->candidat = $items;
        $cour->vehicule_id = $request->vehicule_id;
        $cour->save();
        $presenceCourP = cour_pratique_presence::where('auto_ecole_id',$auto_id)->where('cour_pratique_id',$id)->first();
        $presenceCourP->presence = $request->presence;
        $presenceCourP->candidat = $items;
        $presenceCourP->save();
        $cour ->moniteurPratique;
        $cour ->vehicule;
        return response()->json($cour,200);
    }

    public function deletecourT($id)
    {
        $cour = CourTheorique::find($id);
        if (is_null($cour)) {
            return response()->json(['message'=>"Cour n'est pas trouvée"],404);
        }
        $cour->delete();
        return response()->json(['message'=>"Cour theorique deleted"],200);
    }

    public function deletecourP($id)
    {
        $cour = CourPratique::find($id);
        if (is_null($cour)) {
            return response()->json(['message'=>"Cour n'est pas trouvée"],404);
        }
        $cour->delete();
        return response()->json(['message'=>"Cour pratique deleted"],200);
    }


}
