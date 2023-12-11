<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//general-information
Route::get('/general-information', [\App\Http\Controllers\Api\ApiController::class, 'getGeneralInformation']);

//sliders
Route::get('/sliders', [\App\Http\Controllers\Api\ApiController::class, 'sliders']);

//news
Route::get('/news', [\App\Http\Controllers\Api\ApiController::class, 'news']);

//areas
Route::get('/areas', [\App\Http\Controllers\Api\ApiController::class, 'areas']);

//doctors
Route::get('/doctors', [\App\Http\Controllers\Api\ApiController::class, 'doctors']);