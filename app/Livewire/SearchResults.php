<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class SearchResults extends Component
{
    use WithPagination;
    
    public $query = '';
    
    public function mount()
    {
        $this->query = request('query');
    }

    public function render()
    {
        $posts = Post::where('status', 'published')
            ->where(function ($query) {
                $query->where('title', 'like', '%' . $this->query . '%')
                    ->orWhere('content', 'like', '%' . $this->query . '%');
            })
            ->paginate(10);

        return view('livewire.search-results', [
            'posts' => $posts
        ]);
    }
}