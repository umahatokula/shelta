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
    public $company_website;
    public $logo_light;
    public $logo_dark;


    public function mount() {
        $settings = Setting::first(); 
        $this->company_name = $settings ? $settings->company_name : '';
        $this->company_email = $settings ? $settings->company_email : '';
        $this->company_phone = $settings ? $settings->company_phone : '';
        $this->company_address = $settings ? $settings->company_address : '';
        $this->company_website = $settings ? $settings->company_website : '';
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
                'company_website' => $this->company_website,
            ]
        );

        if ($this->logo_light) {

            // delete existing light logo
            if ($setting->getFirstMedia('logoLight')) {
                $setting->getFirstMedia('logoLight')->delete();
            }
            
            // add logo
            $setting
                ->addMedia($this->logo_light->getRealPath())
                ->usingName($this->logo_light->getClientOriginalName())
                ->toMediaCollection('logoLight', 'public');
        }
        
        if ($this->logo_dark) {

            // delete existing dark logo
            if ($setting->getFirstMedia('logoDark')) {
                $setting->getFirstMedia('logoDark')->delete();
            }

            // add logo
            $setting
            ->addMedia($this->logo_dark->getRealPath())
            ->usingName($this->logo_dark->getClientOriginalName())
            ->toMediaCollection('logoDark', 'public');
        }

        
        
        session()->flash('message', 'Company settings successfully updated.');

        redirect()->route('settings.index');
 
    }

    public function render()
    {
        return view('livewire.settings.edit-settings');
    }
}
