<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentDetaultController extends Controller
{
    /**
     * showPaymentForm
     *
     * @return void
     */
    public function showPaymentForm($unique_number, $client_id) {

        return view('admin/payment-defaults/pay', [
            'unique_number' => $unique_number,
            'client_id' => $client_id,
        ]);

    }
}
