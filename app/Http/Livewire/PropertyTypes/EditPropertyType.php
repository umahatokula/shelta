<?php

namespace App\Http\Livewire\PropertyTypes;

use Livewire\Component;
use App\Models\PropertyType;
use Livewire\WithFileUploads;
use App\Models\PropertyTypePhoto;

class EditPropertyType extends Component
{
    use WithFileUploads;
 
    public PropertyType $propertyType;
    public $name;
    public $description;
    public $photos, $currentPhotos, $photosToBeDeleted = [];
    
    /**
     * mount
     *
     * @param  mixed $propertyType
     * @return void
     */
    public function mount(PropertyType $propertyType) {

        $this->propertyType  = $propertyType;
        $this->name          = $propertyType->name;
        $this->description   = $propertyType->description;
        $this->currentPhotos = $propertyType->getMedia('propertyTypephotos')->map(function($photos) {
            return $photos;
        });

    }
    
    /**
     * deletePhoto
     *
     * @param  mixed $key
     * @return void
     */
    public function deletePhoto($id) {

        $this->photosToBeDeleted[] = $id; // these photos will be deleted

        $this->currentPhotos = $this->currentPhotos->filter(function($photo) use($id) {
            return $photo->id != $id;
        });
    }
     
    /**
     * save
     *
     * @return void
     */
    public function save()
    {
        $this->validate([
            'name' => 'required', 
            'photos.*' => 'image|max:1024', // 1MB Max
        ]);

        $propertyType = PropertyType::where('id', $this->propertyType->id)->first();
        $propertyType->name = $this->name;
        $propertyType->description = $this->description;
        $propertyType->save();


        $this->propertyType->getMedia('propertyTypephotos')->each(function($mediaPhoto) {
            if (in_array($mediaPhoto->id, $this->photosToBeDeleted)) {
                $mediaPhoto->delete();
            }
        });


        if($this->photos) {
            foreach($this->photos as $photo) {
                $propertyType
                    ->addMedia($photo->getRealPath())
                    ->usingName($photo->getClientOriginalName())
                    ->toMediaCollection('propertyTypephotos', 'public');

            }
        }
        
        
        session()->flash('message', 'Property Type successfully added.');

        redirect()->route('property-types.index');
 
    }
    
    public function render()
    {
        return view('livewire.property-types.edit-property-type');
    }
}
