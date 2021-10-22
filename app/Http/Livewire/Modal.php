<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Modal extends Component
{
    public $comp;
    public $show = false;

    protected $listeners = [
        'openModal',
        'hideModal'
    ];

    public function openModal($comp) {
        $this->comp = $comp ?? '';
        $this->show = true;
    }

    public function hideModal() {
        $this->show = false;
    }
}
