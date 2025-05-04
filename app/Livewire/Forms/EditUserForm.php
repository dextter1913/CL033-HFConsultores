<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;

class EditUserForm extends Component
{
    public $userId, $name, $email, $ip_address, $user_agent, $last_activity, $created_at, $estado;

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

    public function render()
    {
        return view('livewire.forms.edit-user-form')->layout('layouts.admin');
    }
}
