<?php

namespace App\Http\Controllers;
use App\Models\AutoEcole;
use App\Models\MoniteurPratique;
use App\Models\MoniteurTheorique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MoniteurController extends Controller
{
    public function getMoniteurP($ecole_id)
    {
        $ecole=AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"Moniteur Pratique n'est pas trouvée"],404);
        }
        $moniteurs = MoniteurPratique::all()->where('auto_ecole_id',$ecole_id);
        $moniteurs =$ecole->moniteurPratiques;
        foreach ($moniteurs as $moniteur) {
            $moniteur->employe;
        }
        // $role = "moniteur pratique";
        // $moniteurP = DB::table('employes')
        // ->join('moniteur_pratiques', 'moniteur_pratiques.auto_ecole_id', '=', 'employes.auto_ecole_id')
        // ->select('moniteur_pratiques.id', 'employes.nom', 'employes.prenom')
        // ->get();

        return response()->json($moniteurs,200);
        
    }

    public function getMoniteurT($ecole_id)
    {
        $ecole=AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"Moniteur Théorique n'est pas trouvée"],404);
        }
        $moniteurs = MoniteurTheorique::all()->where('auto_ecole_id',$ecole_id);
        foreach ($moniteurs as $moniteur) {
            $moniteur->employe;
        }
        
        return response()->json($moniteurs,200);
        
    }

    
    public function getMoniteurpById($moniteur_id)
    {
        $moniteur=MoniteurPratique::find($moniteur_id);
        if (is_null($moniteur)) {
            return response()->json(['message'=>"Moniteur n'est pas trouvé"],404);
        }
        $moniteur->employe;
        return response()->json($moniteur,200);
    }

    public function getMoniteurtById($moniteur_id)
    {
        $moniteur=MoniteurTheorique::find($moniteur_id);
        if (is_null($moniteur)) {
            return response()->json(['message'=>"Moniteur n'est pas trouvé"],404);
        }
        $moniteur->employe;
        return response()->json($moniteur,200);
    }

    public function addMoniteurt($ecole_id,Request $request)
    {
        $ecole=AutoEcole::find($ecole_id);
        $moniteur = new MoniteurTheorique($request->all());
        $ecole -> moniteurTheoriques()->save($moniteur);
        $moniteur->employe;
        return response($moniteur,201);
    }

    public function addMoniteurp($ecole_id,Request $request)
    {
        $ecole=AutoEcole::find($ecole_id);
        $moniteur = new MoniteurPratique($request->all());
        $ecole -> moniteurPratiques()->save($moniteur);
        $moniteur->employe;
        return response($moniteur,201);
    }

}
