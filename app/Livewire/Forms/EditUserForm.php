<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class EditUserForm extends Component
{
    use WithFileUploads;
    public $userId, $name, $email, $ip_address, $user_agent, $last_activity, $created_at, $estado, $photo;

    #[On('userUpdated')]
    public function userUpdated($rowId)
    {
        $this->userId = $rowId;
        if ($this->userId) {
            $this->userId = $this->userId;
            $user = User::find($this->userId);
            if ($user) {
                $this->name = $user->name;
                $this->email = $user->email;
                $this->ip_address = $user->ip_address;
                $this->user_agent = $user->user_agent;
                $this->last_activity = $user->last_activity;
                $this->created_at = $user->created_at;
                $this->estado = $user->estado;
            }
            // Load user data from the database
            // $this->loadUserData($userId);
        }
        // $this->js('alert(' . $this->userId . ')');
        $this->js('$openModal(\'cardModal\')');
        // $this->dispatch('showModal');
        // Logic to handle the user updated event
        // For example, you might want to refresh the user data or show a success message
        // session()->flash('message', 'User updated successfully!');
    }

    public function saveData()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $user = User::find($this->userId);

        if ($user) {
            if ($this->photo) {
                $path = $this->photo->store('profile-photos', 'public');
                $user->profile_photo_path = $path;
            }
            $user->name = $this->name;
            $user->email = $this->email;
            $user->save();
        }

        session()->flash('message', 'User updated successfully!');
    }

    public function render()
    {
        return view('livewire.forms.edit-user-form')->layout('layouts.admin');
    }
}
