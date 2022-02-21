<?php

namespace App\Http\Livewire\Properties;

use Livewire\Component;
use App\Models\Property;
use App\Models\Transaction;
use Livewire\WithPagination;
use DB;

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
        
        $property_number = Property::findOrFail($id)->unique_number;
        DB::transaction(function () use($id) {

            Property::findOrFail($id)->delete();

            // delete all transsactions of this property
            Transaction::where('property_id', $id)->delete();

        });

        session()->flash('message', 'Property #'.$property_number.' deleted.');
        return redirect()->route('properties.index');
        
    }

    
    public function render()
    {
        return view('livewire.properties.list-properties', [
            'properties' => Property::where('unique_number', 'LIKE', '%'.$this->search.'%')->paginate(20),
        ]);
    }
}
