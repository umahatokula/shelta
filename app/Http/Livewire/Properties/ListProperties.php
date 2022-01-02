<?php

namespace App\Http\Livewire\Properties;

use Livewire\Component;
use App\Models\Property;
use Livewire\WithPagination;

class ListProperties extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    
    public $search;
    
    /**
     * destroy
     *
     * @return void
     */
    public function destroy($id) {
        Property::findOrFail($id)->delete();
        session()->flash('message', 'Property deleted.');
    }

    
    public function render()
    {
        return view('livewire.properties.list-properties', [
            'properties' => Property::where('unique_number', 'LIKE', '%'.$this->search.'%')->paginate(20),
        ]);
    }
}
