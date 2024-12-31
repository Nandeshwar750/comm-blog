<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::published()
            ->with(['author', 'likes'])
            ->latest('published_at')
            ->paginate(10);

        return view('home', compact('posts'));
    }
} 