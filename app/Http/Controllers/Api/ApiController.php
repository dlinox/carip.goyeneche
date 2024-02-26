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
use App\Models\Specialty;
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



    public function organigrama()
    {
        $organigrama =  InstitutionalInformation::select('organigram')->first();
        return response()->json($organigrama);
    }

    public function quienesSomos()
    {
        $quienesSomos = InstitutionalInformation::select('about_us')->first();
        return response()->json($quienesSomos);
    }



    public function autoridades()
    {
        $autoridades = Authority::all();
        return response()->json($autoridades);
    }

    public function objetivos()
    {
        $objetivos = InstitutionalObjetive::all();
        return response()->json($objetivos);
    }

    public function misionVision()
    {
        $misionVsion = InstitutionalInformation::select('mission', 'vision')->first();
        return response()->json($misionVsion);
    }

    public function nosotros()
    {
        $nosotros = InstitutionalInformation::select('about_us')->fisrt();
        return response()->json($nosotros);
    }


    public function espcialidadesMedicas(Request $request)
    {

        $itemsPerPage = $request->limit ? $request->limit : 10;
        $items = FinalService::where('is_active', true)->orderBy('created_at', 'DESC')->paginate($itemsPerPage);
        return response()->json($items);
    }

    public function apoyoAlDiagnostico(Request $request)
    {

        $itemsPerPage = $request->limit ? $request->limit : 10;

        $items = \App\Models\IntermediateService::where('is_active', true)->orderBy('created_at', 'DESC')->paginate($itemsPerPage);

        return response()->json($items);
    }

    public function oficinas(Request $request)
    {

        $itemsPerPage = $request->limit ? $request->limit : 10;
        $items = Office::where('is_active', true)->orderBy('created_at', 'DESC')->paginate($itemsPerPage);
        return response()->json($items);
    }

    public function specialties()
    {

        $items = Specialty::select('id', 'name')->where('is_active', true)->orderBy('name', 'ASC')->get();
        return response()->json($items);
    }

    public function doctors(Request $request)
    {
        $perPage = $request->input('perPage', 10);

        $query = \App\Models\Worker::query();


        $query->where('is_active', true);


        $query->orderBy('created_at', 'DESC');

        if ($request->has('term')) {
            $query->where('name', 'LIKE', "%{$request->term}%");
        }

        //filtar por especialidad que no sea null y no sea ""

        if ($request->has('specialty') && $request->specialty != "") {
            $query->where('specialty_id', $request->specialty);
        }

        $items = $query->paginate($perPage)->appends($request->query());
        return response()->json($items);
    }


    public function caretedeServicios(Request $request)
    {

        $itemsPerPage = $request->limit ? $request->limit : 10;

        $items = ServicePortfolio::where('is_active', true)->orderBy('created_at', 'DESC')->paginate($itemsPerPage);

        return response()->json($items);
    }

    public function circuitosDeAtencion(Request $request)
    {

        $itemsPerPage = $request->limit ? $request->limit : 10;

        $items = \App\Models\GuidanceDocument::where('is_active', true)->orderBy('created_at', 'DESC')->paginate($itemsPerPage);

        return response()->json($items);
    }

    public function news(Request $request)
    {
        $itemsPerPage = $request->limit ? $request->limit : 10;
        $items = \App\Models\News::where('is_active', true)->orderBy('created_at', 'DESC')->paginate($itemsPerPage);
        return response()->json($items);
    }

    //get news by slug
    public function newsBySlug($slug)
    {
        $news = \App\Models\News::where('slug', $slug)->first();
        return response()->json($news);
    }

    public function getNewsByAuthorArea($id)
    {
        $news = \App\Models\News::join('users', 'users.id', '=', 'news.author_id')
            ->join('areas', 'areas.id', '=', 'users.area_id')
            ->where('areas.id', $id)
            ->select('news.*')
            ->get();

        return response()->json($news);
    }

    public function getNewsRelated($id)
    {
        $news = \App\Models\News::where('id', '!=', $id)
            ->orderBy('created_at', 'DESC')
            ->limit(5)->get();
        return response()->json($news);
    }


    public function eventos(Request $request)
    {

        $itemsPerPage = $request->limit ? $request->limit : 10;
        $items = Event::where('is_active', true)->orderBy('created_at', 'DESC')->paginate($itemsPerPage);
        return response()->json($items);
    }

    //get event by slug
    public function eventBySlug($slug)
    {
        $event = Event::where('slug', $slug)->first();
        return response()->json($event);
    }

    public function getEventsByAuthorArea($id)
    {
        $events = Event::join('users', 'users.id', '=', 'events.author_id')
            ->join('areas', 'areas.id', '=', 'users.area_id')
            ->where('areas.id', $id)
            ->select('events.*')
            ->get();

        return response()->json($events);
    }


    public function convocatorias(Request $request)
    {

        $itemsPerPage = $request->limit ? $request->limit : 10;

        $items = \App\Models\Announcement::where('is_active', true)->orderBy('created_at', 'DESC')->paginate($itemsPerPage);

        return response()->json($items);
    }

    public function publicaciones(Request $request)
    {

        //añadir paginacion
        $itemsPerPage = $request->limit ? $request->limit : 10;

        $items =  \App\Models\Publication::where('is_active', true)->orderBy('created_at', 'DESC')->paginate($itemsPerPage);

        // $publicaciones = \App\Models\Publication::where('is_active', true)->get();
        return response()->json($items);
    }

    public function publicacionesBySlug($slug)
    {
        $publicaciones = \App\Models\Publication::where('slug', $slug)->first();
        return response()->json($publicaciones);
    }

    public function getPublicacionesByAuthorArea($id)
    {
        $publicaciones = \App\Models\Publication::join('users', 'users.id', '=', 'publications.author_id')
            ->join('areas', 'areas.id', '=', 'users.area_id')
            ->where('areas.id', $id)
            ->select('publications.*')
            ->get();

        return response()->json($publicaciones);
    }

    //ultimas publicacionesrelacionad

    public function getLastRelatedPublications($id)
    {
        $publicaciones = \App\Models\Publication::where('is_active', true)
            ->where('id', '!=', $id)
            ->orderBy('created_at', 'DESC')->limit(5)->get();
        return response()->json($publicaciones);
    }

    //get avisos
    public function getAdvertisements()
    {
        $advertisements = \App\Models\Advertisement::where('is_active', true)->get();
        return response()->json($advertisements);
    }

    //get number of news, doctors, especialidades
    public function getNumbers()
    {
        $news = \App\Models\News::where('is_active', true)->count();
        $doctors = \App\Models\Worker::where('is_active', true)->where('is_doctor', true)->count();
        $specialties = \App\Models\Specialty::where('is_active', true)->count();

        $numbers = [
            'news' => $news,
            'doctors' => $doctors,
            'specialties' => $specialties
        ];

        return response()->json($numbers);
    }
}
