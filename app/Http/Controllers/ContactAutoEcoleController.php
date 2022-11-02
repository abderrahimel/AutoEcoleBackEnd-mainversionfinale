<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendPdfMail;

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
        if($request->fichier != ''){
            $name_fichier = time().'.' . explode('/', explode(':', substr($request->fichier, 0, strpos($request->fichier, ';')))[1])[1];
            $pdf_64 = $request->fichier; //your base64 encoded data
            $replace = substr($pdf_64, 0, strpos($pdf_64, ',')+1);
          // find substring fro replace here eg: data:image/png;base64,
           $pdf = str_replace($replace, '', $pdf_64);
           $pdf = str_replace(' ', '+', $pdf);
           Storage::disk('public')->put($name_fichier, base64_decode($pdf));
        }
        $url = 'storage/' . $name_fichier;
        $object = $request->object;
        $message = $request->message;
        $data["email"] = "fisano3677@harcity.com";
        $data["title"] = $request->object;
        $data["body"] = $request->message;
        // Mail::to('fisano3677@harcity.com')->send(new SendPdfMail($object, $message));
        $imagesendbymailwithstore = array(
            'email' => "fisano3677@harcity.com",
            'image' => 	$request->fichier,
        );
        Mail::to('fisano3677@harcity.com')->send(new SendPdfMail($imagesendbymailwithstore));
        $request['image']->move(base_path() . '/storage/app/public', $name_fichier);
        return response()->json($pdf_64, 200);
    }
}
