<?php

namespace App\Http\Livewire\Staff;

use App\Models\User;
use App\Models\Staff;
use Livewire\Component;

class Profile extends Component
{    
    
    public Staff $staff;

    public $user_2fa;

    /**
     * mount
     *
     * @param  mixed $staff
     * @return void
     */
    public function mount(Staff $staff) {
        $this->staff = $staff;

        $this->user_2fa = auth()->user()->use_2fa;
    }

    public function save() {
        
        $user = User::findOrFail(auth()->id());

        if ($user) {
            $user->use_2fa = !$this->user_2fa;
            $user->save();
        }
        
        $this->user_2fa = $user->use_2fa;

        $status = $user->use_2fa ? 'enabled' : 'disabled';

        session()->flash('message', 'Two factor authentication '. $status);
        
    }
    
    public function render()
    {
        return view('livewire.staff.profile');
    }
}
