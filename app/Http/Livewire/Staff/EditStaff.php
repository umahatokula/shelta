<?php

namespace App\Http\Livewire\Staff;

use App\Models\Staff;
use App\Models\Gender;
use Livewire\Component;

class EditStaff extends Component
{
    public $name, $phone, $email, $dob, $gender_id, $genders, $staff;

    public $rules = [
        'name' => 'required',
        'phone' => 'required',
        'email' => 'email',
        'gender_id' => 'required',
    ];

    public $messages = [
        'gender_id.required' => 'This field is required',
    ];

    public function mount(Staff $staff) {
        $this->name      = $staff->name;
        $this->phone     = $staff->phone;
        $this->email     = $staff->email;
        $this->dob       = $staff->dob;
        $this->gender_id = $staff->gender_id;

        $this->genders = Gender::all();
    }

    public function save() {
        
        $this->validate();

        $staff = Staff::findOrFail($this->staff->id);
        $staff->name      = $this->name;
        $staff->phone     = $this->phone;
        $staff->email     = $this->email;
        $staff->dob       = $this->dob;
        $staff->gender_id = $this->gender_id;
        $staff->save();

        redirect()->route('staff.index');
    }
    
    public function render()
    {
        return view('livewire.staff.edit-staff');
    }
}
