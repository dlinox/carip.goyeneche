<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkerAuthorityRequest;
use App\Http\Requests\WorkerRequest;
use App\Models\Authority;
use App\Models\Specialty;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class WorkerController extends Controller
{
    protected $worker;
    public function __construct()
    {
        $this->worker = new Worker();
    }
    public function index(Request $request)
    {

        $perPage = $request->input('perPage', 10);
        $query = Worker::query();

        // Búsqueda por nombre de área
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('name', 'like', '%' . $searchTerm . '%');
        }

        // Obtener resultados paginados
        $items = $query->paginate($perPage)->appends($request->query());

        $itemsAuthorities = Authority::with('worker')->get();
        $specialties = Specialty::select('id', 'name')->get();

        return Inertia::render('admin/workers/index', [
            'items' => $items,
            'itemsAuthorities' => $itemsAuthorities,
            'headers' => $this->worker->headers,
            'specialties' => $specialties,
            'filters' => [
                'search' => $request->search,
            ],
        ]);
    }

    public function store(WorkerRequest $request)
    {

        try {
            $data = [
                'name' => $request->name,
                'paternal_surname' => $request->paternal_surname,
                'maternal_surname' => $request->maternal_surname,
                'document_number' => $request->document_number,
                'registration_code' => $request->registration_code,
                'description' => $request->description,
                'specialty_id' => $request->specialty_id,
            ];

            if ($request->id) {
                $worker = Worker::find($request->id);
                $worker->update($data);
                if ($request->hasFile('photo')) {
                    $worker->photo = $request->file('photo')->store('workers', 'public');
                    $worker->save();
                }
                return redirect()->back()->with('success', 'El trabajador se ha actualizado correctamente');
            }

            $worker = Worker::create($data);
            if ($request->hasFile('photo')) {
                $worker->photo = $request->file('photo')->store('workers', 'public');
                $worker->save();
            }
            return redirect()->back()->with('success', 'El trabajador se ha creado correctamente');
        } catch (\Throwable $th) {

            return redirect()->back()->withErrors([
                'error' => 'Ocurrió un error al crear el trabajador',
                'exception' => $th->getMessage()
            ]);
        }
    }


    public function destroy(string $id)
    {
        try {
            $user = Worker::findOrFail($id);
            //ELIMINAR FOTO
            Storage::disk('public')->delete($user->photo);
            //ELIMINAR TRABAJADOR
            $user->delete();
            return redirect()->back()->with('success', 'Trabajador eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Ocurrió un error al eliminar el trabajador',
                'exception' => $e->getMessage()
            ]);
        }
    }

    public function changeState(string $id)
    {
        try {
            $user = Worker::find($id);
            $user->is_active = !$user->is_active;
            $user->save();
            return redirect()->back()->with('success', 'Estado cambiado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Ocurrió un error al cambiar el estado del trabajador',
                'exception' => $e->getMessage()
            ]);
        }
    }


    public function authorities(WorkerAuthorityRequest $request)
    {
        DB::beginTransaction();
        try {
            Authority::updateOrCreate(
                ['id' => $request->id],
                [
                    'position' => $request->position,
                    'worker_id' => $request->worker_id,
                ]
            );
            Worker::where('id', $request->worker_id)->update(['is_authority' => true]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['Error al crear el elemento.', $th->getMessage()]);
        }
        return redirect()->back()->with('success', 'Elemento creado exitosamente.');
    }

    public function authoritiesDestroy($id)
    {
        DB::beginTransaction();

        try {
            $authority = Authority::findOrFail($id);
            Worker::where('id', $authority->worker_id)->update(['is_authority' => false]);
            $authority->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['Error al eliminar el elemento.', $th->getMessage()]);
        }
        return redirect()->back()->with('success', 'Elemento eliminado exitosamente.');
    }
}
