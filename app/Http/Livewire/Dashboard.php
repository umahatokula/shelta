<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Transaction;
use App\Models\Property;
use App\Models\PropertyType;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $propertyTypes;
    public $properties = [];
    public $dueIn = 0;

    public function mount() {
        // $this->dueIn = 0;

        $user = auth()->user();
        if ($user->hasRole('client')) {
            redirect()->route('clients.show', $user->client);
        }

        $this->fetchPropertiesDueForPayment();

        $this->propertyTypes = PropertyType::with('properties.transactions')->get()->each(function($propertyType) {

            $propertyType->properties->each(function($property) use ($propertyType) {
                $propertyType->amount = ($propertyType->amount + $property->transactions()->whereMonth('created_at', Carbon::now()->format('m'))->sum('amount'));
            });

        });

    }

    public function fetchPropertiesDueForPayment() {
        $this->properties = (new Property())->getPropertiesDueForReminder($this->dueIn);
        // dd($this->properties);
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
