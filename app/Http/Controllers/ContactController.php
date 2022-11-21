<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\Contact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function sendEmailToSuperAdmin(Request $request){
        $superAdmin = User::where('type', 'superAdmin')->first();
        $email = $superAdmin->email;
        Mail::to($email)->send(new Contact($request->message));
        return response()->json(['Mail sent successfully'], 200);
    }
}
