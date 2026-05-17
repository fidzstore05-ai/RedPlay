<?php

namespace App\Http\Controllers;

use App\Models\CommentLike;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentLikeController extends Controller
{
    /**
     * Toggle like on a comment (AJAX).
     */
    public function toggle(Request $request, $commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $userId  = Auth::id();

        $existing = CommentLike::where('comment_id', $commentId)
                               ->where('user_id', $userId)
                               ->first();

        if ($existing) {
            $existing->delete();
            $liked = false;
        } else {
            CommentLike::create([
                'comment_id' => $commentId,
                'user_id'    => $userId,
            ]);
            $liked = true;
        }

        $count = CommentLike::where('comment_id', $commentId)->count();

        return response()->json(['liked' => $liked, 'count' => $count]);
    }
}
