<?php

namespace App\Cron;

use App\Models\PaymentDefault;
use App\Models\PaymentDefaultSetting;
use App\Models\Property;
use App\Models\Transaction;
use Carbon\Carbon;

class PaymentDefaulters
{
    public static function recordDefaulters() {
        $dueProperties = (new Property())->getPropertiesDueForReminder(-1);

        $yestedaysTransactions = Transaction::whereDate('instalment_date', Carbon::yesterday())->isApproved()->pluck('property_id')->toArray();

        $pastDueProperties = $dueProperties->filter(function ($property) use($yestedaysTransactions) {
            return !in_array($property->id, $yestedaysTransactions);
        });

        // get default %
        $default_percentage = !PaymentDefaultSetting::first() ? 0 : PaymentDefaultSetting::first()->default_percentage;

        $inserts = [];
        foreach ($pastDueProperties as $property) {

            $defaultAmount = $property->getMonthlyPaymentAmount() * ($default_percentage / 100);

            // if ($defaultAmount > 0) {
            $inserts[] = [
                'client_id'             => $property->client_id,
                'property_id'           => $property->id,
                'default_amount'        => $defaultAmount,
                'missed_date'           => Carbon::yesterday(),
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
                'defaulters_group_id'   => PaymentDefault::getDefaultersGroup($property),
            ];
            // }

        }

        PaymentDefault::insert($inserts);
    }
}
