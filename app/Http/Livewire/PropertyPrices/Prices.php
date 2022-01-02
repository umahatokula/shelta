<?php

namespace App\Http\Livewire\PropertyPrices;

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

        PropertyPrice::findOrFail($id)->delete();

        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Property Price successfully deleted.']);

    }

    public function render()
    {
        return view('livewire.property-prices.prices', [
          'prices' => PropertyPrice::paginate(20),
        ]);
    }
}
