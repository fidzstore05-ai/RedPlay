<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GenreController extends Controller
{
    /**
     * ADMIN: Manage genres list
     */
    public function manage(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak.');
        }

        $genres = Genre::withCount('films')->orderBy('genre')->paginate(15);
        return view('genre.manage', compact('genres'));
    }

    /**
     * ADMIN: Show create genre form
     */
    public function create()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') abort(403);
        return view('genre.create');
    }

    /**
     * ADMIN: Store new genre
     */
    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') abort(403);

        $data = $request->validate([
            'genre' => 'required|string|max:255|unique:genres,genre',
        ]);

        Genre::create($data);

        return redirect()->route('genres.manage')->with('success', 'Genre berhasil ditambahkan.');
    }

    /**
     * ADMIN: Show edit genre form
     */
    public function edit($id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') abort(403);

        $genre = Genre::findOrFail($id);
        return view('genre.edit', compact('genre'));
    }

    /**
     * ADMIN: Update genre
     */
    public function update(Request $request, $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') abort(403);

        $genre = Genre::findOrFail($id);
        $data = $request->validate([
            'genre' => 'required|string|max:255|unique:genres,genre,' . $id . ',id_genre',
        ]);

        $genre->update($data);

        return redirect()->route('genres.manage')->with('success', 'Genre berhasil diupdate.');
    }

    /**
     * ADMIN: Delete genre
     */
    public function destroy($id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') abort(403);

        Genre::destroy($id);
        return redirect()->route('genres.manage')->with('success', 'Genre berhasil dihapus.');
    }
}
