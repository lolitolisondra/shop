<div class="my-4 mx-4  max-w-full">
    <h2 class="mb-4 text-xl">Users</h2>

    @if (session()->has('message'))
        <div class="mt-2 mb-2 bg-green-500 text-white p-2 rounded">
            {{ session('message') }}
        </div>
    @endif

    <button wire:click="create()" class="bg-blue-500 text-white px-4 py-2 rounded">Create User</button>

    @if($isOpen)
        @include('livewire.create-user')
    @endif

    <table class="min-w-full mt-4">
        <thead class="border-b border-neutral-200 bg-neutral-50 font-medium dark:border-white/10 dark:text-neutral-800">
            <tr>
                <th class="px-4 py-4">Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr class="border-b border-neutral-200 transition duration-300 ease-in-out hover:bg-neutral-100 dark:border-white/10 dark:hover:bg-neutral-300">
                    <td scope="col" class="px-6 py-4">{{ $user->name }}</td>
                    <td scope="col" class="px-6 py-4">{{ $user->email }}</td>
                    <td scope="col" class="px-6 py-4">
                        @foreach($user->roles as $role)
                            <span class="bg-gray-200 px-2 py-1 rounded">{{ $role->name }}</span>
                        @endforeach
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button wire:click="edit({{ $user->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                        <button wire:click="confirmDelete({{ $user->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
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
                        <h2 class="text-lg font-medium text-gray-900">Delete User</h2>
                        <p class="mt-1 text-sm text-gray-600">Are you sure you want to delete this user? This action cannot be undone.</p>
                    </div>
                    <div class="flex justify-end">
                        <button wire:click="deleteUser()" class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                        <button x-on:click="open = false" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>