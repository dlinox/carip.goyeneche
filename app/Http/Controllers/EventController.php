<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EventController extends Controller
{

    protected $event;
    public function __construct()
    {
        $this->event = new Event();
    }
    public function index(Request $request)
    {

        $perPage = $request->input('perPage', 10);
        $query = Event::query();

        // Búsqueda por nombre de área
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('title', 'like', '%' . $searchTerm . '%');
        }
        if (auth()->user()->role !== 'Administrador') {
            $query->where('author_id', auth()->user()->id);
        }
        // Obtener resultados paginados
        $items = $query->paginate($perPage)->appends($request->query());

        return Inertia::render('admin/events/index', [
            'title' => 'Eventos  y campañas',
            'subtitle' => 'Gestiona los eventos y campañas de la página',
            'items' => $items,
            'headers' => $this->event->headers,
            'filters' => [
                'search' => $request->search,
            ],
        ]);
    }


    public function create()
    {

        return inertia('admin/events/create');
    }


    public function store(EventRequest $request)
    {

        if ($request->id) {

            $item = Event::find($request->id);
            $item->title = $request->title;
            $item->description = $request->description;
            if ($request->file('image')) {
                $item->image = $request->file('image')->store('events', 'public');
            }
            $item->content = $request->content;
            $item->date_publish = $request->datePublish;
            $item->external_link = $request->externalLink;
            //del titulo sacar el slug
            $slug = strtolower($request->title);
            $slug = str_replace(' ', '-', $slug);
            $item->slug = $slug;
            $item->save();
        } else {

            $item = new Event();
            $item->title = $request->title;
            $item->description = $request->description;
            $item->image = $request->file('image')->store('events', 'public');
            $item->content = $request->content;
            $item->date_publish = $request->datePublish;
            $item->external_link = $request->externalLink;

            $slug = strtolower($request->title);
            $slug = str_replace(' ', '-', $slug);
            $item->slug = $slug;
            $item->author_id = auth()->user()->id;
            $item->save();
        }

        return redirect()->back()->with('success', 'Elemento creado exitosamente.');
    }

    public function edit($id)
    {
        $item = Event::find($id);
        $item->datePublish = $item->date_publish;
        $item->externalLink = $item->external_link;
        $item->imageUrl = $item->image_url;
        $item->image = null;
        return inertia('admin/events/create', [
            'item' => $item
        ]);
    }

    public function destroy($id)
    {
        $item = Event::find($id);
        $item->delete();
        return redirect()->back()
            ->with('success', 'Noticia eliminada exitosamente.');
    }

    public function changeState($id)
    {
        $event = Event::find($id);
        $event->is_active = !$event->is_active;
        $event->save();
        return redirect()->back()->with('success', 'Estado cambiado exitosamente.');
    }

    //changeFeatured
    public function changeFeatured($id)
    {
        $event = Event::find($id);
        $event->is_featured = !$event->is_featured;
        $event->save();
        return redirect()->back()->with('success', 'Destacado cambiado exitosamente.');
    }
}
