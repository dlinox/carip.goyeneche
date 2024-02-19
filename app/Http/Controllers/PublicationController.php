<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublicationRequest;
use App\Models\Publication;
use App\Models\PublicationDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Inertia\Inertia;

class PublicationController extends Controller
{
    protected $publication;

    public function __construct()
    {
        $this->publication = new Publication();
    }

    public function index(Request $request)
    {

        $perPage = $request->input('perPage', 10);
        $query = Publication::query();

        // Búsqueda por nombre de área
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('name', 'like', '%' . $searchTerm . '%');
        }


        if (auth()->user()->role !== 'Administrador') {
            $query->where('author_id', auth()->user()->id);
        }



        // Obtener resultados paginados
        $items = $query->paginate($perPage)->appends($request->query());

        return Inertia::render('admin/publications/index', [
            'title' => 'Publicaciones',
            'subtitle' => 'Gestiona las publicaciones',
            'items' => $items,
            'headers' => $this->publication->headers,
            'filters' => [
                'search' => $request->search,
            ],
        ]);
    }

    public function store(PublicationRequest $request)
    {
        DB::beginTransaction();
        try {

            if ($request->id) {

                $publication = Publication::find($request->id);
                $publication->name = $request->name;
                $publication->description = $request->description;


                $slug = Str::slug($request->name);

                $publication->slug = $slug;

                if ($request->hasFile('image')) {
                    $publication->image = $request->file('image')->store('publications', 'public');
                }

                foreach ($request->documents as $document) {
                    PublicationDocument::create([
                        'publication_id' => $publication->id,
                        'name' => $document['fileName'],
                        'file' => $document['file'][0]->store('documents/publications', 'public'),
                        'date_published' => $document['fileDate'],

                    ]);
                }

                $publication->save();
            } else {


                $slug = Str::slug($request->name);

                $publication = Publication::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'author_id' => auth()->user()->id,
                    'image' => $request->file('image')->store('publications', 'public'),
                    'slug' => $slug,

                ]);

                $documents = $request->documents ? $request->documents : [];
                foreach ($documents as $document) {
                    PublicationDocument::create([
                        'publication_id' => $publication->id,
                        'name' => $document['fileName'],
                        'file' => $document['file'][0]->store('documents/publications', 'public'),
                        'date_published' => $document['fileDate'],
                    ]);
                }
            }

            DB::commit();

            return redirect()->back()->with('success', 'Elemento creado exitosamente.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['Error al crear el elemento.', $th->getMessage()]);
        }
    }


    public function changeState($id)
    {
        $user = Publication::find($id);
        $user->is_active = !$user->is_active;
        $user->save();
        return redirect()->back()->with('success', 'Estado cambiado exitosamente.');
    }

    public function documentsDestroy($id, $document)
    {
        try {
            PublicationDocument::find($document)->delete();
            return redirect()->back()->with('success', 'Elemento eliminado exitosamente.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['Error al eliminar el elemento.', $th->getMessage()]);
        }
    }

    public function destroy($id)
    {
        //primero se eliminan los documentos
        $documents = PublicationDocument::where('publication_id', $id)->get();
        foreach ($documents as $document) {
            //se elimina el archivo
            unlink(storage_path('app/public/' . $document->file));
            $document->delete();
        }
        //luego se elimina la publicación
        $user = Publication::find($id);
        $user->delete();
        return redirect()->back()->with('success', 'Elemento eliminado exitosamente.');
    }
}
