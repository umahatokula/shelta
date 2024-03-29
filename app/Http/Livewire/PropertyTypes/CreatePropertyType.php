<?php

namespace App\Http\Livewire\PropertyTypes;

use Livewire\Component;
use App\Models\PropertyType;
use Livewire\WithFileUploads;

class CreatePropertyType extends Component
{
    use WithFileUploads;
 
    public $name;
    public $description;
    public $photos = [];
 
    public function save()
    {
        $this->validate([
            'name' => 'required', 
            'photos.*' => 'image|max:1024', // 1MB Max
        ]);

        $propertytype = PropertyType::create([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        foreach($this->photos as $photo) {
            $propertytype
                ->addMedia($photo->getRealPath())
                ->usingName($photo->getClientOriginalName())
                ->toMediaCollection('propertyTypephotos', 'public');

        }
        
        session()->flash('message', 'Property Type successfully added.');

        redirect()->route('property-types.index');
 
    }

    public function render()
    {
        return view('livewire.property-types.create-property-type');
    }
}
