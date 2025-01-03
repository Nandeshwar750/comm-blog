<?php

namespace App\Livewire\Posts\Actions;

use App\Models\Post;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Mews\Purifier\Facades\Purifier;

class PostCreateComponent extends Component
{
    use WithFileUploads, AuthorizesRequests;

    public $title;
    public $content;
    public $featured_image;
    public $status = 'draft';

    protected $rules = [
        'title' => 'required|min:3|max:255',
        'content' => 'required|min:50',
        'featured_image' => 'nullable|image|max:1024',
        'status' => 'required|in:draft,published'
    ];

    public function mount()
    {
        // Initialize empty content
        $this->content = '';
    }

    public function save()
    {
        $this->validate();

        // Sanitize the HTML content
        $sanitizedContent = Purifier::clean($this->content, [
            'HTML.Allowed' => 'h1,h2,p,b,i,a[href],ul,ol,li,img[src]', // Allow img tag with src attribute
            'HTML.AllowedAttributes' => 'a.href,img.src', // Allow href for links and src for images
        ]);

        $post = new Post();
        $post->title = $this->title;
        $post->content = $sanitizedContent; // Store sanitized HTML content
        $post->status = $this->status;
        $post->author_id = auth()->id();

        if ($this->featured_image) {
            $post->featured_image = $this->featured_image->store('posts');
        }

        $post->save();

        session()->flash('message', 'Post created successfully.');
        return redirect()->route('posts.show', $post);
    }

    public function render()
    {
        return view('livewire.post-create-component')->layout('layouts.app');
    }
}
