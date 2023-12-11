<?php

namespace App\Http\Controllers;

use App\Http\Requests\FinalServiceRequest;
use App\Models\FinalService;
use App\Models\Specialty;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class FinalServiceController extends Controller
{
    protected $finalService;
    public function __construct()
    {
        $this->finalService = new FinalService();
    }

    public function index(Request $request)
    {

        $perPage = $request->input('perPage', 10);
        $query = FinalService::query();

        // Búsqueda por nombre de área
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('name', 'like', '%' . $searchTerm . '%');
        }

        // mostras todo solo si es Administador
        if (auth()->user()->role !== 'Administrador') {
            $query->where('author_id', auth()->user()->id);
        }

        // Obtener resultados paginados
        $items = $query->paginate($perPage)->appends($request->query());

        return Inertia::render('admin/finalServices/index', [
            'title' => 'Servicios Finales',
            'subtitle' => 'Listado de servicios finales',
            'items' => $items,
            'headers' => $this->finalService->headers,
            'filters' => [
                'search' => $request->search,
            ],
            'specialties' => Specialty::where('is_active', true)->get(),
            'doctors' => Worker::where('is_active', true)->get(),
        ]);
    }

    public function store(FinalServiceRequest $request)
    {
        DB::beginTransaction();
        try {

            if ($request->id) {
                $finalService = FinalService::find($request->id);
                $finalService->name = $request->name;
                $finalService->specialty_id = $request->specialty_id;
                $finalService->worker_id = $request->worker_id;
                $finalService->description = $request->description;
                if ($request->hasFile('image')) {
                    $finalService->image = $request->file('image')->store('finalServices', 'public');
                }
                $finalService->save();
            } else {

                FinalService::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'specialty_id' => $request->specialty_id,
                    'worker_id' => $request->worker_id,
                    'author_id' => auth()->user()->id,
                    'image' => $request->file('image')->store('finalServices', 'public'),
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['Error al crear el elemento.', $th->getMessage()]);
        }
        return redirect()->back()->with('success', 'Elemento creado exitosamente.');
    }


    public function changeState($id)
    {
        $user = FinalService::find($id);
        $user->is_active = !$user->is_active;
        $user->save();
        return redirect()->back()->with('success', 'Estado cambiado exitosamente.');
    }

    public function destroy($id)
    {
        $user = FinalService::find($id);
        $user->delete();
        return redirect()->back()->with('success', 'Elemento eliminado exitosamente.');
    }
}
