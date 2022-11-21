<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use App\Mail\VerifyEmail;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Validator;

class VerifieEmailController extends Controller
{

    public function sendVerificationEmail(Request $request)
    {        // first get user of token sanctum
             $user = Auth::user();
             // generate url with email and id of current user
             $url =  URL::temporarySignedRoute(
                'verification.verify',
                Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
                [
                    'id' => $user->id,
                    'hash' => sha1($user->email),
                ]
            );
            // send email for verification
            Mail::to($user->email)->send(new VerifyEmail($url));

            return response()->json(['message'=>'Verification link sent !']);
    }
    public function send_email($id, $hash){
            // this when the user register an account
            $user = User::find($id);
            abort_if(!$user, 403);
            abort_if(! hash_equals($hash, sha1($user->getEmailForVerification())), 403);
        
                if (! $user->hasVerifiedEmail()) {
                    $user->markEmailAsVerified();
        
                    event(new Verified($user));
                }
                return view('verified-account');
        
    }
  
}
