<?php

namespace App\Http\Livewire\Settings;

use App\Models\Setting;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditSettings extends Component
{
    use WithFileUploads;
 
    public $company_name;
    public $company_phone;
    public $company_email;
    public $company_address;
    public $logo_light;
    public $logo_dark;


    public function mount() {
        $settings = Setting::first(); 
        $this->company_name = $settings ? $settings->company_name : '';
        $this->company_email = $settings ? $settings->company_email : '';
        $this->company_phone = $settings ? $settings->company_phone : '';
        $this->company_address = $settings ? $settings->company_address : '';
    }
 
    public function save()
    {
        $this->validate([
            'company_name' => 'required', 
            // 'logo_light' => 'array|max:1024', // 1MB Max
            'logo_light.*' => 'image|max:1024', // 1MB Max
        ]);

        $setting = Setting::updateOrCreate(
            [
                'id' =>  1
            ],
            [
                'company_name' => $this->company_name,
                'company_phone' => $this->company_phone,
                'company_email' => $this->company_email,
                'company_address' => $this->company_address,
            ]
        );

        // delete existing logos
        if ($this->logo_light) {
            $setting->getFirstMedia('logoLight')->delete();
        }
        
        if ($this->logo_dark) {
            $setting->getFirstMedia('logoDark')->delete();
        }

        // add logos
        $setting
            ->addMedia($this->logo_light->getRealPath())
            ->usingName($this->logo_light->getClientOriginalName())
            ->toMediaCollection('logoLight', 'public');

        $setting
            ->addMedia($this->logo_dark->getRealPath())
            ->usingName($this->logo_dark->getClientOriginalName())
            ->toMediaCollection('logoDark', 'public');
        
        session()->flash('message', 'Company settings successfully updated.');

        redirect()->route('settings.index');
 
    }

    public function render()
    {
        return view('livewire.settings.edit-settings');
    }
}
