<?php

namespace App\Http\Controllers\User;

use App\ExternalUpload;
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
        $data = [];

        if ($user) {

            $recents = ExternalUpload::where('userId', $user->id)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();

            if ($recents) {
                foreach ($recents as $recent) {
                    $data[] = [
                        'id' => $recent->id,
                        'user_id' => $recent->userId,
                        'filename' => $recent->url,
                        'date' => $recent->created_at,
                        'title' => basename($recent->url),
                        'description' => basename($recent->url),
                        'url' => $recent->url,
                        'views'=> 0
                    ];
                }
            }

        } else {
            return new JsonResponse(['message' => 'Invalid User Credentials'], 403);
        }

        return new JsonResponse($data);
    }

}