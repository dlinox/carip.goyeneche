<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Authority;
use App\Models\Event;
use App\Models\FinalService;
use App\Models\InstitutionalInformation;
use App\Models\InstitutionalObjetive;
use App\Models\Office;
use App\Models\ServicePortfolio;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function getGeneralInformation()
    {
        $InstitutionalInformation = InstitutionalInformation::select('name', 'description', 'address', 'phone', 'email', 'logo',)->first();
        $generalInformation = [
            'name' => $InstitutionalInformation->name,
            'description' => $InstitutionalInformation->description,
            'address' => $InstitutionalInformation->address,
            'phone' => $InstitutionalInformation->phone,
            'email' => $InstitutionalInformation->email,
            'logo' => asset('storage/' . $InstitutionalInformation->logo),

        ];

        return response()->json($generalInformation);
    }

    public function sliders()
    {
        $sliders = \App\Models\Slider::where('is_active', true)->orderBy('created_at', 'DESC')->get();
        return response()->json($sliders);
    }


    public function areas()
    {
        $areas = \App\Models\Area::where('is_active', true)->get();
        return response()->json($areas);
    }



    public function organigrama(){
        $organigrama =  InstitutionalInformation::select('organigram')->first();
        return response()->json($organigrama);
    }

    public function quienesSomos(){
        $quienesSomos = InstitutionalInformation::select('about_us')->first();
        return response()->json($quienesSomos);
    }   

    

    public function autoridades(){
        $autoridades = Authority::all();
        return response()->json($autoridades);
    }

    public function objetivos(){
        $objetivos = InstitutionalObjetive::all();
        return response()->json($objetivos);
    }

    public function misionVision(){
        $misionVsion = InstitutionalInformation::select('mission', 'vision')->first();
        return response()->json($misionVsion);
    }

    public function nosotros(){
        $nosotros = InstitutionalInformation::select('about_us')->fisrt();
        return response()->json($nosotros);
    }

    
    public function espcialidadesMedicas(){
        $especialidadesMedicas = FinalService::where('is_active', true)->get();
        return response()->json($especialidadesMedicas);
    }

    public function apoyoAlDiagnostico(){
        $apoyoAlDiagnostico = \App\Models\IntermediateService::where('is_active', true)->get();
        return response()->json($apoyoAlDiagnostico);
    }

    public function oficinas(){
        $oficinas = Office::where('is_active', true)->get();
        return response()->json($oficinas);
    }

    public function doctors()
    {
        $doctors = \App\Models\Worker::where('is_active', true)->get();
        return response()->json($doctors);
    }


    public function caretedeServicios(){
        $carteraDeServicios = ServicePortfolio::where('is_active', true)->get();
        return response()->json($carteraDeServicios);
    }

    public function circuitosDeAtencion(){
        $circuitosDeAtencion = \App\Models\GuidanceDocument::where('is_active', true)->get();
        return response()->json($circuitosDeAtencion);
    }

    public function news()
    {
        //get 10 last news
        $news = \App\Models\News::where('is_active', true)->orderBy('created_at', 'DESC')->take(20)->get();
        return response()->json($news);
    }

    //get news by slug
    public function newsBySlug($slug)
    {
        $news = \App\Models\News::where('slug', $slug)->first();
        return response()->json($news);
    }

    public function getNewsByAuthorArea($id){
        $news = \App\Models\News::join('users', 'users.id', '=', 'news.author_id')
        ->join('areas', 'areas.id', '=', 'users.area_id')
        ->where('areas.id', $id)
        ->select('news.*')
        ->get();

        return response()->json($news);
    }

      
    public function eventos () {
        $eventos = Event::all();
        return response()->json($eventos);
    }

    //get event by slug
    public function eventBySlug($slug)
    {
        $event = Event::where('slug', $slug)->first();
        return response()->json($event);
    }

    public function getEventsByAuthorArea($id){
        $events = Event::join('users', 'users.id', '=', 'events.author_id')
        ->join('areas', 'areas.id', '=', 'users.area_id')
        ->where('areas.id', $id)
        ->select('events.*')
        ->get();

        return response()->json($events);
    }


    public function convocatorias(){
        $convocatorias = \App\Models\Announcement::where('is_active', true)->get();
        return response()->json($convocatorias);
    }

    public function publicaciones(){
        $publicaciones = \App\Models\Publication::where('is_active', true)->get();
        return response()->json($publicaciones);
    }

    public function publicacionesBySlug($slug){
        $publicaciones = \App\Models\Publication::where('slug', $slug)->first();
        return response()->json($publicaciones);
    }

    public function getPublicacionesByAuthorArea($id){
        $publicaciones = \App\Models\Publication::join('users', 'users.id', '=', 'publications.author_id')
        ->join('areas', 'areas.id', '=', 'users.area_id')
        ->where('areas.id', $id)
        ->select('publications.*')
        ->get();

        return response()->json($publicaciones);
    }



}
