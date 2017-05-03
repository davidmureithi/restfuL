<?php

namespace App\Api\V1\Controllers;

use App\User;
use Dingo\Api\Http\Request;
use JWTAuth;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\LoginRequest;
use Tymon\JWTAuth\Exceptions\JWTException;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');
        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        $email = $request->get('email');
        $id = User::where('email', $email)->value('id');
        $query = User::query();

        if($id){
            $query->where('id', $id);
        }
        $user = $query->get();

        // all good so return the token
        return response()->json([
            'user' => $user,
            'token' => compact('token')
        ]);
    }
}