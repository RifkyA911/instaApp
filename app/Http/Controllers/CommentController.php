<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentEditLog;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(Post $post)
    {
        return $post->comments()->with('user')->latest()->get();
    }

    public function show(Post $post, Comment $comment)
    {
        // Pastikan komentar benar-benar milik post yang diminta
        if ($comment->post_id !== $post->id) {
            return response()->json(['message' => 'Invalid relationship'], 400);
        }

        return response()->json([
            'data' => $comment->load('user') // kalau ingin include data user
        ]);
    }


    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:500'
        ]);

        $comment = $post->comments()->create([
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
        ]);

        return response()->json([
            'message' => 'Comment added',
            'data' => $comment->load('user')
        ], 201);
    }

    public function update(Request $request, Post $post, Comment $comment)
    {
        $request->validate([
            'content' => 'required|string|max:500'
        ]);

        if ($comment->post_id !== $post->id) {
            return response()->json(['message' => 'Invalid relationship'], 400);
        }

        if ($comment->user_id !== Auth::id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        // Simpan log edit sebelum update
        CommentEditLog::create([
            'comment_id' => $comment->id,
            'user_id' => Auth::id(),
            'old_content' => $comment->content,
            'new_content' => $request->input('content'),
            'edited_at' => now(),
        ]);

        $comment->update([
            'content' => $request->input('content'),
            'is_edited' => true,
        ]);

        return response()->json([
            'message' => 'Comment updated',
            'data' => $comment->load('user')
        ]);
    }


    public function destroy(Post $post, Comment $comment)
    {
        // Pastikan komentar ini memang milik post terkait
        if ($comment->post_id !== $post->id) {
            return response()->json(['message' => 'Invalid relationship'], 400);
        }

        if ($comment->user_id !== Auth::id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $comment->delete();

        return response()->json(['message' => 'Comment deleted']);
    }

}
