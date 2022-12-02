<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use Illuminate\Http\Request;
use App\Models\AutoEcole;
use App\Models\MoniteurPratique;
use App\Models\MoniteurTheorique;
use App\Models\Vehicule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CandidatController extends Controller
{
    public function getCandidat($ecole_id)
    {
        $ecole = AutoEcole::find($ecole_id);
        if(is_null($ecole)){
            return response()->json(['message'=>'ecole  doesn\'t exist'],200);
        }
        
        $candidats =  Candidat::withTrashed()->where('auto_ecole_id', $ecole_id)->get();
        foreach($candidats as $candidat){
            if($candidat->deleted_at != null){
                if($candidat->image){
                    $candidat->image = 'http://' . request()->getHttpHost() . '/' . 'candidat_img/' .  $candidat->image; 
                }
                $candidat->prenom_fr = $candidat->prenom_fr . ' (s)';
                $candidat->prenom_ar = $candidat->prenom_ar . ' (s)';    
            }
    }
        return response()->json($candidats,200);
        
    }
    public function getCandidatsBasic($ecole_id)
    {
        $ecole = AutoEcole::find($ecole_id);
        if(is_null($ecole)){
            return response()->json(['message'=>'ecole  doesn\'t exist'],200);
        }
        
        $candidats =  Candidat::where('auto_ecole_id', $ecole_id)->where('type_formation', 'basic')->get();
        foreach($candidats as $candidat){
            if($candidat->image){
                $candidat->image = 'http://' . request()->getHttpHost() . '/' . 'candidat_img/' .  $candidat->image; 
            }
            $candidat['MoniteurTheorique'] = MoniteurTheorique::find($candidat->moniteur_theorique_id);
            $candidat['MoniteurPratique']  = MoniteurPratique::find($candidat->moniteur_pratique_id);
            $candidat['vehicule'] = Vehicule::find($candidat->vehicule_id);
    }
    
        return response()->json($candidats,200);
        
    }
    public function getCandidatsSupplementaire($ecole_id)
    {
        $ecole = AutoEcole::find($ecole_id);
        if(is_null($ecole)){
            return response()->json(['message'=>'ecole  doesn\'t exist'],200);
        }
        
        $candidats =  Candidat::where('auto_ecole_id', $ecole_id)->where('type_formation', 'supplementaire')->get();
        foreach($candidats as $candidat){
            if($candidat->image){
                $candidat->image = 'http://' . request()->getHttpHost() . '/' . 'candidat_img/' .  $candidat->image; 
            }
            $candidat['MoniteurTheorique'] = MoniteurTheorique::find($candidat->moniteur_theorique_id);
            $candidat['MoniteurPratique']  = MoniteurPratique::find($candidat->moniteur_pratique_id);
            $candidat['vehicule'] = Vehicule::find($candidat->vehicule_id);
    }
        return response()->json($candidats,200);
        
    }
    public function getCandidats($ecole_id)
    {
        $ecole = AutoEcole::find($ecole_id);
        if(is_null($ecole)){
            return response()->json(['message'=>'ecole  doesn\'t exist'],200);
        }
        
        $candidats =  Candidat::where('auto_ecole_id', $ecole_id)->get();
       
        //
        return response()->json($candidats,200);
        
    }
    public function getlistCandidat($list_candidat)
    {   
        $var = array_map('intval', explode(",",$list_candidat));
        $candidats = '';
        foreach($var as $val){
                $candidat = Candidat::where('id',$val)->first();
                if($candidat != null){
                        $candidats = implode(',',[implode(' ',[$candidat->nom_fr, $candidat->prenom_fr]),$candidats]);
                }
        }
        
        return response()->json($candidats,200);
        
    }

    public function historiquecandidat($ecole_id)
    {
        $ecole=AutoEcole::find($ecole_id);
        if(is_null($ecole)){
            return response()->json(['message'=>'ecole  doesn\'t exist'],200);
        }
        $candidats = Candidat::where('auto_ecole_id', $ecole_id)->get();
    
        return response()->json($candidats,200);
        
    }
    public function getarchivecandidat($ecole_id)
    {
        $ecole=AutoEcole::find($ecole_id);
        if(is_null($ecole)){
            return response()->json(['message'=>'ecole  doesn\'t exist'],200);
        }
        $candidats = DB::table('candidats')->whereNotNull('deleted_at')->get();
        if (is_null($candidats)) {
            return response()->json(['message'=>"candidats n'est pas trouvée"],200);
        }
        return response()->json($candidats,200);
        
    }
    public function getCandidatById($id)
    {
        $candidat= Candidat::find($id);
        if (is_null($candidat)) {
            return response()->json(['message'=>"candidats n'est pas trouvée"],200);
        }
        if($candidat->moniteurPratique){
            $candidat->moniteurPratique;
        }
        if($candidat->moniteurTheorique){
            $candidat->moniteurTheorique;
        }
        return response()->json($candidat,200);
        
    }

    public function addCandidat($ecole_id,Request $request)
    {
        $ecole=AutoEcole::find($ecole_id);
        if (is_null($ecole)) {
            return response()->json(['message'=>"ecole n'est pas trouvée"],200);
        }
                   // image  observations pcn  date_obtention lieu_obtention_fr lieu_obtention_ar email
        $validator = Validator::make($request->all(), [ 
            'cin' =>'required',
            'date_inscription' =>'required',
            'numero_contrat' =>'required',
            'ref_web' =>'required',
            'nom_fr' =>'required',
            'prenom_fr' =>'required',
            'nom_ar' =>'required',
            'prenom_ar' =>'required',
            'adresse_fr' =>'required',
            'adresse_ar' =>'required',
            'telephone' =>'required',
            'type_formation' =>'required',
            'langue' =>'required',
            'date_fin_contrat' =>'required',
            'categorie_demandee' =>'required',
            'nbr_heur_pratique' =>'required',
            'nbr_heur_theorique' =>'required',
            'montant' =>'required',
            // 'categorie' =>'required',
            'moniteur_theorique_id' =>'required',
            'moniteur_pratique_id' =>'required',
            'vehicule_id' =>'required',
        ]);
       
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()], 422);
        }
        $name_image = '';
        if($request->image != ''){
            $name_image = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->save(public_path('candidat_img/').$name_image);
        }
        $idt = (int) $request->moniteur_theorique_id;
        $idp = (int) $request->moniteur_pratique_id;
        $idv = (int) $request->vehicule_id;
        $moniteurt =MoniteurTheorique::find($idt);
        if (is_null($moniteurt)) {
            return response()->json(['message'=>"moniteur theorique n'est pas trouvée"],200);
        }
        $moniteurp = MoniteurPratique::find($idp);
        if (is_null($moniteurp)) {
            return response()->json(['message'=>"moniteur pratique n'est pas trouvée"],200);
        }
        $vehicule =Vehicule::find($idv);
        if (is_null($vehicule)) {
            return response()->json(['message'=>"vehicule n'est pas trouvée"],200);
        }
        $candidat = new Candidat(
            [
                'auto_ecole_id' => $ecole_id,
                'cin' =>$request->cin,
                'date_inscription' =>$request->date_inscription,
                'numero_contrat' =>$request->numero_contrat,
                'ref_web' =>$request->ref_web,
                'nom_fr' =>$request->nom_fr,
                'prenom_fr' =>$request->prenom_fr,
                'nom_ar' =>$request->nom_ar,
                'prenom_ar' =>$request->prenom_ar,
                'date_naissance' =>$request->date_naissance,
                'lieu_naissance' =>$request->lieu_naissance,
                'adresse_fr' =>$request->adresse_fr,
                'adresse_ar' =>$request->adresse_ar,
                'telephone' =>$request->telephone,
                'email' =>$request->email,
                'type_formation' => $request->type_formation,
                'profession' =>$request->profession,
                'langue' =>$request->langue,
                'image' => $name_image,
                'date_fin_contrat' =>$request->date_fin_contrat,
                'categorie_demandee' =>$request->categorie_demandee,
                'nbr_heure_pratique' =>$request->nbr_heur_pratique,
                'nbr_heure_theorique' =>$request->nbr_heur_theorique,
                'possede_permis' =>$request->possede_permis,
                'date_obtention' =>$request->date_obtention,
                'lieu_obtention_fr' =>$request->lieu_obtention_fr,
                'lieu_obtention_ar' =>$request->lieu_obtention_ar,
                'montant' =>$request->montant,
                'pcn' =>$request->pcn,
                'categorie' =>$request->categorie_demandee,
                'observations' =>$request->observations,
                'moniteur_theorique_id' =>  $idt, 
                'moniteur_pratique_id' =>  $idp, 
                'vehicule_id' =>  $idv,
            ]
        ); 
        $candidat->save();

        if($moniteurt != null && $moniteurp != null) {
            $moniteurt->candidats()->save($candidat);
            $moniteurp->candidats()->save($candidat); 
        }
        $candidat-> moniteurPratique; 
        $candidat-> moniteurTheorique;
        return response()->json(['message'=>'candidat added to table'],200);
    }

    public function updateCandidat($id,Request $request)
    {
        $candidat=Candidat::find($id);
        if (is_null($candidat)) {
            return response()->json(['message'=>"Candidat n'est pas trouvée"],200);
        }
        $validator = Validator::make($request->all(), [ 
            'cin' =>'required',
            'date_inscription' =>'required',
            'numero_contrat' =>'required',
            'ref_web' =>'required',
            'nom_fr' =>'required',
            'prenom_fr' =>'required',
            'nom_ar' =>'required',
            'prenom_ar' =>'required',
            'adresse_fr' =>'required',
            'adresse_ar' =>'required',
            'telephone' =>'required',
            'type_formation' =>'required',
            'langue' =>'required',
            'date_fin_contrat' =>'required',
            'categorie_demandee' =>'required',
            'nbr_heur_pratique' =>'required',
            'nbr_heur_theorique' =>'required',
            'montant' =>'required',
            // 'categorie' =>'required',
            'moniteur_theorique_id' =>'required',
            'moniteur_pratique_id' =>'required',
            'vehicule_id' =>'required',
        ]);
       
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()], 422);
        }
        $idt = (int) $request->moniteur_theorique_id;
        $idp = (int) $request->moniteur_pratique_id;
        $idv = (int) $request->vehicule_id;
        $name_image = '';
        if($request->image != ''){
            $name_image = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->save(public_path('candidat_img/').$name_image);
        }
        $candidat->cin = $request->cin;
        $candidat->date_inscription = $request->date_inscription;
        $candidat->numero_contrat = $request->numero_contrat;
        $candidat->ref_web = $request->ref_web;
        $candidat->nom_fr = $request->nom_fr;
        $candidat->prenom_fr = $request->prenom_fr;
        $candidat->nom_ar = $request->nom_ar;
        $candidat->prenom_ar = $request->prenom_ar;
        $candidat->date_naissance = $request->date_naissance;
        $candidat->lieu_naissance  = $request->lieu_naissance;
        $candidat->adresse_fr = $request->adresse_fr;
        $candidat->adresse_ar = $request->adresse_ar;
        $candidat->telephone = $request->telephone;
        $candidat->email  = $request->email;
        $candidat->type_formation  = '';
        $candidat->profession  =$request->profession;
        $candidat->langue  = $request->langue;
        $candidat->image  = $name_image;
        $candidat->date_fin_contrat  = $request->date_fin_contrat;
        $candidat->categorie_demandee  = $request->categorie_demandee;
        $candidat->nbr_heure_pratique  = $request->nbr_heur_pratique;
        $candidat->nbr_heure_theorique = $request->nbr_heur_theorique;
        $candidat->possede_permis = $request->possede_permis;
        $candidat->date_obtention = $request->date_obtention;
        $candidat->lieu_obtention_fr = $request->lieu_obtention_fr;
        $candidat->lieu_obtention_ar = $request->lieu_obtention_ar;
        $candidat->montant = $request->montant;
        $candidat->pcn = $request->pcn;
        $candidat->categorie = $request->categorie_demandee;
        $candidat->observations = $request->observations;
        $candidat->moniteur_theorique_id =  $idt; 
        $candidat->moniteur_pratique_id =  $idp; 
        $candidat->vehicule_id =  $idv;
        //
        $candidat->save();
        $candidat->moniteurPratique; 
        $candidat->moniteurTheorique; 
        return response($candidat,200);
    }

    public function deleteCandidat($id)
    {
        $candidat = Candidat::find($id);
        if (is_null($candidat)) {
            return response()->json(['message'=>"Candidat n'est pas trouvée"],200);
        }
        $candidat->delete();
        return response()->json(null,204);
    }
    
    public function desactiverCandidat($id)
    {   
        $candidat = Candidat::find($id);
        if (is_null($candidat)) {
            return response()->json(['message'=>"Candidat n'est pas trouvée"],200);
        }
        $candidat->actif = 0;
        $candidat->save();
        return response()->json($candidat,200);
    }
    public function activerCandidat($id)
    {   
        $candidat = Candidat::find($id);
        if (is_null($candidat)) {
            return response()->json(['message'=>"Candidat n'est pas trouvée"],200);
        }
        $candidat->actif = 1;
        $candidat->save();
        return response()->json($candidat,200);
    }
    // 
    public function recupererCandidat($id)
    {   
        $candidat = Candidat::onlyTrashed()->findOrFail($id);
        if (is_null($candidat)) {
            return response()->json(['message'=>"Candidat n'est pas trouvée"],200);
        }
        $candidat->restore();
        $candidat->save();
        return response()->json($candidat,200);
    }
}
