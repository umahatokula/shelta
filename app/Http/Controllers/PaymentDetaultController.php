<?php

namespace App\Http\Controllers;

use App\Models\PaymentDefaulterGroupSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PaymentDefault;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PaymentDefafultExport;

class PaymentDetaultController extends Controller
{

    /**
     * index
     *
     * @return void
     */
    public function index() {
        // dd(request()->all());
        $data['defaultersGroups'] = PaymentDefaulterGroupSetting::all();

        $date_from = Carbon::today()->startOfMonth();
        $date_to = Carbon::today()->endOfMonth();

        $defaultPaymentQuery = PaymentDefault::query();
        $defaultPaymentQuery = $defaultPaymentQuery
        ->with([
            'client',
            'property',
        ])
        ->orderBy('missed_date', 'desc');

        if (request('date_from')) {
            $date_from = request('date_from');
            $date_to = request('date_to');
        }
        $defaultPaymentQuery = $defaultPaymentQuery->whereBetween('missed_date', [$date_from, $date_to]);


        if (request('client_name')) {
            $client_name  = request('client_name');
            $defaultPaymentQuery = $defaultPaymentQuery->where('client_name', 'LIKE', "%{$client_name}%");
        }


        if (request('defaultersGroup')) {
            $defaulters_group_id  = request('defaultersGroup');
            $defaultPaymentQuery = $defaultPaymentQuery->where('defaulters_group_id', $defaulters_group_id);
        }


        $data['defaults'] = $defaultPaymentQuery->paginate(100);

        $data['date_from'] = $date_from;
        $data['date_to'] = $date_to;

        return view('admin.payment-defaults.index', $data);

    }


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

    /**
     * export
     *
     * @return void
     */
    public function csv() {
        return Excel::download(new PaymentDefafultExport(request('date_from'), request('date_to')), 'payment_defafults.xlsx');
    }
}
