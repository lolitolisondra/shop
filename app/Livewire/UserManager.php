<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserManager extends Component
{
    public $users, $roles, $name, $email, $password, $user_id, $selectedRoles = [];
    public $isOpen = false;
    public $isDeleteModalOpen = false;
    public $deleteUserId;

    public function render()
    {
        $this->users = User::with('roles')->get();
        $this->roles = Role::all();

        return view('livewire.user-manager');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function confirmDelete($id)
    {
        $this->deleteUserId = $id;
        $this->isDeleteModalOpen = true;
    }

    public function deleteUser()
    {
        User::findOrFail($this->deleteUserId)->delete();
        $this->isDeleteModalOpen = false;
        session()->flash('message', 'User Deleted Successfully.');
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->user_id = '';
        $this->selectedRoles = [];
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->user_id,
            'password' => 'required|min:6',
            'selectedRoles' => 'required|array|min:1',
        ]);

        $user = User::find($this->user_id);

        if (!$user) {
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);
        } else {
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);
        }

        $user->syncRoles($this->selectedRoles);

        session()->flash('message', 
            $this->user_id ? 'User Updated Successfully.' : 'User Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->user_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = ''; // Not updating password here
        $this->selectedRoles = $user->roles->pluck('name')->toArray();

        $this->openModal();
    }

    public function delete($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'User Deleted Successfully.');
    }
}
