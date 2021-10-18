<?php

namespace App\Http\Livewire\PropertyTypes;

use Livewire\Component;
use App\Models\PropertyType;
use Livewire\WithPagination;

class ListPropertyTypes extends Component
{
    use WithPagination;

    public $confirmationModal = false;

    public function render()
    {
        return view('livewire.property-types.list-property-types', [
            'propertyTypes' => PropertyType::paginate(10),
        ]);
    }

    public function destroy() {

        $this->dispatchBrowserEvent('show-confirmation-modal');
    }

    public function affirmAction() {
        dd('sdsdsd');

        // PropertyType::findOrFail($id)->delete();
        // session()->flash('message', 'Property Type deleted.');
    }
}
