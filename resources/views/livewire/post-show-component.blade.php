<div class="p-4">
    {{-- @dd($post) --}}
    <h1 class="text-3xl font-bold">{{ $post->title }}</h1>
    <p class="text-gray-500">By {{ $post->author->name }} | {{ $post->created_at->format('F j, Y') }}</p>

    <div class="mt-4">
        {{-- Ensure the content is wrapped in a <div> or <article> for styling --}}
        <div class="prose dark:prose-dark">
            {{-- {!! nl2br(e($post->content)) !!}  --}}
            {!! $post->content !!}
        </div>
    </div>

    <div class="mt-8">
        <h2 class="text-2xl font-bold">Comments</h2>
        <ul class="mt-4">
            @foreach ($post->comments as $comment)
                <li class="mb-4">
                    <p class="font-bold">{{ $comment->user->name }}</p>
                    <p>{{ $comment->content }}</p>
                </li>
            @endforeach
        </ul>
    </div>
</div>
