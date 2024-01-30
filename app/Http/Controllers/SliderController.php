<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class SliderController extends Controller
{
    

    protected $slider;
    public function __construct()
    {
        $this->slider = new Slider();
    }

    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $query = Slider::query();

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

        return Inertia::render('admin/sliders/index', [
            'title' => 'Sliders',
            'subtitle' => 'Gestión de sliders',
            'items' => $items,
            'headers' => $this->slider->headers,
            'filters' => [
                'search' => $request->search,
            ],
        ]);

        
    }

    public function store(SliderRequest $request)
    {
        try{
            $data = [
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'more_info_url' => $request->more_info_url,
            ];
    
            if ($request->id) {
                $slider = Slider::find($request->id);
                $slider->update($data);
                if ($request->hasFile('image')) {
                    $slider->image = $request->file('image')->store('sliders', 'public');


                    $slider->save();
                }
                return redirect()->back()->with('success', 'El slider se ha actualizado correctamente');
            }
    
            $data['author_id'] = auth()->user()->id;
            // Guardar imagen
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('sliders', 'public');
            }
            $slider = Slider::create($data);
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
            $slider = Slider::findOrFail($id);
            // Eliminar imagen
            if ($slider->image) {
                Storage::disk('public')->delete($slider->image);
            }
            // Eliminar slider
            $slider->delete();

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
            $slider = $this->slider->findOrFail($id);
            $slider->is_active = !$slider->is_active;
            $slider->save();
            return redirect()->back()->with('success', 'Slider actualizado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Ocurrió un error al actualizar el slider',
                'exception' => $e->getMessage()
            ]);
        }

    }
}
