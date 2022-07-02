<?php

namespace App\Http\Livewire\PropertyPrices;

use App\Models\EstatePropertyTypePrice;
use App\Models\Property;
use Livewire\Component;
use App\Models\PropertyPrice;
use Livewire\WithPagination;

class Prices extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id) {

        $estatePropertyTypePrice = EstatePropertyTypePrice::where('property_price_id', $id)->first();

        if ($estatePropertyTypePrice) {
            $this->dispatchBrowserEvent('showToastr', ['type' => 'warning', 'message' => 'Cannot delete price already in use.']);
            return ;
        }

        PropertyPrice::findOrFail($id)->delete();

        // delete corresponding entry in EstatePropertyTypePrice
        EstatePropertyTypePrice::where('property_price_id', $id)->delete();

        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Property Price successfully deleted.']);

        redirect()->route('property-prices.index');

    }

    public function render()
    {
        return view('livewire.property-prices.prices', [
          'prices' => PropertyPrice::paginate(20),
        ]);
    }
}
