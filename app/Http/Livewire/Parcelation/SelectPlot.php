<?php

namespace App\Http\Livewire\Parcelation;

use Livewire\Component;
use App\Models\Property;
use App\Events\ClientPropertiesUpdated;

class SelectPlot extends Component
{
    public $assignedPlots, $unassignedPlots;

    public $listeners = ['plotSelected'];

    public function mount() {
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

    public function render()
    {
        return view('livewire.parcelation.select-plot');
    }
}
