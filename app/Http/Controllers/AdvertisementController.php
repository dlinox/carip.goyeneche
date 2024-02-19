<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdvertisementRequest;
use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class AdvertisementController extends Controller
{

    protected $advertisement;
    public function __construct()
    {
        $this->advertisement = new Advertisement();
    }

    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $query = Advertisement::query();

        // Búsqueda por nombre de área
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('title', 'like', '%' . $searchTerm . '%');
        }

        // mostras todo solo si es Administador
        if (auth()->user()->role !== 'Administrador') {
            $query->where('author_id', auth()->user()->id);
        }

        // Obtener resultados paginados
        $items = $query->paginate($perPage)->appends($request->query());

        return Inertia::render('admin/advertisements/index', [
            'title' => 'Avisos',
            'subtitle' => 'Gestión de avisos',
            'items' => $items,
            'headers' => $this->advertisement->headers,
            'filters' => [
                'search' => $request->search,
            ],
        ]);

        
    }

    public function store(AdvertisementRequest $request)
    {
        try{
            $data = [
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'more_info_url' => $request->more_info_url,
            ];
    
            if ($request->id) {
                $advertisement = Advertisement::find($request->id);
                $advertisement->update($data);
                if ($request->hasFile('image')) {
                    $advertisement->image = $request->file('image')->store('advertisements', 'public');

                    $advertisement->save();
                }
                return redirect()->back()->with('success', 'El slider se ha actualizado correctamente');
            }
    
            $data['author_id'] = auth()->user()->id;
            // Guardar imagen
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('advertisements', 'public');
            }
            $advertisement = Advertisement::create($data);
            return redirect()->back()->with('success', 'El slider se ha creado correctamente');
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors([
                'error' => 'Ocurrió un error al crear el slider',
                'exception' => $e->getMessage()
            ]);
        }
    }

    public function destroy( $id)
    {
        try{
            $advertisement = Advertisement::findOrFail($id);
            // Eliminar imagen
            if ($advertisement->image) {
                Storage::disk('public')->delete($advertisement->image);
            }
            // Eliminar slider
            $advertisement->delete();

            return redirect()->back()->with('success', 'El slider se ha eliminado correctamente');
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors([
                'error' => 'Ocurrió un error al eliminar el slider',
                'exception' => $e->getMessage()
            ]);
        }
    }

    public function changeState($id)
    {
        try {
            $advertisement = $this->advertisement->findOrFail($id);
            $advertisement->is_active = !$advertisement->is_active;
            $advertisement->save();
            return redirect()->back()->with('success', 'Slider actualizado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Ocurrió un error al actualizar el slider',
                'exception' => $e->getMessage()
            ]);
        }

    }
}
