<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstitutionalInformationRequest;
use App\Models\InstitutionalInformation;
use App\Models\InstitutionalObjetive;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InstitutionalInformationController extends Controller
{
    public function index()
    {
        $institutional = InstitutionalInformation::first();
        // $objetives = InstitutionalObjetive::all();
        return Inertia::render('admin/institutionalInformation/index', [
            'institutional' => $institutional,
            'objetives' => InstitutionalObjetive::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(InstitutionalInformationRequest $request)
    {
       
        try {
    
            $data = [
                'name' => $request->name,
                'description' => $request->description,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'about_us' => $request->about_us,
                'mission' => $request->mission,
                'vision' => $request->vision,
            ];
    
            if ($request->file('organigram')) {
                $data['organigram'] = $request->file('organigram')->store('organigram', 'public');
            }

            if ($request->file('logo')) {
                $data['logo'] = $request->file('logo')->store('logo', 'public');
            }

            if ($request->file('favicon')) {
                $data['favicon'] = $request->file('favicon')->store('favicon', 'public');
            }
    
            InstitutionalInformation::updateOrCreate(
                ['id' =>  $request->id],
                $data
            );

            return redirect()->back()->with('success', 'Información institucional actualizada correctamente');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Ocurrio un error al actualizar la información institucional');
        }
    }


}
