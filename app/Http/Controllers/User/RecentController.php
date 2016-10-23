<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class RecentController extends Controller
{

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function recentAction(Request $request)
    {

        $user = $this->auth($request);

        if ($user) {

        } else {
            return $user;
        }

        return new JsonResponse();
    }

}