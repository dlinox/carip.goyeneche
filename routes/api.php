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



//areas
Route::get('/areas', [\App\Http\Controllers\Api\ApiController::class, 'areas']);



//organigrama
Route::get('/organigrama', [\App\Http\Controllers\Api\ApiController::class, 'organigrama']);

//oficinas
Route::get('/oficinas', [\App\Http\Controllers\Api\ApiController::class, 'oficinas']);


//mision y vision
Route::get('/mision-vision', [\App\Http\Controllers\Api\ApiController::class, 'misionVision']);

// 
Route::get('/apoyo-al-diagnostico', [\App\Http\Controllers\Api\ApiController::class, 'apoyoAlDiagnostico']);

//cartera de servicios
Route::get('/cartera-el-diagnostico', [\App\Http\Controllers\Api\ApiController::class, 'caretedeServicios']);
//combocatorias
Route::get('/convocatorias', [\App\Http\Controllers\Api\ApiController::class, 'convocatorias']);


//quinies somos
Route::get('/quienes-somos', [\App\Http\Controllers\Api\ApiController::class, 'quienesSomos']);

//objetivos
Route::get('/objetivos', [\App\Http\Controllers\Api\ApiController::class, 'objetivos']);

//autoridades
Route::get('/autoridades', [\App\Http\Controllers\Api\ApiController::class, 'autoridades']);

//menu services

//espcialidadesMedicas
Route::get('/especialidades-medicas', [\App\Http\Controllers\Api\ApiController::class, 'espcialidadesMedicas']);

//apoyoAlDiagnostico
Route::get('/apoyo-al-diagnostico', [\App\Http\Controllers\Api\ApiController::class, 'apoyoAlDiagnostico']);

//doctors
Route::get('/doctors', [\App\Http\Controllers\Api\ApiController::class, 'doctors']);


//caretedeServicios
Route::get('/cartera-de-servicios', [\App\Http\Controllers\Api\ApiController::class, 'caretedeServicios']);

//circuitosDeAtencion
Route::get('/circuitos-de-atencion', [\App\Http\Controllers\Api\ApiController::class, 'circuitosDeAtencion']);

//news
Route::get('/news', [\App\Http\Controllers\Api\ApiController::class, 'news']);

//eventos
Route::get('/eventos', [\App\Http\Controllers\Api\ApiController::class, 'eventos']);

//convocatorias
Route::get('/convocatorias', [\App\Http\Controllers\Api\ApiController::class, 'convocatorias']);

//publicaciones
Route::get('/publicaciones', [\App\Http\Controllers\Api\ApiController::class, 'publicaciones']);