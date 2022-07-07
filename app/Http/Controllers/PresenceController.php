<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AutoEcole;
use App\Models\cour_pratique_presence;
use App\Models\cour_theorique_presence;
use App\Models\CourTheorique;
use App\Models\CourPratique;
use App\Models\MoniteurTheorique;
use App\Models\MoniteurPratique;
use App\Models\Employe;
use App\Models\Candidat;

class PresenceController extends Controller
{
    // public function getPresencecourP($auto_id){
    //     $ecole = AutoEcole::find($auto_id);
    //     if (is_null($ecole)) {
    //         return response()->json(['message'=>"auto ecole n'est pas trouvée"],404);
    //     }
    //     $presences = cour_pratique_presence::where('auto_ecole_id',$auto_id)->get();
    //     return response()->json($presences,200);
    // }
    public function getPresencecourP($ecole_id){
        $ecole = AutoEcole::find($ecole_id);
        if (is_null($ecole)) {
            return response()->json(['message'=>"auto ecole n'est pas trouvée"],404);
        }
        $presences = cour_pratique_presence::where('auto_ecole_id', $ecole_id)->get();
        //
        foreach($presences as $key => $presence) {
            $moniteur = MoniteurPratique::find($presence->moniteur_pratique_id);
            $employe = Employe::find($moniteur->employe_id);
            $presence->moniteur = $employe->nom . " " . $employe->prenom;
        }
        return response()->json($presences,200);
    }

    public function getPresencecourPById($id){
        $presence = cour_pratique_presence::find($id);
        if (is_null($presence)) {
            return response()->json(['message'=>"presence pratique n'est pas trouvée"],404);
        }
        return response()->json($presence,200);
    }
    // 
    public function getPresencecourTByIdCour($auto_id, $id){
        $cour = CourTheorique::find($id);
        if(is_null($cour)){
            return response()->json(['message'=> "Cour n'est pas trouvée"],404);
        }
        $courPresenceT = cour_theorique_presence::where('auto_ecole_id',$auto_id)->where('cour_theorique_id',$id)->first();
        return response()->json($courPresenceT,200);
    }
    public function getPresencecourPByIdCour($auto_id, $id){
        $cour = CourPratique::find($id);
        if(is_null($cour)){
            return response()->json(['message'=> "Cour n'est pas trouvée"],404);
        }
       $courPresenceP = cour_pratique_presence::where('auto_ecole_id',$auto_id)->where('cour_pratique_id',$id)->first();
        return response()->json($courPresenceP,200);
    }
    public function getPresencecourTById($id){
        $presence = cour_theorique_presence::find($id);
        if (is_null($presence)) {
            return response()->json(['message'=>"presence theorique n'est pas trouvée"],404);
        }
        return response()->json($presence,200);
    }
    public function updateCourPresenceT($id, Request $request){
        $cour_theorique_presence = cour_theorique_presence::find($id);
        if (is_null($cour_theorique_presence)) {
            return response()->json(['message'=>"presence  n'est pas trouvée"],404);
        }
        $cour_theorique_presence->presence = $request->presence;
        $cour_theorique_presence->save();
        return response()->json($cour_theorique_presence,200);
    }

    public function updateCourPresenceP($id,Request $request){
        $cour_pratique_presence = cour_pratique_presence::find($id);
        if (is_null($cour_pratique_presence)) {
            return response()->json(['message'=>"presence pratique n'est pas trouvée"],404);
        }
        
        $cour_pratique_presence->presence = $request->presence;
        $cour_pratique_presence->save();
        return response()->json($cour_pratique_presence,200);
    }

    public function getPresencecourT($ecole_id){
        $ecole = AutoEcole::find($ecole_id);
        if (is_null($ecole)) {
            return response()->json(['message'=>"auto ecole n'est pas trouvée"],404);
        }
        $presences = cour_theorique_presence::where('auto_ecole_id', $ecole_id)->get();
        //
        foreach($presences as $key => $presence) {
            $moniteur = MoniteurTheorique::find($presence->moniteur_theorique_id);
            $employe = Employe::find($moniteur->employe_id);
            $presence->moniteur = $employe->nom . " " . $employe->prenom;
        }
        //
        foreach ($presences as $presence) {
            $listCandidat = ' ';
            $candidats = $presence->candidat;
            foreach($presence->candidat as $id){
                 $candidat = Candidat::find($id);
                 $listCandidat = $listCandidat . ' ' . $candidat->nom_fr . ' ' . $candidat->prenom_fr . ',';
            }
            $presence['candidats'] = $listCandidat;
       }
        //
        return response()->json($presences,200);
    }

    public function deletePresencecourTById($id){
        $presence = cour_theorique_presence::find($id);
       if (is_null($presence)) {
            return response()->json(['message'=>"presence cours n'est pas trouvée"],404);
         }
        $presence->delete();
        return response()->json(['message'=>"presence Cour theorique deleted"],200);
    }

    public function deletePresencecourPById($id){
        $presence = cour_pratique_presence::find($id);
        if (is_null($presence)) {
            return response()->json(['message'=>"presence cours n'est pas trouvée"],404);
        }
        $presence->delete();
        return response()->json(['message'=>"presence Cour pratique deleted"],200);
     }

    public function addPresencecourP($id, Request $request){
        $courP = CourPratique::find($id);
        if (is_null($courP)) {
            return response()->json(['message'=>"cours pratique  n'est pas trouvée"],404);
        }
        $courPresence = cour_pratique_presence::create([
            'auto_ecole_id'=>$courP->auto_ecole_id,
            'moniteur_pratique_id'=>$courP->moniteur_pratique_id,
            'cour_pratique_id'=>$courP->id,
            'date'=>$courP->date,
            'heure_debut'=>$courP->date_debut,
            'heure_fin'=>$courP->date_fin,
            'categorie'=>$courP->permis,
            'candidat'=>$request->candidat,
            'presence'=>$request->presence,
        ]);
        $courPresence->save();
        $courP->candidat = $request->candidat;
        $courP->save();
    }

    public function addPresencecourT($id, Request $request){
        $courT = CourTheorique::find($id);
        if (is_null($courT)) {
            return response()->json(['message'=>"cours theorique  n'est pas trouvée"],404);
        }

        $courPresence = cour_theorique_presence::create([
            'auto_ecole_id'=>$courT->auto_ecole_id,
            'moniteur_theorique_id'=>$courT->moniteur_theorique_id,
            'cour_theorique_id'=>$courT->id,
            'date'=>$courT->date,
            'heure_debut'=>$courT->date_debut,
            'heure_fin'=>$courT->date_fin,
            'categorie'=>$courT->permis,
            'candidat'=>$request->candidat,
            'presence'=>$request->presence,
        ]);
        $courPresence->save();
        $courT->candidat = $request->candidat;
        $courT->save();
    }
}
