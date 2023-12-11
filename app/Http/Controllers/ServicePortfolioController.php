<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServicePortfolioRequest;
use App\Models\ServicePortfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServicePortfolioController extends Controller
{

    protected $servicePortfolio;
    public function __construct()
    {
        $this->servicePortfolio = new ServicePortfolio();
    }

    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);

        $query = $this->servicePortfolio->query();

        if ($request->has('search')) {
            $query->where('name', 'LIKE', "%{$request->search}%");
        }

        if (auth()->user()->role !== 'Administrador') {
            $query->where('author_id', auth()->user()->id);
        }

        $servicePortfolios = $query->paginate($perPage)->appends($request->query());

        return inertia(
            'admin/servicePortfolios/index',
            [
                'title' => 'Portafolio de servicios',
                'subtitle' => 'Gestión de portafolio de servicios',
                'items' => $servicePortfolios,
                'filters' => [
                    'search' => $request->search,
                    'perPage' => $perPage,
                ],
                'headers' => $this->servicePortfolio->headers,
            ]
        );
    }

    public function store(ServicePortfolioRequest $request)
    {
        try {
            if ($request->id) {

                $servicePortfolio = ServicePortfolio::find($request->id);
                $servicePortfolio->date_published = $request->date_published;
                $servicePortfolio->guide_name = $request->guide_name;
                $servicePortfolio->resolution_name = $request->resolution_name;

                if ($request->file('guide_file')) {
                    $servicePortfolio->guide_file = $request->file('guide_file')->store('servicePorfolio/guide', 'public');
                }
                if ($request->file('resolution_file')) {
                    $servicePortfolio->resolution_file = $request->file('resolution_file')->store('servicePorfolio/resolutions', 'public');
                }
                $servicePortfolio->save();
                return redirect()->back()->with('success', 'ServicePortfolio updated.');
            }

            ServicePortfolio::create([
                'date_published' => $request->date_published,
                'guide_name' => $request->guide_name,
                'guide_file' => $request->file('guide_file')->store('servicePorfolio/guide', 'public'),
                'resolution_name' => $request->resolution_name,
                'resolution_file' => $request->file('resolution_file')->store('servicePorfolio/resolutions', 'public'),
                'author_id' => auth()->user()->id,
            ]);

            return redirect()->back()->with('success', 'ServicePortfolio created.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Ocurrió un error al crear el portafolio de servicios',
                'exception' => $e->getMessage()
            ]);
        }
    }


    public function destroy(Request $request)
    {
        try {
            $servicePortfolio = ServicePortfolio::find($request->id);

            // Eliminar guide_file
            if ($servicePortfolio->guide_file) {
                Storage::disk('public')->delete($servicePortfolio->guide_file);
            }
            // Eliminar resolution_file
            if ($servicePortfolio->resolution_file) {
                Storage::disk('public')->delete($servicePortfolio->resolution_file);
            }
            $servicePortfolio->delete();
            return redirect()->route('service-portfolios.index')->with('success', 'Portafolio de servicios eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Ocurrió un error al eliminar el portafolio de servicios',
                'exception' => $e->getMessage()
            ]);
        }
    }

    public function changeState(Request $request)
    {
        $servicePortfolio = ServicePortfolio::find($request->id);
        $servicePortfolio->is_active = !$servicePortfolio->is_active;
        $servicePortfolio->save();
        return redirect()->back()->with('success', 'Estado del portafolio de servicios actualizado correctamente');
    }

}
