<?php

namespace App\Livewire\Posts\Actions;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;

class PostEditComponent extends Component
{
    use WithFileUploads, AuthorizesRequests;

    public Post $post;
    public $title;
    public $content = '';
    public $featured_image;
    public $status;
    public $newFeaturedImage;

    protected function rules()
    {
        return [
            'title' => 'required|min:3|max:255',
            'content' => 'required|min:50',
            'newFeaturedImage' => 'nullable|image|max:1024',
            'status' => 'required|in:draft,published'
        ];
    }

    public function mount(Post $post)
    {
        $this->authorize('update', $post);
        
        $this->post = $post;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->status = $post->status;

        // Debugging log
        Log::info('Post content:', ['content' => $this->content]);
    }

    public function save()
    {
        $this->validate();

        $this->post->title = $this->title;
        $this->post->content = $this->content;
        $this->post->status = $this->status;

        if ($this->newFeaturedImage) {
            // Delete old image if exists
            if ($this->post->featured_image) {
                Storage::delete($this->post->featured_image);
            }
            $this->post->featured_image = $this->newFeaturedImage->store('posts');
        }

        $this->post->save();

        session()->flash('message', 'Post updated successfully.');
        return redirect()->route('posts.show', $this->post);
    }

    public function render()
    {
        return view('livewire.post-edit-component')->layout('layouts.app');
    }
}
