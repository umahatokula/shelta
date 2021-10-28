<?php

namespace App\Http\Livewire\Search;

use App\Models\Client;
use App\Models\Estate;
use Livewire\Component;
use App\Models\PropertyType;
use ProtoneMedia\LaravelCrossEloquentSearch\Search;

class SearchForm extends Component
{
    public $query;
    public $results;

    /**
     * search
     *
     * @return void
     */
    public function search() {

        redirect()->route('search.result', $this->query);

    }

    public function render()
    {
        return view('livewire.search.search-form');
    }
}
