<?php

namespace App\Http\Livewire\Search;

use App\Models\Client;
use App\Models\Estate;
use Livewire\Component;
use App\Models\PropertyType;
use Livewire\WithPagination;
use ProtoneMedia\LaravelCrossEloquentSearch\Search;

class SearchResult extends Component
{    
    use WithPagination;
    
    public $query, $results;

    protected $listeners = [
        'searchResult'
    ];

    public function mount($query) {

        $this->query = $query;
        $this->results = Search::add(Client::class, ['sname', 'onames'])->get($this->query);

    }
    
    public function render()
    {
        return view('livewire.search.search-result', [
            'results' => $this->results->toArray()
        ]);
    }
}
