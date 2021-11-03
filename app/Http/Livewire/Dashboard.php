<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Transaction;
use App\Models\PropertyType;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $propertyTypes;

    public function mount() {
        // $this->monthsPayments = Transaction::whereMonth('created_at', Carbon::now()->format('m'))->sum('amount');

        $this->propertyTypes = PropertyType::with('properties.transactions')->get()->each(function($propertyType) {

            $propertyType->properties->each(function($property) use ($propertyType) {
                $propertyType->amount = ($propertyType->amount + $property->transactions()->whereMonth('created_at', Carbon::now()->format('m'))->sum('amount'));
            });

        });


        // dd($this->propertyTypes);
    }


    public function render()
    {
        return view('livewire.dashboard');
    }
}
