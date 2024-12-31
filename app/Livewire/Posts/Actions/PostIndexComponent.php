<?php

namespace App\Livewire\Posts\Actions;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostIndexComponent extends Component
{
    use WithPagination, AuthorizesRequests;

    public $search = '';
    public $filter = 'published';
    protected $queryString = ['search', 'filter'];
    
    public function mount()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete(Post $post)
    {
        $this->authorize('delete', $post);
        
        $post->delete();
        
        session()->flash('message', 'Post deleted successfully.');
    }

    public function render()
    {
        $posts = Post::query()
            ->when($this->filter === 'published', fn($query) => $query->published())
            ->when($this->filter === 'draft', fn($query) => $query->draft())
            ->when($this->search, fn($query) => 
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('content', 'like', '%' . $this->search . '%')
            )
            ->with(['author', 'likes'])
            ->latest('published_at')
            ->paginate(12);

        return view('livewire.post-index-component', [
            'posts' => $posts
        ])->layout('layouts.app');
    }
}
