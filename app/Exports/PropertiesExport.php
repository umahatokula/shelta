<?php

namespace App\Exports;

use App\Models\Property;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class PropertiesExport implements FromView
{
    public function view(): View
    {
        return view('exports.properties', [
            'properties' => Property::all()
        ]);
    }
}
