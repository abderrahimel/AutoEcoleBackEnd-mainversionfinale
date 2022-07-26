<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AutoEcole;
use App\Models\Examen;
use App\Models\Note;
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
            $examen->candidat->moniteurPratique->employe;
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
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"Auto Ecole n'est pas trouvée"],404);
        }
        $examen = Examen::create([
        'auto_ecole_id'=>$ecole_id,
        'candidat_id'=> $request->candidat_id,
        'categorie'=> $request->categorie,
        'date_examen'=> $request->date_examen,
        'date_depot'=> $request->date_depot,
        ]);
        $examen->save();
        $candidat = Candidat::find($request->candidat_id);
        $candidat->moniteur_pratique_id = $request->moniteur_pratique_id;
        $candidat->categorie = $request->categorie;
        $candidat->save();
        $ecole -> rapports()->save($examen);
        $examen->candidat;
        $examen->permis;
        return response($examen,201);
    }

    public function updateExamen($id,Request $request)
    {
        $examen=Examen::find($id);
        if (is_null($examen)) {
            return response()->json(['message'=>"examen n'est pas trouvée"],404);
        }
      
        $examen->candidat_id = $request->candidat_id;
        $examen->categorie = $request->categorie;
        $examen->date_examen = $request->date_examen;
        $examen->date_depot = $request->date_depot;
        $candidat = Candidat::find($request->candidat_id);
        $candidat->moniteur_pratique_id = $request->moniteur_pratique_id;
        $candidat->categorie = $request->categorie;
        $candidat->save();
        $examen->save();
        $examen->candidat;
        $examen->permis;
        return response($examen,200);
    }

    public function addNoteCandidat($id, Request $request){
        $examen=Examen::find($id);
        //  var_dump($request->all());
        if (is_null($examen)) {
            return response()->json(['message'=>"examen n'est pas trouvée"],404);
        }
        if(!is_null($request->etat_1)){
            $examen->etat_1 = $request->etat_1;
        }
        if(!is_null($request->etat_2)){
            $examen->etat_2 = $request->etat_2;
        }
        if(!is_null($request->note1)){
            $examen->note1 = $request->note1;
        }
        if(!is_null($request->note2)){
            $examen->note2 = $request->note2;
        }
        $examen->date_etat1 = $request->date_etat1;
        $examen->date_etat2 = $request->date_etat2;
        $examen->date_note1 = $request->date_note1;
        $examen->date_note2 = $request->date_note2;
        $categorieCandidat = $examen->categorie;
        $note = Note::where('auto_ecole_id', $examen->auto_ecole_id)->where('categorie', $categorieCandidat)->get();
        $moyen = $request->moyen;
        if((($examen->note1 >= $moyen ) or ($examen->note2 >= $moyen) ) && ( ($examen->etat_1 == 'valide') or ($examen->etat_2 == 'valide'))){
            $examen->resultat = 1;
        }else{
            $examen->resultat = 0;
        }
        $examen->save();
        return response($examen,200);
    }

    public function deleteExamen($id)
    {
        $examen = Examen::find($id);
        if (is_null($examen)) {
            return response()->json(['message'=>"Controle n'est pas trouvée"],404);
        }
        $examen->delete();
        return response()->json(['message'=>"examen deleted"],200);
    }
}
