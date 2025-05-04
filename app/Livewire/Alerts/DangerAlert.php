<?php

namespace App\Livewire\Alerts;

use Livewire\Attributes\On;
use Livewire\Component;

class DangerAlert extends Component
{
    public $message;

    #[On('alertDanger')]
    public function alertSuccess($message)
    {
        $this->message = $message;
    }
    public function render()
    {
        return view('livewire.alerts.danger-alert');
    }
}
