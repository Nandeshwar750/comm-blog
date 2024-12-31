{{-- <!-- resources/views/livewire/blog-search.blade.php -->
<div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Search Header -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                {{ __('Search Blog Posts') }}
            </h2>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                {{ $resultCount }} {{ Str::plural('result', $resultCount) }} found
            </p>
        </div>

        <!-- Search Controls -->
        <div class="mb-6 space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
            <!-- Search Input -->
            <div class="relative flex-1">
                <input
                    wire:model.live.debounce.300ms="search"
                    type="text"
                    placeholder="Search posts..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                >
                @if ($search)
                    <button 
                        wire:click="$set('search', '')"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                @endif
            </div>

            <!-- Category Filter -->
            <div class="sm:w-48">
                <select
                    wire:model.live="category"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                >
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->slug }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Sort Options -->
            <div class="sm:w-48">
                <select
                    wire:model.live="sortBy"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                >
                    <option value="newest">Newest First</option>
                    <option value="oldest">Oldest First</option>
                    <option value="popular">Most Popular</option>
                </select>
            </div>

            <!-- Reset Filters -->
            @if($search || $category || $sortBy !== 'newest')
                <button
                    wire:click="resetFilters"
                    class="w-full sm:w-auto px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 dark:bg-gray-600 dark:text-gray-200 dark:hover:bg-gray-500"
                >
                    Reset Filters
                </button>
            @endif
        </div>

        <!-- Loading State -->
        <div wire:loading class="w-full">
            <div class="animate-pulse flex space-x-4 mb-4">
                <div class="flex-1 space-y-4 py-1">
                    <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                    <div class="space-y-2">
                        <div class="h-4 bg-gray-200 rounded"></div>
                        <div class="h-4 bg-gray-200 rounded w-5/6"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Results -->
        <div wire:loading.remove>
            @if($posts->isEmpty())
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No posts found</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Try adjusting your search or filter criteria</p>
                </div>
            @else
                <div class="space-y-6">
                    @foreach($posts as $post)
                        <article class="p-6 bg-white rounded-lg shadow-sm dark:bg-gray-800">
                            <div class="flex items-center gap-x-4">
                                <span class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $post->created_at->format('M d, Y') }}
                                </span>
                                @if($post->category)
                                    <span class="text-sm font-medium text-blue-600 dark:text-blue-400">
                                        {{ $post->category->name }}
                                    </span>
                                @endif
                            </div>
                            <div class="mt-2 group">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    <a href="{{ route('posts.show', $post) }}" class="hover:underline">
                                        {{ $post->title }}
                                    </a>
                                </h3>
                                <p class="mt-2 text-gray-600 dark:text-gray-300 line-clamp-2">
                                    {{ Str::limit(strip_tags($post->content), 200) }}
                                </p>
                            </div>
                            <div class="mt-4 flex items-center gap-x-4">
                                <div class="flex items-center gap-x-2 text-sm text-gray-500">
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                    </svg>
                                    {{ number_format($post->views) }} views
                                </div>
                                @if($post->tags->isNotEmpty())
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($post->tags as $tag)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100">
                                                {{ $tag->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $posts->links() }}
                </div>
            @endif
        </div>
    </div>
</div> --}}