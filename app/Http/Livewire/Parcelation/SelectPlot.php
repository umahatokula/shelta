<?php

namespace App\Http\Livewire\Parcelation;

use App\Models\Estate;
use Livewire\Component;
use App\Models\Property;
use App\Events\ClientPropertiesUpdated;

class SelectPlot extends Component
{
    public $estate, $assignedPlots, $unassignedPlots, $selectedEstateSlug = 'livewire.parcelation.';
    public  $client, $estates, $propertybalance, $estate_id, $selectedEstate = '';

    public $listeners = ['plotSelected'];

    public function mount($estate_slug) {

        $this->selectedEstateSlug .= $estate_slug;
        
        
        $client = auth()->user()->client;
        
        $this->client = $client->load([
            'transactions.property.estatePropertyType.propertyType', 
            'transactions.property.estatePropertyType.estate', 
            'properties.estatePropertyType.propertyType', 
            'properties.estatePropertyType.estate'
        ]);
        
        $this->estates = Estate::all();
        
        $this->propertybalance = 0;

        // ==============================================================

        $this->estate = Estate::where('slug', $estate_slug)->first();
        $allPlots = Property::with('client')->get();
        
        $this->unassignedPlots = $allPlots->filter(function($plot) {
            return $plot->client_id == null;
        });

        $this->assignedPlots = $allPlots->filter(function($plot) {
            return $plot->client_id != null;
        });

    }
    
    /**
     * plotSelected
     *
     * @return void
     */
    public function plotSelected($plot_unique_number) {

        return redirect()->route('frontend.parcelation.pay', $plot_unique_number);
        
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
        return view('livewire.parcelation.select-plot');
    }
}
