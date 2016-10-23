<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UploadController extends Controller
{

    /**
     * UploadController External Upload.
     * @param Request $request
     * @return JsonResponse
     */
    public function externalAction(Request $request)
    {
        $data = [];
        return new JsonResponse($data);
    }
}