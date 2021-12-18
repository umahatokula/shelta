<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Modal extends Component
{
    public $comp;
    public $show = false;
    public $index;

    protected $listeners = [
        'openModal',
        'hideModal'
    ];

    public function openModal($comp, $index) {
        $this->reset('index');

        $this->comp = $comp ?? '';
        $this->show = true;
        $this->index = $index;
    }

    public function hideModal() {
        $this->show = false;
    }
}
