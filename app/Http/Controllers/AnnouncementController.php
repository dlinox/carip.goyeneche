<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnnouncementRequest;
use App\Models\Announcement;
use App\Models\AnnouncementDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AnnouncementController extends Controller
{
    protected $announcement;
    protected $announcementDocument;
    public function __construct()
    {
        $this->announcement = new Announcement();
        $this->announcementDocument = new AnnouncementDocument();
    }
    public function index(Request $request)
    {

        $perPage = $request->input('perPage', 10);
        $query = Announcement::query();

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

        return Inertia::render('admin/announcements/index', [
            'title' => 'Convocatorias',
            'subtitle' => 'Gestión de convocatorias',
            'items' => $items,
            'headers' => $this->announcement->headers,
            'filters' => [
                'search' => $request->search,
            ],
        ]);
    }

    public function store(AnnouncementRequest $request)
    {
        DB::beginTransaction();
        try {

            if ($request->id) {
                $announcement = Announcement::find($request->id);
                $announcement->title = $request->title;
                $announcement->description = $request->description;
                $announcement->save();

                foreach ($request->documents as $document) {
                    AnnouncementDocument::create([
                        'announcement_id' => $announcement->id,
                        'name' => $document['fileName'],
                        'file' => $document['file'][0]->store('documents', 'public'),
                        // $request->file('img_path')->store('finalServices', 'public');
                        'date_published' => $document['fileDate'],
                    ]);
                }
            } else {

                $announcement =  Announcement::create([
                    'title' => $request->title,
                    'description' => $request->description,
                    'date_published' => $request->date_published,
                    'author_id' => auth()->user()->id,
                ]);

                foreach ($request->documents as $document) {
                    AnnouncementDocument::create([
                        'announcement_id' => $announcement->id,
                        'name' => $document['fileName'],
                        'file' => $document['file'][0]->store('documents', 'public'),
                        // $request->file('img_path')->store('finalServices', 'public');
                        'date_published' => $document['fileDate'],
                    ]);
                }
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
        $user = Announcement::find($id);
        $user->is_active = !$user->is_active;
        $user->save();
        return redirect()->back()->with('success', 'Estado cambiado exitosamente.');
    }

    public function destroy($id)
    {
        try {
            Announcement::find($id)->delete();
            return redirect()->back()->with('success', 'Elemento eliminado exitosamente.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['Error al eliminar el elemento.', $th->getMessage()]);
        }
    }


    //Route::delete('announcements/{id}/documents/{document}',  [AnnouncementsController::class, 'documentsDestroy']);
    public function documentsDestroy($id, $document)
    {
        try {
            AnnouncementDocument::find($document)->delete();
            return redirect()->back()->with('success', 'Elemento eliminado exitosamente.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['Error al eliminar el elemento.', $th->getMessage()]);
        }
    }
}
