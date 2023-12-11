<?php

namespace App\Http\Controllers;

use App\Http\Requests\IntermediateServiceRequest;
use App\Models\IntermediateService;
use App\Models\SupportingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class IntermediateServiceController extends Controller
{
    protected $intermediateService;
    public function __construct()
    {
        $this->intermediateService = new IntermediateService();
    }

    public function index(Request $request)
    {

        $perPage = $request->input('perPage', 10);
        $query = IntermediateService::query();

        // Búsqueda por nombre de área
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('name', 'like', '%' . $searchTerm . '%');
        }

        // mostrar todo solo si es un usuario administrador

        if (auth()->user()->role !== 'Administrador') {
            $query->where('author_id', auth()->user()->id);
        }

        // Obtener resultados paginados
        $items = $query->paginate($perPage)->appends($request->query());

        return Inertia::render('admin/intermediateServices/index', [
            'title' => 'Servicios Intermedios',
            'subtitle' => 'Listado de servicios intermedios',
            'items' => $items,
            'headers' => $this->intermediateService->headers,
            'filters' => [
                'search' => $request->search,
            ],
            'supportingServices' => SupportingService::where('is_active', true)->get(),
        ]);
    }

    public function store(IntermediateServiceRequest $request)
    {
        DB::beginTransaction();
        try {

            if ($request->id) {
                $intermediateService = IntermediateService::find($request->id);
                $intermediateService->name = $request->name;
                $intermediateService->supporting_service_id = $request->supporting_service_id;
                $intermediateService->description = $request->description;
                if ($request->hasFile('image')) {
                    $intermediateService->image = $request->file('image')->store('intermediate-services', 'public');
                }
                $intermediateService->save();
            } else {
                $intermediateService = IntermediateService::create([
                    'name' => $request->name,
                    'supporting_service_id' => $request->supporting_service_id,
                    'description' => $request->description,
                    'author_id' => auth()->user()->id,
                    'image' => $request->hasFile('image') ? $request->file('image')->store('intermediate-services', 'public') : null,
                ]);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Servicio intermedio guardado correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors([
                'error' => 'Ocurrió un error al crear el servicio intermedio',
                'exception' => $e->getMessage()
            ]);
        }
    }

    //changeState
    public function changeState(Request $request)
    {
        $intermediateService = IntermediateService::find($request->id);
        $intermediateService->is_active = !$intermediateService->is_active;

        $intermediateService->save();
        return redirect()->back()->with('success', 'Estado del servicio intermedio actualizado correctamente');
    }

    public function destroy($id)
    {
        try {
            $intermediateService = IntermediateService::findOrFail($id);
            // Eliminar imagen
            if ($intermediateService->image) {
                unlink(storage_path('app/public/' . $intermediateService->image));
            }
            $intermediateService->delete();
            return redirect()->back()->with('success', 'Servicio intermedio eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al eliminar el servicio intermedio');
        }
    }
}
