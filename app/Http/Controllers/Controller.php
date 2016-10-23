<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Input;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function auth(Request $request)
    {

        $email = Input::get('email');
        $password = Input::get('passwordhash');

        $user = User::where('email', $email)
                    ->where('passwordhash', $password)->first();

        if (!$user) {
            return false;
        }

        return $user;
    }
}
