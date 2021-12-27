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
        $allPlots = Property::all();
        
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
        // dd($plot_unique_number);

        $assignedProperty[] = Property::where('unique_number', $plot_unique_number)->update([
            'client_id'               => auth()->user()->client->id,
            'payment_plan_id'         => 1,
        ]);

        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Client successfully added.']);

        ClientPropertiesUpdated::dispatch(auth()->user()->client, $assignedProperty);

        redirect()->route('frontend.parcelation.select');
    }

    public function render()
    {
        return view('livewire.parcelation.select-plot');
    }
}
