<?php

namespace App\Http\Controllers\User;

use App\ExternalUpload;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use SimpleXMLElement;

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

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function recentXmlAction(Request $request)
    {

        $user = $this->auth($request);
        $data = [];

        if ($user) {

            $recents = ExternalUpload::where('userId', $user->id)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();

            $xml = new SimpleXMLElement('<root/>');

            if ($recents) {
                foreach ($recents as $id => $recent) {
                    $row['grab']['id_' . $id] = [
                        'id' => $recent->id,
                        'date' => $recent->created_at,
                        'title' => basename($recent->url),
                        'description' => basename($recent->url),
                        'url' => $recent->url
                    ];

                }
            }

        } else {
            return new JsonResponse(['message' => 'Invalid User Credentials'], 403);
        }

        $this->to_xml($xml, $row);

        $response = $xml->asXML();

        return Response::make($response, '200')->header('Content-Type', 'text/xml');
    }

    function to_xml(SimpleXMLElement $object, array $data)
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $new_object = $object->addChild($key);
                $this->to_xml($new_object, $value);
            } else {
                $object->addChild($key, $value);
            }
        }
    }


}