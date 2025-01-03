<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class PostManagement extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $title;
    public $content;
    public $image;
    public $post_id;
    public $isEditing = false;
    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    protected $rules = [
        'title' => 'required|min:5',
        'content' => 'required|min:10',
        'image' => 'nullable|image|max:1024', // 1MB Max
        'status' => 'required|in:draft,published',
    ];

    public function render()
    {
        return view('livewire.post-management', [
            'posts' => Post::where('author_id', auth()->id())
                ->where('title', 'like', '%' . $this->search . '%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10)
        ])->layout('layouts.app');
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->post_id = $id;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->isEditing = true;
    }

    public function cancel()
    {
        $this->resetFields();
    }

    public function update()
    {
        $this->validate();

        $post = Post::findOrFail($this->post_id);

        $data = [
            'title' => $this->title,
            'content' => $this->content,
        ];

        if ($this->image) {
            // Delete old image if exists
            if ($post->image) {
                Storage::delete('public/posts/' . $post->image);
            }

            $imageName = time() . '.' . $this->image->extension();
            $this->image->storeAs('public/posts', $imageName);
            $data['image'] = $imageName;
        }

        $post->update($data);

        session()->flash('message', 'Post updated successfully!');
        $this->resetFields();
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);

        if ($post->image) {
            Storage::delete('public/posts/' . $post->image);
        }

        $post->delete();
        session()->flash('message', 'Post deleted successfully!');
    }

    private function resetFields()
    {
        $this->title = '';
        $this->content = '';
        $this->image = null;
        $this->post_id = null;
        $this->isEditing = false;
    }
}