<div class="p-4 bg-white dark:bg-gray-800">
    <form wire:submit.prevent="save">
        <div class="mb-4">
            <label class="block font-bold mb-2 text-gray-700 dark:text-gray-200">Title</label>
            <input type="text" wire:model="title"
                class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-transparent" />
            @error('title')
                <p class="text-red-500 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block font-bold mb-2 text-gray-700 dark:text-gray-200">Content</label>
            {{-- <div wire:ignore x-data="setupQuill()" x-init="init()" class="bg-white dark:bg-gray-700 rounded-lg quill-editor"> --}}
                <div wire:ignore x-data="setupQuill()" class="bg-white dark:bg-gray-700 rounded-lg">
                <div x-ref="quillEditor" class="min-h-[200px]"></div>
            </div>
            @error('content')
                <p class="text-red-500 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block font-bold mb-2 text-gray-700 dark:text-gray-200">Status</label>
            <select wire:model="status"
                class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-transparent">
                <option value="draft">Draft</option>
                <option value="published">Published</option>
            </select>
            @error('status')
                <p class="text-red-500 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white font-semibold rounded-lg transition-colors duration-200 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800">
            Save
        </button>
    </form>
</div>
