<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MoniteurPratique;

class MoniteurPratiqueController extends Controller
{
         public function getMoniteurT( Request $request){
            return response()->json(['vehicule'=>MoniteurPratique::all()]);
         }
}
