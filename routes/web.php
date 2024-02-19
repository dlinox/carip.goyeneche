<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\InstitutionalInformationController;
use App\Http\Controllers\InstitutionalObjetiveController;
use App\Http\Controllers\PurchaseAndServiceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Redirect::route('auth.index');
});

Route::name('auth.')->prefix('auth')->group(function () {
    Route::get('',  [AuthController::class, 'index'])->name('index')->middleware('guest');
    Route::get('login',  [AuthController::class, 'index'])->name('index')->middleware('guest');
    Route::post('sign-in',  [AuthController::class, 'signIn'])->name('sign-in')->middleware('guest');
    Route::post('sign-out',  [AuthController::class, 'signOut'])->name('sign-out')->middleware('auth');

    //change-password

    Route::post('change-password',  [AuthController::class, 'changePassword'])->name('change-password')->middleware('auth');

    //Rutas para el recupero de contraseña
    Route::get('/forgot-password',  [AuthController::class, 'forgotPassword'])->middleware('guest')->name('password.request');
    Route::post('/forgot-password',  [AuthController::class, 'sendPasswordResetLink'])->middleware('guest')->name('password.email');

    Route::get('/reset-password/{token}',  [AuthController::class, 'resetPassword'])->middleware('guest')->name('password.reset');
    Route::post('/reset-password',  [AuthController::class, 'updatePassword'])->middleware('guest')->name('password.update');
});

Route::middleware('auth')->name('a.')->prefix('a')->group(function () {
    Route::get('',  [AdminController::class, 'index'])->name('index');

    //institutional information
    Route::get('institutional-information',  [InstitutionalInformationController::class, 'index'])->name('institutional-information.index')->middleware(['can:a.institutional']);
    //store
    Route::post('institutional-information',  [InstitutionalInformationController::class, 'store'])->name('institutional-information.store')->middleware(['can:a.institutional']);
    //objetives
    Route::resource('institutional-objetives', InstitutionalObjetiveController::class)->middleware(['can:a.institutional-objetives'])->middleware(['can:a.institutional']);

    //areas
    Route::resource('areas', AreaController::class)->middleware(['can:a.areas']);
    Route::patch('areas/{id}/change-state',  [AreaController::class, 'changeState'])->middleware(['can:a.areas']);

    //usrers
    Route::resource('users', UserController::class)->middleware(['can:a.users']);
    Route::patch('users/{id}/change-state',  [UserController::class, 'changeState'])->middleware(['can:a.users']);

    //specialties
    Route::resource('specialties', \App\Http\Controllers\SpecialtyController::class)->middleware(['can:a.specialties']);
    Route::patch('specialties/{id}/change-state',  [\App\Http\Controllers\SpecialtyController::class, 'changeState'])->middleware(['can:a.specialties']);

    //supporting-services
    Route::resource('supporting-services', \App\Http\Controllers\SupportingServiceController::class)->middleware(['can:a.supporting-services']);
    Route::patch('supporting-services/{id}/change-state',  [\App\Http\Controllers\SupportingServiceController::class, 'changeState'])->middleware(['can:a.supporting-services']);

    //workers
    Route::resource('workers', \App\Http\Controllers\WorkerController::class)->middleware(['can:a.workers']);
    Route::patch('workers/{id}/change-state',  [\App\Http\Controllers\WorkerController::class, 'changeState'])->middleware(['can:a.workers']);

    Route::post('workers/authorities',  [\App\Http\Controllers\WorkerController::class, 'authorities']);
    Route::delete('workers/authorities/{id}',  [\App\Http\Controllers\WorkerController::class, 'authoritiesDestroy']);

    //sliders
    Route::resource('sliders', \App\Http\Controllers\SliderController::class)->middleware(['can:a.sliders']);
    Route::patch('sliders/{id}/change-state',  [\App\Http\Controllers\SliderController::class, 'changeState'])->middleware(['can:a.sliders']);
    
    //advertisements
    Route::resource('advertisements', \App\Http\Controllers\AdvertisementController::class)->middleware(['can:a.advertisements']);
    Route::patch('advertisements/{id}/change-state',  [\App\Http\Controllers\AdvertisementController::class, 'changeState'])->middleware(['can:a.advertisements']);

    //final-services
    Route::resource('final-services', \App\Http\Controllers\FinalServiceController::class)->middleware(['can:a.final-services']);
    Route::patch('final-services/{id}/change-state',  [\App\Http\Controllers\FinalServiceController::class, 'changeState'])->middleware(['can:a.final-services']);

    //intermediate-services
    Route::resource('intermediate-services', \App\Http\Controllers\IntermediateServiceController::class)->middleware(['can:a.intermediate-services']);
    Route::patch('intermediate-services/{id}/change-state',  [\App\Http\Controllers\IntermediateServiceController::class, 'changeState'])->middleware(['can:a.intermediate-services']);

    //offices
    Route::resource('offices', \App\Http\Controllers\OfficeController::class)->middleware(['can:a.offices']);
    Route::patch('offices/{id}/change-state',  [\App\Http\Controllers\OfficeController::class, 'changeState'])->middleware(['can:a.offices']);

    //service-portfolios
    Route::resource('service-portfolios', \App\Http\Controllers\ServicePortfolioController::class)->middleware(['can:a.service-portfolios']);
    Route::patch('service-portfolios/{id}/change-state',  [\App\Http\Controllers\ServicePortfolioController::class, 'changeState'])->middleware(['can:a.service-portfolios']);

    //guidance-documents
    Route::resource('guidance-documents', \App\Http\Controllers\GuidanceDocumentController::class)->middleware(['can:a.guidance-documents']);
    Route::patch('guidance-documents/{id}/change-state',  [\App\Http\Controllers\GuidanceDocumentController::class, 'changeState'])->middleware(['can:a.guidance-documents']);

    //announcements
    Route::resource('announcements', \App\Http\Controllers\AnnouncementController::class)->middleware(['can:a.announcements']);
    Route::patch('announcements/{id}/change-state',  [\App\Http\Controllers\AnnouncementController::class, 'changeState'])->middleware(['can:a.announcements']);
    Route::delete('announcements/{id}/documents/{document}',  [\App\Http\Controllers\AnnouncementController::class, 'documentsDestroy'])->middleware(['can:a.announcements']);

    //purchase-and-services
    Route::resource('purchase-and-service',  PurchaseAndServiceController::class);
    Route::patch('purchase-and-service/{id}/change-state',  [PurchaseAndServiceController::class, 'changeState']);

    //news
    Route::resource('news', \App\Http\Controllers\NewsController::class)->middleware(['can:a.news']);
    Route::patch('news/{id}/change-state',  [\App\Http\Controllers\NewsController::class, 'changeState'])->middleware(['can:a.news']);
    Route::patch('news/{id}/change-featured', [\App\Http\Controllers\NewsController::class, 'changeFeatured'])->middleware(['can:a.news']);

    //publications
    Route::resource('publications', \App\Http\Controllers\PublicationController::class)->middleware(['can:a.publications']);
    Route::patch('publications/{id}/change-state',  [\App\Http\Controllers\PublicationController::class, 'changeState'])->middleware(['can:a.publications']);
    Route::delete('publications/{id}/documents/{document}',  [\App\Http\Controllers\PublicationController::class, 'documentsDestroy'])->middleware(['can:a.publications']);

    //events
    Route::resource('events', \App\Http\Controllers\EventController::class)->middleware(['can:a.events']);
    Route::patch('events/{id}/change-state',  [\App\Http\Controllers\EventController::class, 'changeState'])->middleware(['can:a.events']);
    Route::patch('events/{id}/change-featured', [\App\Http\Controllers\EventController::class, 'changeFeatured'])->middleware(['can:a.events']);
    
});
