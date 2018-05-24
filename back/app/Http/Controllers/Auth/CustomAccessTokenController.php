<?php

namespace App\Http\Controllers\Auth;

use Psr\Http\Message\ServerRequestInterface;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use DB;

class CustomAccessTokenController extends AccessTokenController
{
    /**
     * Hooks in before the AccessTokenController issues a token
     *
     *
     * @param  ServerRequestInterface $request
     * @return mixed
     */
    public function issueUserToken(ServerRequestInterface $request)
    {
        $httpRequest = request();

        // 1.
        if ($httpRequest->grant_type == 'password') {
            // 2.
            $user = \App\User::where('email', $httpRequest->username)->first();
            if($user->flag == 1){
                return $this->issueToken($request);
            }else{
                return response()->json(['errors' => 'This account is not activated yet']);
            }
        }
    }
}