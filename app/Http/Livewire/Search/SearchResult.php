<?php

namespace App\Http\Livewire\Search;

use App\Models\Client;
use App\Models\Estate;
use Livewire\Component;
use App\Models\PropertyType;
use ProtoneMedia\LaravelCrossEloquentSearch\Search;

class SearchResult extends Component
{    
    public $results;

    protected $listeners = [
        'searchResult'
    ];

    public function mount($query) {
        
        $this->results = Search::addMany([
            [Client::class, ['sname', 'onames']],
            // [Estate::class, 'name'],
        ])
        ->get($query);
            
        
        // dd($this->results);
    }
    
    public function render()
    {
        return view('livewire.search.search-result');
    }
}
