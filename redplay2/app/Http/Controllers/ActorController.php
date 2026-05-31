<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActorController extends Controller
{
    /**
     * ADMIN: Manage actors list
     */
    public function manage(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak.');
        }

        $actors = Actor::withCount('films')->orderBy('namaaktor')->paginate(15);
        return view('actor.manage', compact('actors'));
    }

    /**
     * ADMIN: Show create actor form
     */
    public function create()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') abort(403);
        return view('actor.create');
    }

    /**
     * ADMIN: Store new actor
     */
    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') abort(403);

        $data = $request->validate([
            'namaaktor' => 'required|string|max:255|unique:actors,namaaktor',
        ]);

        Actor::create($data);

        return redirect()->route('actors.manage')->with('success', 'Aktor berhasil ditambahkan.');
    }

    /**
     * ADMIN: Show edit actor form
     */
    public function edit($id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') abort(403);

        $actor = Actor::findOrFail($id);
        return view('actor.edit', compact('actor'));
    }

    /**
     * ADMIN: Update actor
     */
    public function update(Request $request, $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') abort(403);

        $actor = Actor::findOrFail($id);
        $data = $request->validate([
            'namaaktor' => 'required|string|max:255|unique:actors,namaaktor,' . $id . ',id_aktor',
        ]);

        $actor->update($data);

        return redirect()->route('actors.manage')->with('success', 'Aktor berhasil diupdate.');
    }

    /**
     * ADMIN: Delete actor
     */
    public function destroy($id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') abort(403);

        Actor::destroy($id);
        return redirect()->route('actors.manage')->with('success', 'Aktor berhasil dihapus.');
    }
}
