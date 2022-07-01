<?php

use App\Kulana\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Process\Process;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return new \Illuminate\Http\JsonResponse([
        'message' => 'Welcome to the Kulana API. Refer to the documentation under https://ohanome.github.io/kulana for more information.',
    ], 200);
});

Route::post('/status', function (Request $request) {
    return Status::getStatusFromRequest($request);
});

Route::get('/status', function (Request $request) {
    return Status::getStatusFromRequest($request);
});
