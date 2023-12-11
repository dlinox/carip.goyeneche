<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfficeRequest;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfficeController extends Controller
{
    protected $office;
    public function __construct()
    {
        $this->office = new Office();
    }

    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);

        $query = $this->office->query();

        if ($request->has('search')) {
            $query->where('name', 'LIKE', "%{$request->search}%");
        }

        if(auth()->user()->role !== 'Administrador'){
            $query->where('author_id', auth()->user()->id);
        }

        $offices = $query->paginate($perPage)->appends($request->query());

        return inertia(
            'admin/offices/index',
            [
                'title' => 'Oficinas',
                'subtitle' => 'Gestión de oficinas',
                'items' => $offices,
                'filters' => [
                    'search' => $request->search,
                    'perPage' => $perPage,
                ],
                'headers' => $this->office->headers,
            ]
        );
    }

    public function store(OfficeRequest $request)
    {
       
        DB::beginTransaction();
        try {

            if ($request->id) {
                $office = Office::find($request->id);
                $office->name = $request->name;
                $office->description = $request->description;
                if ($request->hasFile('image')) {
                    $office->image = $request->file('image')->store('offices', 'public');
                }
                $office->save();
            } else {
                $office = Office::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'author_id' => auth()->user()->id,
                    'image' => $request->hasFile('image') ? $request->file('image')->store('offices', 'public') : null,
                ]);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Servicio intermedio guardado correctamente');
        } catch
        (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors([
                'error' => 'Ocurrió un error al crear el servicio intermedio',
                'exception' => $e->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $office = Office::find($id);

            // Eliminar imagen
            if ($office->image) {
                unlink(storage_path('app/public/' . $office->image));
            }

            $office->delete();
            return redirect()->back()->with('success', 'Oficina eliminada correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar la oficina');
        }
    }

    public function changeState(Request $request)
    {
        $office = Office::find($request->id);
        $office->is_active = !$office->is_active;
        $office->save();
        return redirect()->back()->with('success', 'Estado de la oficina actualizado correctamente');
    }
    
}
