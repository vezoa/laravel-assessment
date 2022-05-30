<?php

use App\Http\Controllers\Api\TourApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group([
    'prefix' => 'v1'
], function(){

    Route::get('/tours/{id}', [TourApiController::class, 'show']);
    Route::get('/tours', [TourApiController::class, 'index']);
    Route::post('/tours', [TourApiController::class, 'store']);
    Route::put('/tours/{id}', [TourApiController::class, 'update']);
    Route::delete('/tours/{id}', [TourApiController::class, 'destroy']);



   });


