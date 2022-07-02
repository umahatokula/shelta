@extends('layouts.frontend')

@section('content')
<div class="rs-about style1 pt-100 pb-100 md-pt-70 md-pb-70">
    <div class="container">
        <div class="row y-middle">
            <div class="col-lg-12">

                <div class="row">
                    <div class="col-12">
                        <div class="sec-title mb-50">
                            <h2 class="title black-color">
                                My<span class="new-text"> payments</span>
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div>
                        @if (session()->has('message'))
                        <div class="col-lg-12">
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="col-lg-12">

                        <div class="row mb-4">
                            <div class="col-md-6">
                                &nbsp;
                            </div>
                            <div class="col-md-6 mb-4 d-flex justify-content-end">

                                <a href="{{ route('frontend.transactions.online') }}" class="readon submit">Online Payment</a>

                                &nbsp

                                <a href="{{ route('frontend.transactions.record') }}"  class="readon submit">Record Payment</a>

                            </div>

                        </div>

                        @if ($client->transactions->isNotEmpty())

                        <div class="table-responsive">
                        <table id="payments" class="table-responsive table-condensed table table-bordered table-hover display nowrap margin-top-10 w-p100">
                            <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-left">Property</th>
                                        <th class="text-center">Instalment Date</th>
                                        <th class="text-center">Type</th>
                                        <th class="text-right">Amount (&#8358;)</th>
                                        <th class="text-center">Action(s)</th>
                                    </tr>
                            </thead>
                            <tbody>
                                @foreach ($client->transactions as $transaction)
                                <tr>
                                    <td scope="row" class="text-center  style="padding: 15px; line-height: 30px">{{ $loop->iteration }}</td>

                                    <td style="padding: 15px; line-height: 30px">
                                        @if ($transaction->property)
                                            @if ($transaction->property->estatePropertyType)
                                                <span class="text-warning">{{ $transaction->property->estatePropertyType->estate ? $transaction->property->estatePropertyType->estate->name : null }}</span> - {{ $transaction->property->estatePropertyType->propertyType ? $transaction->property->estatePropertyType->propertyType->name : null }}
                                                - {{ $transaction->property->unique_number }}
                                            @endif
                                        @endif
                                    </td>

                                    <td class="text-center" style="padding: 15px; line-height: 30px">
                                        {{ $transaction->instalment_date ? $transaction->instalment_date->toFormattedDateString() : null }}
                                    </td>

                                    <td class="text-center" style="padding: 15px; line-height: 30px">

                                        @if ($transaction->type == 'recorded')
                                        <span class="badge bg-info">recorded</span>
                                        @else
                                        <span class="badge bg-primary">online</span>
                                        @endif
                                    </td>

                                    <td class="text-right" style="padding: 15px; line-height: 30px">{{ number_format($transaction->amount, 2) }}</td>

                                    <td class="text-center" style="padding: 15px; line-height: 30px">
                                        <a href="{{ route('frontend.clients.downloadReciept', [$transaction->transaction_number]) }}" class="text-primary p-0" data-original-title="" title="Download Reciept" download>
                                            <i class="fa fa-download font-medium-3 mr-2"></i>
                                        </a>

                                        @if (!$transaction->onlinePayment)
                                        <a href="{{ $transaction->getFirstMediaUrl('proofOfPayment') }}" class="text-danger p-0"
                                            data-original-title="" title="Proof of Payment" target="_blank">
                                            <i class="fa fa-file-pdf font-medium-3 mr-2"></i>
                                        </a>
                                        @endif

                                        <a  href="{{ route('frontend.clients.mailReciept', [$transaction->transaction_number]) }}" href="#" class="text-success p-0"
                                            data-original-title="" title="Email Reciept">
                                            <i class="fa fa-envelope font-medium-3 mr-2"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-left">Property</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-right">Amount (&#8358;)</th>
                                    <th class="text-center">Action(s)</th>
                                </tr>
                            </tfoot>
                        </table>
                        </div>
                        @else
                        <p>
                            No payments yet
                        </p>
                        @endif

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

@push('scripts')

<script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/data-table.js') }}"></script>
<script src="//unpkg.com/alpinejs" defer></script>

{{-- Paystack --}}
<script src="https://js.paystack.co/v1/inline.js"></script>

<script>

    const onlinePaymentBtn = document.getElementById('onlinePaymentBtn');

    onlinePaymentBtn.addEventListener("click", payWithPaystack, false);

    function payWithPaystack(e) {

        e.preventDefault();

        var clientId = @json($client->id);
        var email = document.getElementById('payingEmail').value;
        var amount = document.getElementById('payingAmount').value;
        var property_id = document.getElementById('payingPropertyId').value;

        let handler = PaystackPop.setup({
                key: 'pk_test_1868497b412662f1ab265218caffa56830eb32be', // Replace with your public key
                email: email,
                amount: amount * 100,
            onClose: function(){
                // alert('Window closed.');
            },
            callback: function(response){
                // let message = 'Payment complete! Reference: ' + response.reference;

                const data = {
                    client_id: @json($client->id),
                    property_id,
                    reference: response.reference,
                    amount,
                    message: response.message,
                    reference: response.reference,
                    status: response.status,
                }

            }
        });

        handler.openIframe();
    }

</script>
@endpush

@endsection
