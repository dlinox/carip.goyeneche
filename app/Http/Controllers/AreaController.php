<?php

namespace App\Http\Controllers;

use App\Http\Requests\AreaRequest;
use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{

    protected $area;

    public function __construct()
    {
        $this->area = new Area();
    }


    public function index(Request $request)
    {

        $perPage = $request->input('perPage', 10);

        $query = $this->area->query();
        if ($request->has('search')) {
            $query->where('name', 'LIKE', "%{$request->search}%");
        }

        $users = $query->paginate($perPage)->appends($request->query());

        $medicalIcons = config('app.medicalFigures');

        return inertia(
            'admin/areas/index',
            [
                'title' => 'Áreas',
                'subtitle' => 'Gestión de áreas',
                'items' => $users,
                'filters' => [
                    'search' => $request->search,
                    'perPage' => $perPage,
                ],
                'headers' => $this->area->headers,
                'medicalIcons' => $medicalIcons,
            ]
        );
    }

    public function store(AreaRequest $request)
    {
        try {
            $data = $request->all();
            $this->area->create($data);
            return redirect()->back()->with('success', 'Área creada correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Ocurrió un error al crear el área',
                'exception' => $e->getMessage()
            ]);
        }
    }

    public function update(AreaRequest $request, $id)
    {
        try {
            $data = $request->all();
            $area = $this->area->findOrFail($id);
            $area->update($data);
            return redirect()->back()->with('success', 'Área actualizada correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Ocurrió un error al actualizar el área',
                'exception' => $e->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $area = $this->area->findOrFail($id);
            $area->delete();
            return redirect()->back()->with('success', 'Área eliminada correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Ocurrió un error al eliminar el área',
                'exception' => $e->getMessage()
            ]);
        }
        
    }

    public function changeState($id)
    {
        try {
            $area = $this->area->findOrFail($id);
            $area->is_active = !$area->is_active;
            $area->save();
            return redirect()->back()->with('success', 'Área actualizada correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Ocurrió un error al actualizar el área',
                'exception' => $e->getMessage()
            ]);
        }

    }
}
