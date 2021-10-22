<?php

namespace App\Http\Livewire\Estates;

use App\Models\Estate;
use Livewire\Component;
use Livewire\WithPagination;

class ListEstates extends Component
{
    use WithPagination;

    protected $listeners = ['affirmationAction' => 'destroy'];

    public function render()
    {
        return view('livewire.estates.list-estates', [
            'estates' => Estate::paginate(10)
        ]);
    }

    public function confirm($id) {

        $this->dispatchBrowserEvent('modal:confirmation', [
            'title'   => 'Confirm this action',
            'content' => 'Delete this Estate?',
            'id'      => $id,
        ]);
    }

    public function destroy($id) {
        Estate::findOrFail($id)->delete();
        session()->flash('message', 'Estate deleted.');
    }
}
