<?php

namespace App\Livewire\Alerts;

use Livewire\Attributes\On;
use Livewire\Component;

class SuccessAlert extends Component
{
    public $message;

    #[On('alertSuccess')]
    public function alertSuccess($message)
    {
        $this->message = $message;
    }
    public function render()
    {
        return view('livewire.alerts.success-alert');
    }
}
