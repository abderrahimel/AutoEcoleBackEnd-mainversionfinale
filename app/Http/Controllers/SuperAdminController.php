<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AutoEcole;
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
      $autoecoles_en_attente =  AutoEcole::where('etat','=', 'en_attente')->get();
      return response()->json($autoecoles_en_attente, 200);

   }
   
}
