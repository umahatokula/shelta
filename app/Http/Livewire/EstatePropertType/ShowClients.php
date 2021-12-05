<?php

namespace App\Http\Livewire\EstatePropertType;

use App\Models\Client;
use App\Models\Estate;
use App\Models\Setting;
use Livewire\Component;
use App\Models\Property;
use App\Mail\CustomMailable;
use App\Models\PropertyType;
use App\Models\EstatePropertyType;
use Illuminate\Support\Facades\Mail;

class ShowClients extends Component
{
    public Estate $estate;
    public PropertyType $propertyType;
    public $estatePropertyType;
    public $clients;
    public $subject;
    public $content;
    public $message;
    public $company_email;


    /**
     * mount
     *
     * @return void
     */
    public function mount(Estate $estate, PropertyType $propertyType) {

        $this->company_email = Setting::first() ? Setting::first()->company_email : env('MAIL_FROM_ADDRESS', 'hello@example.com');
        $this->estate = $estate;
        $this->propertyType = $propertyType;
        $this->estatePropertyType = EstatePropertyType::where([
            'estate_id' => $estate->id,
            'property_type_id' => $propertyType->id,
        ])->first();


        // get all properties of this property type in this estate
        $properties = Property::whereIn('estate_property_type_id', function ($query) use($estate, $propertyType) {
            $query->select('id')
                ->from('estate_property_type')
                ->where('estate_property_type.estate_id', '=', $estate->id)
                ->where('estate_property_type.property_type_id', '=', $propertyType->id)
                ->get()
                ->toArray();
        })->get();


        // get the amuont paid and unpaid for this property type in this estate for evrey client that owns this proprety type in the estate
        $this->clients = $properties->map(function($property) {
            return $property->client->load('transactions');
        })->each(function($client) {

            $client->unpaid = $this->estatePropertyType->price;

            $client->transactions->each(function($transaction) use($client) {
                if ($transaction->property->estatePropertyType->propertyType->id == $this->propertyType->id) {

                    $client->paid = $client->paid + $transaction->amount;
                    $client->unpaid = $client->unpaid - $transaction->amount;

                }
            });

        });

        // dd($this->propertyType->id, $this->clients);

    }
    
    /**
     * sendMail
     *
     * @return void
     */
    public function sendMail() {
    
        // $this->validate();

        Mail::to($this->clients->pluck('email'))
            ->bcc($this->company_email)
            ->send(new CustomMailable($this->subject, $this->message));

        $this->reset(['subject', 'message']);

        $this->dispatchBrowserEvent('emailSent');

        session()->flash('message', 'Email sent successfully.');
        redirect()->back();
    }
    
    public function render()
    {
        return view('livewire.estate-propert-type.show-clients');
    }
}
