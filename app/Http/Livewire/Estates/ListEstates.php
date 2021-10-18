<?php

namespace App\Http\Livewire\Estates;

use App\Models\Estate;
use Livewire\Component;
use Livewire\WithPagination;

class ListEstates extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.estates.list-estates', [
            'estates' => Estate::paginate(10)
        ]);
    }

    public function destroy($id) {
        Estate::findOrFail($id)->delete();
        session()->flash('message', 'Estate deleted.');
    }
}
