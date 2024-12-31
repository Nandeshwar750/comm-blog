<?php

namespace App\Livewire\Posts\Actions;

use App\Models\Post;
use Livewire\Component;

class PostShowComponent extends Component
{
    public Post $post;

    public function mount(Post $post)
    {
        if ($post->status === 'draft' && (!auth()->check() || auth()->id() !== $post->author_id)) {
            abort(404);
        }
        // dd($post->title);
        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.post-show-component')->layout('layouts.app');
    }
}
