<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendPdfMail;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\AutoEcole;
class ContactAutoEcoleController extends Controller
{
    public function send(Request $request){
        $validator = Validator::make($request->all(), [
            'object' =>'required',
            'fichier' =>'required',
            'message' =>'required',
        ]);
        
        if ($validator->fails()) {
            return new JsonResponse(['success' => false, 'message' => $validator->errors()], 422);
        }
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
        $imagesendbymailwithstore = array(
            'fichier' =>  $name_fichier,
            'object' =>  $request->object,
            'message' =>  $request->message,
        );
        $autoecole = AutoEcole::find($request->id_autoEcole);
        $user = User::find($autoecole['user_id']);
        Mail::to($user['email'])->send(new SendPdfMail($imagesendbymailwithstore));
        return response()->json(['message'=>'message send', 'email'=>$user['email']], 200);
    }
    public function sendtoAll(Request $request){
        $validator = Validator::make($request->all(), [
            'object' =>'required',
            'fichier' =>'required',
            'message' =>'required',
        ]);
        
        if ($validator->fails()) {
            return new JsonResponse(['success' => false, 'message' => $validator->errors()], 422);
        }
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
        $imagesendbymailwithstore = array(
            'fichier' =>  $name_fichier,
            'object' =>  $request->object,
            'message' =>  $request->message,
        );
        $users = User::where('type', '!=', 'superAdmin')->get();
        if(!is_null($users)){
            foreach($users as $user){
                // here will send email for each auto ecole
                Mail::to($user['email'])->send(new SendPdfMail($imagesendbymailwithstore));
           }
        }
        return response()->json(['message'=>'message send'], 200);
    }
}