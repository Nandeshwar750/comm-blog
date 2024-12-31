<div class="relative" x-data="{ open: @entangle('showResults') }" @click.away="open = false">
    <form wire:submit.prevent="viewAllResults" class="relative">
        <input type="text" wire:model.live.debounce.300ms="query" placeholder="Search..." @focus="open = true"
            class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-full py-2 px-4 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 w-full">
        <button type="submit" class="absolute left-3 top-1/2 transform -translate-y-1/2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-400" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </button>
    </form>

    <!-- Loading indicator -->
    <div wire:loading class="absolute right-3 top-1/2 transform -translate-y-1/2">
        <svg class="animate-spin h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
            </circle>
            <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
            </path>
        </svg>
    </div>

    <!-- Results dropdown -->
    <div x-show="open" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute z-50 mt-2 w-full bg-white dark:bg-gray-800 rounded-md shadow-lg" style="display: none;">
        <div class="py-1 max-h-96 overflow-y-auto">
            @if (strlen($query) < 2)
                <div class="px-4 py-2 text-sm text-gray-500 dark:text-gray-400">
                    Please enter at least 2 characters to search
                </div>
            @elseif (count($results) === 0)
                <div class="px-4 py-2 text-sm text-gray-500 dark:text-gray-400">
                    No results found for "{{ $query }}"
                </div>
            @else
                @foreach ($results as $result)
                    <a href="{{ $result['url'] }}"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-150 ease-in-out">
                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                            {{ $result['title'] }}
                        </div>
                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            {{ $result['excerpt'] }}
                        </div>
                    </a>
                @endforeach

                <div class="border-t border-gray-100 dark:border-gray-700">
                    <button wire:click="viewAllResults"
                        class="block w-full px-4 py-2 text-sm text-blue-600 dark:text-blue-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-150 ease-in-out text-center">
                        View all results
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
