<?php

namespace App\Http\Controllers;

use App\Models\PurchaseAndService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PurchaseAndServiceController extends Controller
{
    protected $purchaseAndService;

    public function __construct()
    {
        $this->purchaseAndService = new PurchaseAndService();

    }

    public function index()
    {
        $purchaseAndServices = PurchaseAndService::first();
        return Inertia::render('admin/purchaseAndService/index', [
            'item' => $purchaseAndServices
        ]);
    }

    public function store(Request $request){

        $this->validate($request, [
            'url_information' => 'required|url',

        ], 
        [
            'url_information.required' => 'El campo url es obligatorio',
            'url_information.url' => 'El campo url debe ser una url válida',
        ]);

        PurchaseAndService::create([
            'url_information' => $request->url_information,
        ]);
        return redirect()->back()->with('success', 'Información actualizada correctamente');
    }

    public function update(Request $request, $id){

        $this->validate($request, [
            'url_information' => 'required|url',
        ]);

        $purchaseAndService = PurchaseAndService::find($id);
        $purchaseAndService->update([
            'url_information' => $request->url_information,
        ]);
        return redirect()->back()->with('success', 'Información actualizada correctamente');
    }
}
