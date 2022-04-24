<?php

namespace App\Exports;

use App\Models\PaymentDefault;
use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PaymentDefafultExport implements FromView
{

    public $date_from, $date_to;

    public function __construct($date_from, $date_to) {

        $this->date_from = $date_from;
        $this->date_to = $date_to;

    }


    public function view(): View {

        $defaults = PaymentDefault::with([
            'client',
            'property',
        ])
        ->orderBy('missed_date', 'desc')
        ->whereBetween('missed_date', [$this->date_from, $this->date_to])
        ->get();

        return view('exports.paymentDefaults', [
            'defaults' => $defaults,
            'date_from' => $this->date_from,
            'date_to' => $this->date_to,
        ]);
    }
}

