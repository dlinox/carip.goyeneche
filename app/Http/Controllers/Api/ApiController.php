<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InstitutionalInformation;
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

    public function news()
    {
        //get 10 last news
        $news = \App\Models\News::where('is_active', true)->orderBy('created_at', 'DESC')->take(5)->get();
        return response()->json($news);
    }

    public function areas()
    {
        $areas = \App\Models\Area::where('is_active', true)->get();
        return response()->json($areas);
    }

    public function doctors()
    {
        $doctors = \App\Models\Worker::where('is_active', true)->get();
        return response()->json($doctors);
    }

}
