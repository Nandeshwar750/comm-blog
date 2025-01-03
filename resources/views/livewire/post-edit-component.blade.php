<div class="p-4">
    <form wire:submit.prevent="save">
        <div class="mb-4">
            <label class="block font-bold mb-2">Title</label>
            <input type="text" wire:model="title" class="form-input w-full" />
            @error('title')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block font-bold mb-2 text-gray-700 dark:text-gray-200">Content</label>
            <x-quill wire:model="content" />
            @error('content')
                <p class="text-red-500 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block font-bold mb-2">Status</label>
            <select wire:model="status" class="form-select w-full">
                <option value="draft">Draft</option>
                <option value="published">Published</option>
            </select>
            @error('status')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

@push('scripts')
    <script>
        // console.log(' content ', @json($content));

        // document.addEventListener('livewire:load', function() {
        //     console.log('Livewire loaded');
        //     // Set initial content for Quill editor
        //     if (window.setupQuill) {
        //         console.log('Setting initial content');
        //         const quill = window.setupQuill();
        //         quill.content = @json($content); // Pass existing content
        //         quill.init(); // Ensure to call init if it's defined
        //     } else {
        //         console.error('setupQuill is not defined');
        //     }
        // });

        // console.log('Initial content:', this.content); // Before setting to Quill
        // if (this.content) {
        //     quill.root.innerHTML = this.content; // Set initial content
        //     console.log('Content set in Quill:', this.content); // After setting to Quill
        // }
    </script>
@endpush
