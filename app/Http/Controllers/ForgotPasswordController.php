<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ResetPassword;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
    
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()], 422);
        }
    
        $verify = User::where('email', $request->all()['email'])->exists();
    
        if ($verify) {
            $verify2 =  DB::table('password_resets')->where([
                ['email', $request->all()['email']]
            ]);
    
            if ($verify2->exists()) {
                $verify2->delete();
            }
    
            $token = random_int(100000, 999999);
            $password_reset = DB::table('password_resets')->insert([
                'email' => $request->all()['email'],
                'token' =>  $token,
                'created_at' => Carbon::now()
            ]);
    
            if ($password_reset) {
                Mail::to($request->all()['email'])->send(new ResetPassword($token));
    
                return response()->json(
                    [
                        'success' => true, 
                        'message' => "Please check your email for a 6 digit pin"
                    ], 
                    200
                );
            }
        } else {
            return response()->json(
                [
                    'success' => false, 
                    'message' => "Aucun utilisateur n'a été trouvé avec cette adresse email."
                ], 
                400
            );
        }
    }
    public function verifyPin(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => ['required', 'string', 'email', 'max:255'],
        'token' => ['required'],
    ]);

    if ($validator->fails()) {
        return response()->json(['success' => false, 'message' => $validator->errors()], 422);
    }
    $verify = User::where('email', $request->all()['email'])->exists();
    if(!$verify){
        return response()->json(['success' => false, 'message' => "email n'existe pas"], 400);
    }
    $check = DB::table('password_resets')->where([
        ['email', $request->all()['email']],
        ['token', $request->all()['token']],
    ]);
    
    if ($check->exists()) {
        $difference = Carbon::now()->diffInSeconds($check->first()->created_at);
        if ($difference > 3600) {
            return response()->json(['success' => false, 'message' => "Token Expired"], 400);
        }

        $delete = DB::table('password_resets')->where([
            ['email', $request->all()['email']],
            ['token', $request->all()['token']],
        ])->delete();

        return response()->json(
            [
                'success' => true, 
                'message' => "You can now reset your password"
            ], 
            200
            );
    } else {
        return response()->json(
            [
                'success' => false, 
                'message' => "Invalid pin"
            ], 
            401
        );
    }
}

}
