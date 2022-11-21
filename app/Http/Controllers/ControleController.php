<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AutoEcole;
use App\Models\Controle;
use App\Models\Employe;
use App\Models\Fournisseur;
use Illuminate\Support\Facades\Validator;
class ControleController extends Controller
{
    public function getControle($ecole_id)
    {
        $ecole=AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"Auto Ecole n'est pas trouvée"],404);
        }
        $controles = $ecole->controles;
        foreach ($controles as $controle) {
            $controle->employe;
            $controle->fournisseur;
            $controle->vehicule;
        }
        return response()->json($controles,200);
        
    }

    public function getControleById($id)
    {
        $controle = Controle::find($id);
        if(is_null($controle)){
            return response()->json(['message'=> "Controle n'est pas trouvée"],404);
        }
        $controle->employe;
        $controle->fournisseur;
        $controle->vehicule;
        return response()->json($controle,200);
    }

    public function addControle($ecole_id,Request $request)
    {
        $ecole=AutoEcole::find($ecole_id);
        $controle = new Controle($request->all()); 
        $ecole -> controles()->save($controle);
        $controle->employe;
        $controle->fournisseur;
        $controle->vehicule;
        return response($controle,201);
    }

    public function updateControle($id,Request $request)
    {
        $controle=Controle::find($id);
        if (is_null($controle)) {
            return response()->json(['message'=>"Controle n'est pas trouvée"],404);
        }
        $controle->employe_id = $request -> employe_id;
        $controle->etat_voiture = $request -> etat_voiture;
        $controle->fournisseur_id = $request -> fournisseur_id;
        $controle->vehicule_id = $request -> vehicule_id;
        $controle->date_vidange = $request -> date_vidange;
        $controle->date_suivante = $request -> date_suivante;
        $controle->duree_remembring = $request -> durée_remembring;
        $controle->km_actuelle = $request -> km_actuelle;
        $controle->type_huile = $request -> type_huile;
        $controle->last_km = $request -> last_km;
        $controle->ht = $request -> ht;
        $controle->taux = $request -> taux;
        $controle->ttc = $request -> ttc;
        $controle->tva = $request -> tva;
        $controle->description = $request -> description;
        $controle->filter = $request -> filter;
        $controle->type = $request -> type;
        $controle->save();
        $controle->employe;
        $controle->fournisseur;
        $controle->vehicule;
        return response($controle,200);
    }

    public function deleteControle($id)
    {
        $controle = Controle::find($id);
        if (is_null($controle)) {
            return response()->json(['message'=>"Controle n'est pas trouvée"],404);
        }
        $controle->delete();
        return response()->json(null,204);
    }


}
