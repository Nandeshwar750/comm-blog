{{-- resources/views/livewire/post-index-component.blade.php --}}
@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;
@endphp
<div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Search and Filter --}}
        <div class="flex items-center justify-between py-6">
            <div class="flex-1 max-w-sm">
                <input 
                    wire:model.debounce.300ms="search"
                    type="search"
                    placeholder="Search posts..."
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                >
            </div>
            
            <div class="ml-4">
                <select 
                    wire:model="filter"
                    class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                >
                    <option value="published">Published</option>
                    @auth
                        <option value="draft">Drafts</option>
                    @endauth
                </select>
            </div>
        </div>

        {{-- Posts Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($posts as $post)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    @if($post->featured_image)
                        <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                    @endif
                    
                    <div class="p-6">
                        <h2 class="text-xl font-semibold mb-2">
                            <a href="{{ route('posts.show', $post) }}" class="hover:text-indigo-600">
                                {{ $post->title }}
                            </a>
                        </h2>
                        
                        <p class="text-gray-600 mb-4">
                            {{ Str::limit($post->content, 150) }}
                        </p>
                        
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <span>By {{ $post->author->name }}</span>
                            <span>{{ $post->published_at?->diffForHumans() }}</span>
                        </div>
                        
                        @can('update', $post)
                            <div class="mt-4 flex space-x-2">
                                <a href="{{ route('posts.edit', $post) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                <button 
                                    wire:click="delete({{ $post->id }})"
                                    class="text-red-600 hover:text-red-900"
                                    onclick="return confirm('Are you sure?')"
                                >
                                    Delete
                                </button>
                            </div>
                        @endcan
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    </div>
</div>