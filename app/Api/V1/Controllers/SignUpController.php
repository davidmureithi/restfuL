<?php

namespace App\Api\V1\Controllers;
use Config;
use App\User;
use Illuminate\Support\Facades\Mail;
use Input;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\SignUpRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SignUpController extends Controller
{
    public function signUp(SignUpRequest $request, JWTAuth $JWTAuth)
    {
        $user = new User($request->all());
        if(!$user->save()) {
            throw new HttpException(500);
        }

        Mail::send('emails.verify_registration', array($user), function($message) {
            $message->to(Input::get('email'))
                ->subject('Welcome to chupachap');
        });

        $token = $JWTAuth->fromUser($user);
        if(!Config::get('boilerplate.sign_up.release_token')) {
            return response()->json([
                'token' => [
                    'token' => $token
                ],
                'user' => $user
            ], 201);
        }

        return response()->json([
            'status' => 'ok',
            'token' => $token
        ], 201);
    }
}