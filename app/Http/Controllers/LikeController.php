<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggle(Post $post)
    {
        $like = $post->likes()->where('user_id', auth()->id())->first();

        if ($like) {
            $like->delete();
            $message = 'Post unliked successfully!';
        } else {
            $post->likes()->create([
                'user_id' => auth()->id(),
            ]);
            $message = 'Post liked successfully!';
        }

        if (request()->wantsJson()) {
            return response()->json([
                'message' => $message,
                'likes_count' => $post->likes()->count(),
            ]);
        }

        return back()->with('success', $message);
    }
} 