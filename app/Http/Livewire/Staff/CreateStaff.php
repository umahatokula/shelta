<?php

namespace App\Http\Livewire\Staff;

use App\Models\Staff;
use App\Models\Gender;
use Livewire\Component;

class CreateStaff extends Component
{
    public $name, $phone, $email, $dob, $gender_id, $genders;

    public $rules = [
        'name' => 'required',
        'phone' => 'required',
        'email' => 'email',
        'gender_id' => 'required',
    ];

    public $messages = [
        'gender_id.required' => 'This field is required',
    ];

    public function mount() {
        $this->genders = Gender::all();
    }

    public function save() {

        $this->validate();

        $staff = Staff::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'dob' => $this->dob,
            'gender_id' => $this->gender_id,
        ]);

        redirect()->route('staff.index');
    }

    public function render()
    {
        return view('livewire.staff.create-staff');
    }
}
