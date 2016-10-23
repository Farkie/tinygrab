<?php

namespace App\Http\Controllers\Upload;

use App\ExternalUpload;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

class ExternalController extends Controller
{

    /**
     * UploadController External Upload.
     * @param Request $request
     * @return JsonResponse
     */
    public function externalAction(Request $request)
    {

        $user = $this->auth($request);

        if ($user) {
            ExternalUpload::create([
                'userId' => $user->id,
                'url' => Input::get('URL'),
                'ip_address' => $request->getClientIp()
            ]);
        } else {
            return $user;
        }

        return new JsonResponse([]);
    }
}