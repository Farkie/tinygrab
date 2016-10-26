<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => '/'], function () {

    Route::any('v3.php', function (Request $request) {
        if ($request->get('m')) {
            $module = $request->get('m');

            switch ($module) {
                case 'user/verify':
                    $controller = new \App\Http\Controllers\User\VerifyController($request);
                    return $controller->verifyAction($request);
                    break;

                case 'grab/upload.external':
                    $controller = new \App\Http\Controllers\Upload\ExternalController($request);
                    return $controller->externalAction($request);
                    break;

                case 'grab/upload':
                    $controller = new \App\Http\Controllers\Upload\InternalController($request);
                    return $controller->internalAction($request);
                    break;

                case 'user/recent.json':
                    $controller = new \App\Http\Controllers\User\RecentController($request);
                    return $controller->recentAction($request);
                    break;

                default:
                    return new \Illuminate\Http\JsonResponse('Page not found', 404);
            }

        } else {
            return new \Illuminate\Http\JsonResponse('Page not found', 404);
        }
    });

});