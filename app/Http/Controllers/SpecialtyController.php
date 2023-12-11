<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpecialtyRequest;
use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    protected $specialty;

    public function __construct()
    {
        $this->specialty = new Specialty();
    }


    public function index(Request $request)
    {

        $perPage = $request->input('perPage', 10);

        $query = $this->specialty->query();
        if ($request->has('search')) {
            $query->where('name', 'LIKE', "%{$request->search}%");
        }

        $items = $query->paginate($perPage)->appends($request->query());

        return inertia(
            'admin/specialties/index',
            [
                'title' => 'Especialidades',
                'subtitle' => 'Gestión de especialidades',
                'items' => $items,
                'filters' => [
                    'search' => $request->search,
                    'perPage' => $perPage,
                ],
                'headers' => $this->specialty->headers
            ]
        );
    }

    public function store(SpecialtyRequest $request)
    {
        try {
            $data = $request->all();
            $this->specialty->create($data);
            return redirect()->back()->with('success', 'Especialidad creada correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Ocurrió un error al crear la especialidad',
                'exception' => $e->getMessage()
            ]);
        }
    }

    public function update(SpecialtyRequest $request, $id)
    {
        try {
            $data = $request->all();
            $specialty = $this->specialty->findOrFail($id);
            $specialty->update($data);
            return redirect()->back()->with('success', 'Especialidad actualizada correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Ocurrió un error al actualizar la especialidad',
                'exception' => $e->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $specialty = $this->specialty->findOrFail($id);
            $specialty->delete();
            return redirect()->back()->with('success', 'Especialidad eliminada correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Ocurrió un error al eliminar la especialidad',
                'exception' => $e->getMessage()
            ]);
        }
        
    }

    public function changeState($id)
    {
        try {
            $specialty = $this->specialty->findOrFail($id);
            $specialty->is_active = !$specialty->is_active;
            $specialty->save();
            return redirect()->back()->with('success', 'Especialidad actualizada correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Ocurrió un error al actualizar la especialidad',
                'exception' => $e->getMessage()
            ]);
        }

    }
}
