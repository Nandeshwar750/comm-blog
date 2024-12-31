<!-- resources/views/livewire/search-results.blade.php -->
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-4">
                    Search Results for "{{ $query }}"
                </h2>

                @if ($posts->isEmpty())
                    <p class="text-gray-500 dark:text-gray-400">No results found.</p>
                @else
                    <div class="space-y-6">
                        @foreach ($posts as $post)
                            <article class="border-b border-gray-200 dark:border-gray-700 pb-4 last:border-0">
                                <h3 class="text-xl font-semibold">
                                    <a href="{{ route('posts.show', $post) }}"
                                        class="hover:text-blue-600 dark:hover:text-blue-400">
                                        {{ $post->title }}
                                    </a>
                                </h3>
                                <p class="text-gray-600 dark:text-gray-400 mt-2">
                                    {{ Str::limit(strip_tags($post->content), 200) }}
                                </p>
                            </article>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $posts->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>