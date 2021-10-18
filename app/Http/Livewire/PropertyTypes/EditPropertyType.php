<?php

namespace App\Http\Livewire\PropertyTypes;

use Livewire\Component;
use App\Models\PropertyType;
use Livewire\WithFileUploads;
use App\Models\PropertyTypePhoto;

class EditPropertyType extends Component
{
    use WithFileUploads;
 
    public PropertyType $propertytype;
    public $name;
    public $description;
    public $photos, $currentPhotos, $photosToBeDeleted = [];
    
    /**
     * mount
     *
     * @param  mixed $propertytype
     * @return void
     */
    public function mount(PropertyType $propertytype) {

        $this->propertytype  = $propertytype;
        $this->name          = $propertytype->name;
        $this->description   = $propertytype->description;
        $this->currentPhotos = $propertytype->getMedia('propertyTypephotos')->map(function($photos) {
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

        $propertytype = PropertyType::where('id', $this->propertytype->id)->first();
        $propertytype->name = $this->name;
        $propertytype->description = $this->description;
        $propertytype->save();


        $this->propertytype->getMedia('propertyTypephotos')->each(function($mediaPhoto) {
            if (in_array($mediaPhoto->id, $this->photosToBeDeleted)) {
                $mediaPhoto->delete();
            }
        });


        if($this->photos) {
            foreach($this->photos as $photo) {
                $propertytype
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
