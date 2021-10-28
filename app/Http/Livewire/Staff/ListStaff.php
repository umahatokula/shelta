<?php

namespace App\Http\Livewire\Staff;

use App\Models\Staff;
use Livewire\Component;

class ListStaff extends Component
{
    
    public function destroy($id) {
        Staff::findOrFail($id)->delete();
        session()->flash('message', 'Staff deleted.');
    }

    public function render()
    {
        return view('livewire.staff.list-staff', [
            'staffs' => Staff::paginate(10),
        ]);
    }
}
