<?php

namespace App\Http\Livewire\Settings;

use App\Models\Setting;
use Livewire\Component;

class Settings extends Component
{
 
    public $settings;

    public function mount() {
        $this->settings = Setting::first(); 
    }

    public function render()
    {
        return view('livewire.settings.settings');
    }
}