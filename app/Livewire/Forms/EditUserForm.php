<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class EditUserForm extends Component
{
    use AuthorizesRequests;
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
            }
        }
        $this->js('$openModal(\'cardModal\')');
    }

    public function saveData()
    {
        try {
            $this->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatch('alertDanger', message: '¡Error de validación! ' . $e->getMessage());
            return;
        }

        $user = User::find($this->userId);
        try {
            $this->authorize('update', $user);
        } catch (AuthorizationException $e) {
            $this->dispatchBrowserEvent('alertDanger', [
                'message' => '¡No tienes permiso para cambiar la foto de perfil!'
            ]);
            return;
        }

        if ($user) {
            if ($this->photo) {
                $path = $this->photo->store('profile-photos', 'public');
                $user->profile_photo_path = $path;
            }
            $user->name = $this->name;
            $user->email = $this->email;
            $user->save();

            $this->dispatch('alertSuccess', message: 'User updated successfully!');
            $this->js('$closeModal("cardModal")');
            $this->reset(['name', 'email']);
            $this->dispatch('refreshUserTable');
            $this->dispatch('updatedNav', userId: $user->id);
        }
    }

    public function disconnectedSession()
    {
        $user = User::find($this->userId);
        if ($user) {
            DB::table('sessions')->where('user_id', $user->id)->delete();
            $this->dispatch('alertSuccess', message: __('¡Usuario desconectado exitosamente!'));
            $this->dispatch('refreshUserTable');
            $this->js('$closeModal("cardModal")');
        }
    }

    public function render()
    {
        return view('livewire.forms.edit-user-form')->layout('layouts.admin');
    }
}
