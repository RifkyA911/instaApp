<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Menampilkan semua like milik user yang sedang login.
     */
    public function index()
    {
        $likes = Like::with('post')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return response()->json([
            'data' => $likes
        ]);
    }

    /**
     * Menampilkan like tertentu berdasarkan ID.
     */
    public function show(Post $post, Like $like)
    {
        if ($like->post_id !== $post->id) {
            return response()->json(['message' => 'Invalid relationship'], 400);
        }

        if ($like->user_id !== Auth::id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        return response()->json([
            'data' => $like->load('post', 'user')
        ]);
    }


    /**
     * Menyukai sebuah post.
     */
    public function store(Post $post)
    {
        $userId = Auth::id();

        $existing = Like::where('user_id', $userId)
            ->where('post_id', $post->id)
            ->first();

        if ($existing) {
            return response()->json([
                'message' => 'You have already liked this post.'
            ], 400);
        }

        $like = Like::create([
            'user_id' => $userId,
            'post_id' => $post->id,
        ]);

        return response()->json([
            'message' => 'Post liked',
            'data' => $like
        ], 201);
    }

    /**
     * Mengubah like (misalnya hanya untuk keperluan demonstrasi).
     */
    public function update(Request $request, Post $post, Like $like)
    {
        if ($like->post_id !== $post->id) {
            return response()->json(['message' => 'Invalid relationship'], 400);
        }

        return response()->json([
            'message' => 'Update not implemented',
            'data' => $like,
        ], 200);
    }


    /**
     * Menghapus like dari post.
     */
    public function destroy(Post $post)
    {
        $like = Like::where('user_id', Auth::id())
            ->where('post_id', $post->id)
            ->first();

        if (!$like) {
            return response()->json([
                'message' => 'You have not liked this post.'
            ], 400);
        }

        $like->delete();

        return response()->json([
            'message' => 'Post unliked'
        ]);
    }
}
