<?php

namespace App\Livewire\Modules;

use Livewire\Component;

class UserModule extends Component
{
    public function render()
    {
        return view('livewire.modules.user-module')->layout('layouts.admin');
    }
}
