<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostEditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user', 'comments')
            ->withCount('likes') // <= ini menghitung jumlah like per post
            ->latest()
            ->get();

        $data = $posts->map(fn($post) => [
            'id' => $post->id,
            'caption' => $post->caption,
            'image_path' => $post->image_path && Storage::disk('public')->exists($post->image_path)
                ? request()->getSchemeAndHttpHost() . '/api/image/' . $post->image_path
                : 'https://placehold.co/470x600',
            'user' => $post->user->only(['id', 'name', 'username']),
            'likes_count' => $post->likes_count, // langsung pakai dari withCount
            // 'is_liked' => Auth::check() ? $post->likes()->where('user_id', Auth::id())->exists() : false,
            'comments_count' => $post->comments->count(),
            'comments' => $post->comments->map(fn($comment) => [
                'id' => $comment->id,
                'content' => $comment->content,
                'user' => $comment->user->only(['id', 'name', 'username']),
                'created_at' => $comment->created_at,
            ]),
            'likes' => $post->likes->map(fn($like) => [
                'id' => $like->id,
                'user' => $like->user->only(['id', 'name', 'username']),
            ]),
            'created_at' => $post->created_at,
        ]);

        return response()->json($data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'caption' => 'nullable|string',
            'image' => 'required|image|max:2048',
        ]);

        if (!$request->hasFile('image')) {
            return response()->json(['message' => 'Image not found'], 400);
        }
        if (!$request->file('image')->isValid()) {
            return response()->json(['message' => 'Invalid image file'], 400);
        }

        $path = $request->file('image')->store('posts', 'public');

        $post = Post::create([
            'user_id' => Auth::id(),
            'caption' => $request->caption,
            'image_path' => $path,
        ]);

        return response()->json([
            'message' => 'Post created',
            'data' => $post
        ], 201);
    }

    // Lihat satu post
    public function show(Post $post)
    {
        return $post->load('user', 'likes', 'comments');
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'caption' => 'nullable|string|max:500',
        ]);

        if ($post->user_id !== Auth::id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        // Simpan log sebelum update
        PostEditLog::create([
            'post_id' => $post->id,
            'user_id' => Auth::id(),
            'old_caption' => $post->caption,
            'new_caption' => $request->input('caption'),
            'edited_at' => now(),
        ]);

        $post->update([
            'caption' => $request->input('caption'),
            'is_edited' => true, // kalau kamu juga pakai is_edited di posts
        ]);

        return response()->json([
            'message' => 'Post updated',
            'data' => $post
        ]);
    }

    // Hapus post milik sendiri
    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        // Normalize image_path if it is a full URL
        $imagePath = $post->image_path;

        // If image_path is a full URL, extract only the storage path
        if (Str::startsWith($imagePath, ['http://', 'https://'])) {
            $imagePath = Str::after($imagePath, '/storage/');
        }

        Storage::disk('public')->delete($imagePath);
        $post->delete();

        return response()->json(['message' => 'Post deleted']);
    }
}
