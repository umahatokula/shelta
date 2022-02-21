<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Client;
use App\Models\Estate;
use Livewire\Component;
use App\Models\Property;
use App\Models\Transaction;
use App\Models\PropertyType;
use App\Models\PaymentDefault;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $propertyTypes;
    public $properties = [];
    public $dueIn = 0;
    public $estates, $clients;

    // Payment defaults
    public $defaulters, $defaulters_start_date, $defaulters_end_date, $defaulters_estate = 1;

    public function mount() {

        $user = auth()->user();
        if ($user->hasRole('client')) {
            redirect()->route('clients.show', $user->client);
        }

        $this->estates = Estate::all();
        $this->clients = Client::all();

        // get due payments
        $this->fetchPropertiesDueForPayment();

        // get defaulters
        $this->defaulters_start_date = Carbon::today()->startOfMonth();
        $this->defaulters_end_date = Carbon::today()->endOfMonth();
        $this->getPaymentDefaultersList();

        $this->propertyTypes = PropertyType::with('properties.transactions')->get()->each(function($propertyType) {

            $propertyType->properties->each(function($property) use ($propertyType) {
                $propertyType->amount = ($propertyType->amount + $property->transactions()->whereMonth('created_at', Carbon::now()->format('m'))->sum('amount'));
            });

        });

    }
    
    /**
     * fetchPropertiesDueForPayment
     *
     * @return void
     */
    public function fetchPropertiesDueForPayment() {
        $this->properties = (new Property())->getPropertiesDueForReminder($this->dueIn);
    }
    
    /**
     * get list of payment defaulters
     *
     * @return void
     */
    public function getPaymentDefaultersList() {
        $defaultersQuery = PaymentDefault::query();
        $defaultersQuery = $defaultersQuery->with('client');

        if ($this->defaulters_start_date || $this->defaulters_end_date) {
            $defaultersQuery = $defaultersQuery->whereBetween('created_at', [$this->defaulters_start_date, $this->defaulters_end_date]);
        }

        if ($this->defaulters_estate) {

            $this->defaults = $defaultersQuery->get()->filter(function($query) {
                return $query->property->estatePropertyType->estate->id == $this->defaulters_estate;
            });

            $defaults = $this->defaults->groupBy('client_id');
            
        } else {
            $defaults = $defaultersQuery->groupBy('client_id')->get();
        }

        $this->defaulters = [];
        foreach ($defaults as $clientId => $default) {

            $client = $this->clients->where('id', $clientId)->first()->toArray();
            $client['missed_date'] = $default->last() ? $default->last()['missed_date'] : null;

            $this->defaulters[] = $client;
            // dd($this->defaulters->total_payment_default_owed);
        }
        // dd($this->defaulters);
        
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
