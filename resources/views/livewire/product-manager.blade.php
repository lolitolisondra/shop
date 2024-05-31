<div class="mx-auto my-4 mx-4 max-w-full">
    <h2 class="mb-4 text-xl">Products</h2>

    @if (session()->has('message'))
        <div class="mt-2 mb-2 bg-green-500 text-white p-2 rounded">
            {{ session('message') }}
        </div>
    @endif

    <button wire:click="create()" class="bg-blue-500 text-white px-4 py-2 rounded">Create Product</button>

    @if($isOpen)
        @include('livewire.create')
    @endif

    <table class="min-w-full mt-4">
        <thead class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
            <tr>
                <th class="px-4 py-4">Image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Categories</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr class="border-b border-neutral-200 transition duration-300 ease-in-out hover:bg-neutral-100 dark:border-white/10 dark:hover:bg-neutral-300">                                        
                    <td scope="col" class="px-6 py-4">
                        @if($product->image)
                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-16 h-16">
                        @endif
                    </td>
                    <td scope="col" class="px-6 py-4">{{ $product->name }}</td>
                    <td scope="col" class="px-6 py-4">{{ $product->description }}</td>
                    <td scope="col" class="px-6 py-4">{{ $product->price }}</td>
                    <td>
                        @foreach($product->categories as $category)
                            <span class="inline-block whitespace-nowrap rounded-[0.27rem] bg-neutral-800 px-[0.65em] pb-[0.25em] pt-[0.35em] text-center align-baseline text-[0.75em] font-bold leading-none text-zinc-100 dark:bg-neutral-800">{{ $category->name }}</span>
                        @endforeach
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button wire:click="edit({{ $product->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                        <button wire:click="confirmDelete({{ $product->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Delete Confirmation Modal -->
    <div x-data="{ open: @entangle('isDeleteModalOpen') }">
        <div x-show="open" class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen">
                <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
                    <div class="mb-4">
                        <h2 class="text-lg font-medium text-gray-900">Delete Product</h2>
                        <p class="mt-1 text-sm text-gray-600">Are you sure you want to delete this product? This action cannot be undone.</p>
                    </div>
                    <div class="flex justify-end">
                        <button wire:click="deleteProduct()" class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                        <button x-on:click="open = false" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
