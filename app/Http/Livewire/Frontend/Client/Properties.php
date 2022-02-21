<?php

namespace App\Http\Livewire\Frontend\Client;

use App\Models\Estate;
use Livewire\Component;

class Properties extends Component
{
    public $client, $estates, $propertybalance, $estate_id, $selectedEstate = '';
        
    /**
     * mount
     *
     * @return void
     */
    public function mount() {
        
        
        $client = auth()->user()->client;
        
        $this->client = $client->load([
            'transactions.property.estatePropertyType.propertyType', 
            'transactions.property.estatePropertyType.estate', 
            'properties.estatePropertyType.propertyType', 
            'properties.estatePropertyType.estate'
        ]);
        
        $this->estates = Estate::all();
        
        $this->propertybalance = 0;
    }
    
    /**
     * onSelectEstate
     *
     * @param  mixed $estateSlug
     * @return void
     */
    public function onSelectEstate($estateSlug) {
        $this->selectedEstate = $estateSlug;
    }

    
    public function render()
    {
        return view('livewire.frontend.client.properties');
    }
}
