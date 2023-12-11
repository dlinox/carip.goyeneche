<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequest;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class NewsController extends Controller
{
    protected $news;
    public function __construct()
    {
        $this->news = new News();
    }
    public function index(Request $request)
    {

        $perPage = $request->input('perPage', 10);
        $query = News::query();

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

        return Inertia::render('admin/news/index', [
            'title' => 'Noticias',
            'subtitle' => 'Gestión de noticias',
            'items' => $items,
            'headers' => $this->news->headers,
            'filters' => [
                'search' => $request->search,
            ],
        ]);
    }


    public function create()
    {

        return inertia('admin/news/create');
    }


    public function store(NewsRequest $request)
    {

        if ($request->id) {

            $news = News::find($request->id);
            $news->title = $request->title;
            $news->description = $request->description;
            if ($request->file('image')) {
                $news->image = $request->file('image')->store('news', 'public');
            }
            $news->content = $request->content;
            $news->date_publish = $request->date_publish;
            $news->external_link = $request->external_link;
            $slug = strtolower($request->title);
            $slug = str_replace(' ', '-', $slug);
            $news->slug = $slug;
            $news->save();
        } else {

            $news = new News();
            $news->title = $request->title;
            $news->description = $request->description;
            $news->image = $request->file('image')->store('news', 'public');
            $news->content = $request->content;
            $news->date_publish = $request->date_publish;
            $news->external_link = $request->external_link;

            $slug = strtolower($request->title);
            $slug = str_replace(' ', '-', $slug);
            $news->slug = $slug;
            $news->author_id = auth()->user()->id;
            $news->save();
        }

        return redirect()->back()->with('success', 'Elemento creado exitosamente.');
    }

    public function edit($id)
    {
        $news = News::find($id);
        return inertia('admin/news/create', [
            'news' => $news
        ]);

    }

    public function destroy($id)
    {
        $news = News::find($id);
        $news->delete();
        return redirect()->back()
            ->with('success', 'Noticia eliminada exitosamente.');

    }

    public function changeState($id)
    {
        $user = News::find($id);
        $user->is_active = !$user->is_active;
        $user->save();
        return redirect()->back()->with('success', 'Estado cambiado exitosamente.');
    }

    public function changeFeatured($id)
    {
        $user = News::find($id);
        $user->is_featured = !$user->is_featured;
        $user->save();
        return redirect()->back()->with('success', 'Destacado cambiado exitosamente.');
    }
}
