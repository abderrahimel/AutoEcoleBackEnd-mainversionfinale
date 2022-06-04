<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifieEmailController extends Controller
{
    public function sendVerificationEmail(Request $request){
            if($request->user()->hasVerifiedEmail()){

                return ['message'=>'Already Verified'];
            }
            $request->user()->sendEmailVerificationNotification();
            return ['status'=>'verification-link-sent'];
    }
    public function verify(){
        
    }
}
