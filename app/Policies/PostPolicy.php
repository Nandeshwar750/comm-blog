<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class PostPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Post $post)
    {
        Log::info('User ID: ' . $user->id . ' Post User ID: ' . $post->author_id);
        return $user->id === $post->author_id; // Only allow the owner to edit
    }
}
