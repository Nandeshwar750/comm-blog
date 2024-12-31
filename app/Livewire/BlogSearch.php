<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class BlogSearch extends Component
{
    // use WithPagination;

    // public $search = '';
    // public $category = '';
    // public $sortBy = 'newest';
    // protected $queryString = [
    //     'search' => ['except' => ''],
    //     'category' => ['except' => ''],
    //     'sortBy' => ['except' => 'newest']
    // ];

    // // Reset pagination when search changes
    // public function updatingSearch()
    // {
    //     $this->resetPage();
    // }

    // public function updatingCategory()
    // {
    //     $this->resetPage();
    // }

    // public function render()
    // {
    //     $query = Post::query()
    //         ->where('status', 'published')
    //         ->when($this->search, function ($query) {
    //             $query->where(function ($query) {
    //                 $query->where('title', 'like', '%' . $this->search . '%')
    //                     ->orWhere('content', 'like', '%' . $this->search . '%')
    //                     ->orWhereHas('tags', function ($query) {
    //                         $query->where('name', 'like', '%' . $this->search . '%');
    //                     });
    //             });
    //         })
    //         ->when($this->category, function ($query) {
    //             $query->whereHas('category', function ($query) {
    //                 $query->where('slug', $this->category);
    //             });
    //         })
    //         ->when($this->sortBy === 'newest', function ($query) {
    //             $query->orderBy('created_at', 'desc');
    //         })
    //         ->when($this->sortBy === 'oldest', function ($query) {
    //             $query->orderBy('created_at', 'asc');
    //         })
    //         ->when($this->sortBy === 'popular', function ($query) {
    //             $query->orderBy('views', 'desc');
    //         });

    //     $posts = $query->paginate(10);

    //     return view('livewire.blog-search', [
    //         'posts' => $posts,
    //         'categories' => \App\Models\Category::all(),
    //         'resultCount' => $posts->total()
    //     ]);
    // }

    // public function resetFilters()
    // {
    //     $this->reset(['search', 'category', 'sortBy']);
    //     $this->resetPage();
    // }
}