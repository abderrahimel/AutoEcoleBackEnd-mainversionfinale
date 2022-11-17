<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AutoEcole;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SuperAdminController extends Controller
{
   public function getdataSuper()
   {
    $totalAutoecoles = AutoEcole::where('deleted_at','=', null)->count();
    $totalAutoecolesapprouve = AutoEcole::where('etat','=', 'approuve')->count();
    $totalAutoecolesen_attente = AutoEcole::where('etat','=', 'en_attente')->count();
    $totalAutoecolesarchive = AutoEcole::onlyTrashed()->count();
    return response()->json(['totalAE'=>$totalAutoecoles, 'totalAEA'=>$totalAutoecolesapprouve, 'totalAE_Attente'=>$totalAutoecolesen_attente, 'totalAECOLEarchive'=>$totalAutoecolesarchive], 200);
   }
   public function getautoecolesEnattente(){
      $autoEcolesApprouves = AutoEcole::where('etat','=',"en_attente")->get();
      foreach($autoEcolesApprouves as $key => $autoEcolesApprouve) {
          $autoEcolesApprouve->abonnement;
          $autoEcolesApprouve['gmail'] = User::find($autoEcolesApprouve->user_id)['email'];
      }
      return response()->json($autoEcolesApprouves, 200);

   }
  
}
