<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class VerifyController extends Controller
{

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function verifyAction(Request $request)
    {

        $email = Input::get('email');
        $status = 200;
        $headers = [];
        $json = [];
        $invalid = false;

        if ($email) {
            $password = Input::get('passwordhash');

            $user = User::where('email', $email)->first();

            if ($user) {
                if ($user->passwordhash != $password) {
                    $status = 403;
                    $json = ['message' => 'Incorrect login'];
                    $invalid = true;
                }
            } else {
                User::create([
                    'email' => $email,
                    'passwordhash' => $password
                ]);
            }

            if (!$invalid) {

                $headers = [
                    'X-User-Name' => $email,
                    'X-User-Email' => $email,
                    'X-User-Paid' => 'pro',
                    'X-User-JoinDate' => time()
                ];

                $json = [
                    'username' => $email,
                    'email' => $email,
                    'password' => $password,
                    'credentialsValidated' => true,
                ];
            }
        } else {
            $json = [
                'message' => 'Incorrect login'
            ];
        }

        return new JsonResponse($json, $status, $headers);
    }

}