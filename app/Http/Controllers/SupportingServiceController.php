<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupportingServiceRequest;
use App\Models\SupportingService;
use Illuminate\Http\Request;

class SupportingServiceController extends Controller
{
    protected $supportingService;

    public function __construct()
    {
        $this->supportingService = new SupportingService();
    }


    public function index(Request $request)
    {

        $perPage = $request->input('perPage', 10);

        $query = $this->supportingService->query();
        if ($request->has('search')) {
            $query->where('name', 'LIKE', "%{$request->search}%");
        }

        $items = $query->paginate($perPage)->appends($request->query());

        return inertia(
            'admin/supportingServices/index',
            [
                'title' => 'Servicios de apoyo',
                'subtitle' => 'Gestión de servicios de apoyo',
                'items' => $items,
                'filters' => [
                    'search' => $request->search,
                    'perPage' => $perPage,
                ],
                'headers' => $this->supportingService->headers
            ]
        );
    }

    public function store(SupportingServiceRequest $request)
    {
        try {
            $data = $request->all();
            $this->supportingService->create($data);
            return redirect()->back()->with('success', 'Servicio de apoyo creado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Ocurrió un error al crear el servicio de apoyo',
                'exception' => $e->getMessage()
            ]);
        }
    }

    public function update(SupportingServiceRequest $request, $id)
    {
        try {
            $data = $request->all();
            $specialty = $this->supportingService->findOrFail($id);
            $specialty->update($data);
            return redirect()->back()->with('success', 'Servicio de apoyo actualizado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Ocurrió un error al actualizar el servicio de apoyo',
                'exception' => $e->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $specialty = $this->supportingService->findOrFail($id);
            $specialty->delete();
            return redirect()->back()->with('success', 'Servicio de apoyo eliminada correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Ocurrió un error al eliminar el Servicio de apoyo',
                'exception' => $e->getMessage()
            ]);
        }
        
    }

    public function changeState($id)
    {
        try {
            $specialty = $this->supportingService->findOrFail($id);
            $specialty->is_active = !$specialty->is_active;
            $specialty->save();
            return redirect()->back()->with('success', 'Servicio de apoyo actualizada correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Ocurrió un error al actualizar el servicio de apoyo',
                'exception' => $e->getMessage()
            ]);
        }

    }
}
