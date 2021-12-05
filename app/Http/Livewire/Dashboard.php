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

        $user = auth()->user();
        if ($user->hasRole('client')) {
            redirect()->route('clients.show', $user->client);
        }

        $this->propertyTypes = PropertyType::with('properties.transactions')->get()->each(function($propertyType) {

            $propertyType->properties->each(function($property) use ($propertyType) {
                $propertyType->amount = ($propertyType->amount + $property->transactions()->whereMonth('created_at', Carbon::now()->format('m'))->sum('amount'));
            });

        });

        // $this->propertyTypes = PropertyType::withWhereHas('properties.transactions', function($query) {
        //     $query->whereMonth('created_at', Carbon::now()->format('m'))->sum('amount');
        // })->get();

        // $this->propertyTypes = DB::table('property_types')
        // ->selectRaw('property_types.*, properties.*, transactions.*, transactions.amount AS transaction_amount')
        // ->join('estate_property_type', 'property_types.id', '=', 'estate_property_type.property_type_id')
        // ->join('properties', 'estate_property_type.id', '=', 'properties.estate_property_type_id')
        // ->join('transactions', function ($join) {
        //     $join->on('properties.id', '=', 'transactions.property_id') ->whereMonth('transactions.created_at', '=', Carbon::now()->format('m'));
        // })
        // ->get();


        // dd($this->propertyTypes);
    }


    public function render()
    {
        return view('livewire.dashboard');
    }
}
