<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AutoEcole;
use App\Models\PaimentCandidat;
use Illuminate\Support\Facades\DB;

class PaimentCandidatController extends Controller
{
     public function addPaiementCandidat($ecole_id, $id_candidat,Request $request){
        $ecole = AutoEcole::find($ecole_id);

        // var_dump(intval($ecole_id), intval($id_candidat));
        // var_dump($request->all());
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"Auto Ecole n'est pas trouvée"],404);
        }
        $name_image = '';
        if($request->image != ''){
            $name_image = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->save(public_path('image_paimentCandidat/').$name_image);
        }

        $paimentCandidat = PaimentCandidat::create([
        'auto_ecole_id'=>$ecole_id,
        'candidat_id'=> $id_candidat,
        'date'=> $request->date,
        'montant'=> $request->montant,
        'nom_banque'=> $request->banque,
        'type_p'=> $request->type,
        'numero'=> $request->numero,
        'remarque'=> $request->remarque,
        'image'=> $name_image,
        ]);
        $ecole->paimentCandidat()->save($paimentCandidat);
        return response($paimentCandidat,200);
    }
   public function updatePaiementCandidat($id, Request $request){
          $paimentCandidat = PaimentCandidat::find($id);
          if (is_null($paimentCandidat)) {
            return response()->json(['message'=>"paiment candidat doesn't exist"],404);
          }
          $name_image = '';
          if($request->image != ''){
            $name_image = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->save(public_path('image_paimentCandidat/').$name_image);
        }
        
        $paimentCandidat->date = $request->date;
        $paimentCandidat->montant = $request->montant;
        $paimentCandidat->nom_banque = $request->banque;
        $paimentCandidat->type_p = $request->type;
        $paimentCandidat->numero = $request->numero;
        $paimentCandidat->remarque = $request->remarque;
        $paimentCandidat->image =  $name_image;
        $paimentCandidat->save();
        return response()->json($paimentCandidat,200);
   }

   public function getPaiementCandidats($ecole_id){
         $paiments = PaimentCandidat::where('auto_ecole_id', $ecole_id)->get();
         if (is_null($paiments)) {
            return response()->json(['message'=>"paiment candidats n'est pas trouvée"],404);
        }
        foreach($paiments as $paiment){
            $paiment->candidat;
          }
         return response()->json($paiments,200);
   }

    public function getPaiementCandidat($ecole_id, $id_candidat,Request $request){
        $ecole = AutoEcole::find($ecole_id);
        if (is_null($ecole_id)) {
            return response()->json(['message'=>"Auto Ecole n'est pas trouvée"],404);
        }
       
        $paiment = PaimentCandidat::where('candidat_id', $id_candidat)->get();
        return response()->json($paiment,200);
    }

    public function getPaiementCandidatById($id){
        $paiementCandidat = PaimentCandidat::find($id);
        if (is_null($paiementCandidat)) {
            return response()->json(['message'=>"Paiement candidat n'est pas trouvé"],404);
        }
        return response()->json($paiementCandidat,200);
    }

    public function deletePaiementCandidat($id){
        $paiementCandidat = PaimentCandidat::find($id);
        if (is_null($paiementCandidat)) {
            return response()->json(['message'=>"Paiement candidat n'est pas trouvé"],404);
        }
        $paiementCandidat->delete();
        return response()->json(['message'=>"Paiement candidat deleted"],200);
    }
}