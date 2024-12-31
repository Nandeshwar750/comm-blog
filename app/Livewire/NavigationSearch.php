<?php
// app/Livewire/NavigationSearch.php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Str;

class NavigationSearch extends Component
{
    public $query = '';
    public $results = [];
    public $showResults = false;

    public function updatedQuery()
    {
        if (strlen($this->query) < 2) {
            $this->results = [];
            $this->showResults = false;
            return;
        }

        $this->results = Post::where('status', 'published')
            ->where(function ($query) {
                $query->where('title', 'like', '%' . $this->query . '%')
                    ->orWhere('content', 'like', '%' . $this->query . '%');
            })
            ->take(5)
            ->get()
            ->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'excerpt' => Str::limit(strip_tags($post->content), 100),
                    'url' => route('posts.show', $post)
                ];
            });

        $this->showResults = true;
    }

    public function closeResults()
    {
        $this->showResults = false;
    }

    public function render()
    {
        return view('livewire.navigation-search');
    }

    public function viewAllResults()
    {
        return redirect()->route('search', ['query' => $this->query]);
    }
}