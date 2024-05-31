<div class="fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
            <form>
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" wire:model="name" class="mt-1 p-2 block w-full rounded border-gray-300 shadow-sm">
                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea wire:model="description" class="mt-1 p-2 block w-full rounded border-gray-300 shadow-sm"></textarea>
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="number" wire:model="price" class="mt-1 p-2 block w-full rounded border-gray-300 shadow-sm">
                    @error('price') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="categories" class="block text-sm font-medium text-gray-700">Categories</label>
                    <select multiple wire:model="selectedCategories" class="form-multiselect mt-1 block w-full rounded-md shadow-sm">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('selectedCategories') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                    <input type="file" wire:model="image" class="mt-1 p-2 block w-full rounded border-gray-300 shadow-sm">
                    @if ($image)
                        <img src="{{ $image->temporaryUrl() }}" class="mt-2 w-16 h-16">
                    @endif
                    @error('image') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="flex justify-end">
                    <button wire:click.prevent="store()" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                    <button wire:click.prevent="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
