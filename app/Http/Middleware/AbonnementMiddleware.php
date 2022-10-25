<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Abonnement;
class AbonnementMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {
                return response()->json(['response'=>false, 'message' => 'user not found'], 500);
            }
            $abonnement = Abonnement::where('user_id', $user->id)->get;
            if (!$abonnement->date_fin) {
                return response()->json(['response'=>false, 'message' => 'you need abonnement'], 500);
            }
            $paymentDate       = new DateTime('now');
            $contractDateEnd   = new DateTime($abonnement->date_fin);
            $verify =dateIsInBetween($contractDateEnd, $paymentDate);
            if (!$verify) {
                return response()->json(['response'=>false, 'message' => 'abonnement expired'], 500);
            }

        } catch (JWTException $e) {
            return response()->json(['response'=>false,'message' => $e->getMessage()], 500);
        }
        return $next($request);
    }
    function dateIsInBetween(\DateTime $to, \DateTime $subject)
    {
        return $subject->getTimestamp() <= $to->getTimestamp()  ? true : false;
    }

}