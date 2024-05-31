<div class="fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
            <form autocomplete="off">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" wire:model="name" class="mt-1 p-2 block w-full rounded border-gray-300 shadow-sm">
                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" wire:model="email" class="mt-1 p-2 block w-full rounded border-gray-300 shadow-sm">
                    @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" wire:model="password" class="mt-1 p-2 block w-full rounded border-gray-300 shadow-sm">
                    @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="roles" class="block text-sm font-medium text-gray-700">Roles</label>
                    <select multiple wire:model="selectedRoles" id="roles" class="form-multiselect mt-1 block w-full rounded-md shadow-sm">
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('selectedRoles') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="flex justify-end">
                    <button wire:click.prevent="store()" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                    <button wire:click.prevent="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
