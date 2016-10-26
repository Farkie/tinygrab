<?php

namespace App\Http\Controllers\Upload;

use App\Http\Controllers\Controller;
use App\InternalUpload;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class InternalController extends Controller
{

    /**
     * UploadController Internal Upload.
     * @param Request $request
     * @return JsonResponse
     */
    public function internalAction(Request $request)
    {

        $user = $this->auth($request);

        if ($user) {

            $file = $request->upload->store('', 'imgsharer');
            $url = 'http://imgsharer.eu/tinygrab/' . $file;

            Log::info($url);

            InternalUpload::create([
                'userId' => $user->id,
                'ip_address' => $request->getClientIp(),
                'url' => $url
            ]);

            $data = [
                'url' => $url
            ];

            header('X-Grab-Url: ' . $url);

        } else {
            return new JsonResponse(['message' => 'Invalid User Credentials'], 403);
        }

        return new JsonResponse($data);
    }
}