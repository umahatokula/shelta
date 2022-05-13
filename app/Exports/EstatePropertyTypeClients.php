<?php

namespace App\Exports;

use App\Models\PaymentDefault;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EstatePropertyTypeClients implements FromView
{

    public $clients;

    public function __construct(Array $clients) {

        $this->clients = $clients;

    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View {

        return view('exports.estatePropertyTypeClients', [
            'data' => $this->clients,
        ]);

    }
}
