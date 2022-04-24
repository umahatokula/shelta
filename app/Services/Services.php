<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Property;


class Services {

    public static function getPaymentDefaulters() {

        return Property::where(function($query) {
            return $query->whereDay('next_due_date', '=', Carbon::yesterday());
        })
        ->whereNotIn('properties.id', function ($query) {
            $query
                ->select('transactions.property_id') // get all previous day's transactions
                ->from('transactions')
                ->whereMonth('transactions.instalment_date', '=', Carbon::yesterday()->format('m'));
        })
        ->get()
        ->filter(function($property) {
            return $property->getPropertyPrice() > $property->totalPaid();
        });

    }


}

