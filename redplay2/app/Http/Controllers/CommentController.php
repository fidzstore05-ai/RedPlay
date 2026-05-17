<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate(['isi_komentar' => 'required|string|max:1000']);

        Comment::create([
            'film_id_film'  => $id,
            'user_id_user'  => Auth::id(),
            'isi_komentar'  => $request->isi_komentar,
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        if (Auth::id() !== $comment->user_id_user && Auth::user()->role !== 'admin') {
            abort(403);
        }

        $comment->delete();
        return back()->with('success', 'Komentar dihapus.');
    }
}
