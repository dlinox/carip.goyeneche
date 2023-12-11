<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuidanceDocumentRequest;
use App\Models\GuidanceDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuidanceDocumentController extends Controller
{
    protected $guidanceDocument;

    public function __construct()
    {
        $this->guidanceDocument = new GuidanceDocument();
    }

    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);

        $query = $this->guidanceDocument->query();

        if ($request->has('search')) {
            $query->where('name', 'LIKE', "%{$request->search}%");
        }

        if (auth()->user()->role !== 'Administrador') {
            $query->where('author_id', auth()->user()->id);
        }

        $guidanceDocument = $query->paginate($perPage)->appends($request->query());

        return inertia(
            'admin/guidanceDocuments/index',
            [
                'title' => 'Documentos de orientación',
                'subtitle' => 'Gestión de documentos de orientación',
                'items' => $guidanceDocument,
                'filters' => [
                    'search' => $request->search,
                    'perPage' => $perPage,
                ],
                'headers' => $this->guidanceDocument->headers,
            ]
        );
    }

    public function store(GuidanceDocumentRequest $request)
    {
        try {
            if ($request->id) {

                $guidanceDocument = GuidanceDocument::find($request->id);
                $guidanceDocument->date_published = $request->date_published;
                $guidanceDocument->guide_name = $request->guide_name;
                $guidanceDocument->resolution_name = $request->resolution_name;

                if ($request->file('guide_file')) {
                    $guidanceDocument->guide_file = $request->file('guide_file')->store('guidanceDocuments/guide', 'public');
                }
                if ($request->file('resolution_file')) {
                    $guidanceDocument->resolution_file = $request->file('resolution_file')->store('guidanceDocuments/resolutions', 'public');
                }
                $guidanceDocument->save();
                return redirect()->back()->with('success', 'ServicePortfolio updated.');
            }

            GuidanceDocument::create([
                'date_published' => $request->date_published,
                'guide_name' => $request->guide_name,
                'guide_file' => $request->file('guide_file')->store('guidanceDocuments/guide', 'public'),
                'resolution_name' => $request->resolution_name,
                'resolution_file' => $request->file('resolution_file') ?  $request->file('resolution_file')->store('guidanceDocuments/resolutions', 'public'): null,
                'author_id' => auth()->user()->id,
            ]);

            return redirect()->back()->with('success', 'Portafolio de servicios guardado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Ocurrió un error al crear el portafolio de servicios',
                'exception' => $e->getMessage()
            ]);
        }
    }


    public function destroy($id)
    {
        try {
            $guidanceDocument = GuidanceDocument::find($id);

            // Eliminar guide_file
            if ($guidanceDocument->guide_file) {
                Storage::disk('public')->delete($guidanceDocument->guide_file);
            }
            // Eliminar resolution_file
            if ($guidanceDocument->resolution_file) {
                Storage::disk('public')->delete($guidanceDocument->resolution_file);
            }
            $guidanceDocument->delete();
            return redirect()->back()->with('success', 'Portafolio de servicios eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Ocurrió un error al eliminar el portafolio de servicios',
                'exception' => $e->getMessage()
            ]);
        }
    }

    public function changeState(Request $request)
    {
        $guidanceDocument = GuidanceDocument::find($request->id);
        $guidanceDocument->is_active = !$guidanceDocument->is_active;
        $guidanceDocument->save();
        return redirect()->back()->with('success', 'Estado del portafolio de servicios actualizado correctamente');
    }
}
