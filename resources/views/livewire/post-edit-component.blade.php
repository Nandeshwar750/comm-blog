<div class="p-4">
    <form wire:submit.prevent="save">
        <div class="mb-4">
            <label class="block font-bold mb-2">Title</label>
            <input type="text" wire:model="title" class="form-input w-full" />
            @error('title') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-bold mb-2">Content</label>
            <textarea wire:model="content" class="form-textarea w-full" rows="6"></textarea>
            @error('content') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-bold mb-2">Status</label>
            <select wire:model="status" class="form-select w-full">
                <option value="draft">Draft</option>
                <option value="published">Published</option>
            </select>
            @error('status') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
