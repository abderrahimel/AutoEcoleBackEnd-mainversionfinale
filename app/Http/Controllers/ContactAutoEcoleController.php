<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactAutoEcoleController extends Controller
{
    public function send(Request $request){
        // if($request->fichier != ''){
        //     $name_fichier = time().'.' . explode('/', explode(':', substr($request->fichier, 0, strpos($request->fichier, ';')))[1])[1];
        //     $pdf_64 = $request->fichier; //your base64 encoded data
        //     $replace = substr($pdf_64, 0, strpos($pdf_64, ',')+1); 
        //   // find substring fro replace here eg: data:image/png;base64,
        //    $pdf = str_replace($replace, '', $pdf_64); 
        //    $pdf = str_replace(' ', '+', $pdf); 
        //    Storage::disk('public')->put($name_fichier, base64_decode($pdf));
        // }
        return response()->json($request->all(), 200);
    }
    public function sendtoAll(Request $request){
        return response()->json($request->all(), 200);
    }
}
