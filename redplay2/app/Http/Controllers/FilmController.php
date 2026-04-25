<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
use App\Models\User;
use App\Models\Actor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilmController extends Controller
{
    /**
     * Display a listing of the films with search and filter.
     */
    public function index(Request $request)
    {
        $query = Film::with(['genres', 'actors']);

        // Pencarian berdasarkan judul, deskripsi, atau nama genre
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($sub) use ($q) {
                $sub->where('judul', 'like', '%' . $q . '%')
                    ->orWhere('deskripsi', 'like', '%' . $q . '%')
                    ->orWhereHas('genres', function($gq) use ($q) {
                        $gq->where('genre', 'like', '%' . $q . '%');
                    })
                    ->orWhereHas('actors', function($aq) use ($q) {
                        $aq->where('namaaktor', 'like', '%' . $q . '%');
                    });
            });
        }

        // Filter berdasarkan Genre (dropdown)
        if ($request->filled('genre')) {
            $query->whereHas('genres', function($gq) use ($request) {
                $gq->where('genres.id_genre', $request->genre);
            });
        }

        // Filter berdasarkan Rating minimum
        if ($request->filled('rating')) {
            $query->where('rating', '>=', $request->rating);
        }

        // Filter berdasarkan Tahun
        if ($request->filled('tahun')) {
            $query->whereYear('tahun', $request->tahun);
        }

        $films = $query->latest('id_film')->paginate(12)->withQueryString();
        $genres = Genre::withCount('films')->get();

        // Home screen specific data (only loaded when not searching)
        $heroFilms     = Film::with('genres')->latest('id_film')->take(5)->get();
        $latestFilms   = Film::with('genres')->latest('id_film')->take(6)->get();
        $topRatedFilms = Film::orderByDesc('rating')->take(12)->get();

        // Stats
        $stats = [
            'total_films'  => Film::count(),
            'total_genres' => Genre::count(),
            'total_actors' => class_exists(\App\Models\Actor::class) ? \App\Models\Actor::count() : 0,
            'total_users'  => \App\Models\User::count(),
        ];

        return view('film.index', compact('films', 'genres', 'heroFilms', 'latestFilms', 'topRatedFilms', 'stats'));
    }

    /**
     * Watch page for a film.
     */
    public function watch($id)
    {
        $film = Film::with(['genres', 'actors', 'comments.user', 'comments.likes'])->findOrFail($id);

        $genreIds = $film->genres->pluck('id_genre')->toArray();
        $recommendations = Film::whereHas('genres', function($q) use ($genreIds) {
            $q->whereIn('genres.id_genre', $genreIds);
        })
        ->where('id_film', '!=', $id)
        ->limit(8)
        ->get();

        return view('film.watch', compact('film', 'recommendations'));
    }

    /**
     * Show the detailed information for a film and recommendations.
     */
    public function show($id)
    {
        $film = Film::with(['genres', 'actors', 'comments.user'])->findOrFail($id);

        $genreIds = $film->genres->pluck('id_genre')->toArray();
        $recommendations = Film::whereHas('genres', function($q) use ($genreIds) {
            $q->whereIn('genres.id_genre', $genreIds);
        })
        ->where('id_film', '!=', $id)
        ->limit(6)
        ->get();

        return view('film.show', compact('film', 'recommendations'));
    }

    /**
     * ADMIN: Show create film form
     */
    public function create()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak.');
        }

        $genres = Genre::orderBy('genre')->get();
        $actors = Actor::orderBy('namaaktor')->get();

        return view('film.create', compact('genres', 'actors'));
    }

    /**
     * ADMIN: Manage films list
     */
    public function manage(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak.');
        }

        $query = Film::with(['genres', 'actors']);
        if ($request->filled('q')) {
            $query->where('judul', 'like', '%' . $request->q . '%');
        }

        $films  = $query->latest('id_film')->paginate(15)->withQueryString();
        $genres = Genre::orderBy('genre')->get();
        $actors = Actor::orderBy('namaaktor')->get();

        return view('film.manage', compact('films', 'genres', 'actors'));
    }

    /**
     * ADMIN: Store new film
     */
    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') abort(403);

        $data = $request->validate([
            'judul'      => 'required|string|max:255',
            'deskripsi'  => 'nullable|string',
            'tahun'      => 'nullable|date',
            'rating'     => 'nullable|numeric|min:0|max:10',
            'thumbnail'  => 'nullable|string',
            'video'      => 'nullable|string',
            'subtitle'   => 'nullable|string',
            'sutradara'  => 'nullable|string|max:255',
            'durasi'     => 'nullable|string|max:100',
        ]);

        $film = Film::create($data);
        $film->genres()->sync($request->input('genres', []));
        $film->actors()->sync($request->input('actors', []));

        return redirect()->route('films.manage')->with('success', 'Film berhasil ditambahkan.');
    }

    /**
     * ADMIN: Update film
     */
    public function update(Request $request, $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') abort(403);

        $film = Film::findOrFail($id);
        $data = $request->validate([
            'judul'      => 'required|string|max:255',
            'deskripsi'  => 'nullable|string',
            'tahun'      => 'nullable|date',
            'rating'     => 'nullable|numeric|min:0|max:10',
            'thumbnail'  => 'nullable|string',
            'video'      => 'nullable|string',
            'subtitle'   => 'nullable|string',
            'sutradara'  => 'nullable|string|max:255',
            'durasi'     => 'nullable|string|max:100',
        ]);

        $film->update($data);
        $film->genres()->sync($request->input('genres', []));
        $film->actors()->sync($request->input('actors', []));

        return redirect()->route('films.manage')->with('success', 'Film berhasil diupdate.');
    }

    /**
     * ADMIN: Delete film
     */
    public function destroy($id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') abort(403);

        Film::destroy($id);
        return redirect()->route('films.manage')->with('success', 'Film berhasil dihapus.');
    }
}