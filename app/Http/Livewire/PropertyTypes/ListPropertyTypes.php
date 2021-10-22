<?php

namespace App\Http\Livewire\PropertyTypes;

use Livewire\Component;
use App\Models\PropertyType;
use Livewire\WithPagination;

class ListPropertyTypes extends Component
{
    use WithPagination;

    protected $listeners = ['affirmationAction' => 'destroy'];

    public function render()
    {
        return view('livewire.property-types.list-property-types', [
            'propertyTypes' => PropertyType::paginate(10),
        ]);
    }

    public function confirm($id) {

        $this->dispatchBrowserEvent('modal:confirmation', [
            'title'   => 'Confirm this action',
            'content' => 'Delete this Property Type?',
            'id'      => $id,
        ]);
    }

    public function destroy($id) {

        PropertyType::findOrFail($id)->delete();
        session()->flash('message', 'Property Type deleted.');
    }
}
