@extends('layouts.frontend')

@section('content')
<div>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">Payments</h4>
    
    
            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- Main content -->

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
            <div class="card p-15">
                <div class="card-body">
                    <div class="row">

                        @can('manage clients')
                            <div class="col-12 float-right">
                                <a href="{{ route('clients.edit', $client) }}" class="waves-effect waves-light btn btn-primary btn-sm float-right" >Edit Profile</a>
                            </div>  
                        @endcan
                        
                        <div class="col-12">
                            <div>
                                <p>
                                    <h5>{{ $client->sname }}, {{ $client->onames }}</h5>
                                </p>
                                <p>Email :<span class="text-gray ps-10"> <a href="mailto:{{ $client->email }}">{{ $client->email }}</a></span>
                                </p>
                                <p>Phone :<span class="text-gray ps-10"> <a href="tel:{{ $client->phone }}">{{ $client->phone }}</a></span></p>
                                <p>Address :<span class="text-gray ps-10"> {{ $client->address }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card p-15">
                <div class="card-body">

                    <div x-data="{show: false}" class="row mb-4">
                        <div class="col-md-6">
                            <h3 class="box-title">Payments</h3>
                        </div>
                        <div class="col-md-6 mb-4 d-flex justify-content-end">

                            @can('record payment')
                            <a @click="show = true" x-show="!show" href="#" class="waves-effect waves-light btn btn-success btn-sm float-right ml-3">Online
                                Payment</a>
                            
                            <a @click="show = false" x-show="show" href="#" class="waves-effect waves-light btn btn-danger btn-sm float-right ml-3">Cancel Online
                                Payment</a>
                            @endcan

                            &nbsp

                            @can('record payment')
                            <a href="{{ route('transactions.create', $client) }}" class="waves-effect waves-light btn btn-primary btn-sm float-right">Record
                                Payment</a>    
                            @endcan
                            

                            <!-- Taking namespace into account for component Admin/Actions/EditUser -->
                            {{-- <button x-data="{}" x-on:click="$wire.emitTo('transactions.transactions-create', 'openModal')">Make Payment</button> --}}
                            {{-- <button wire:click="$emit('openModal', 'transactions.transactions-create')" class="waves-effect waves-light btn btn-primary btn-sm float-right">Open Modal</button> --}}

                        </div>
                        
                        <div x-show="show" x-transition.duration.500ms class="col-md-12 ma-5">
                            <div class="box box-outline-primary">
                                <div class="box-header with-border">
                                <h4 class="box-title"><strong>Online Payment Details</strong></h4>
                                <div class="box-tools pull-right">					
                                    &nbsp
                                </div>
                                </div>
            
                                <div class="box-body">
                                        
                                    <form id="onlinePaymentForm">

                                        <div class="box-body">

                                            <div class="mb-3 row">
                                                <label class="col-form-label col-md-2">Name</label>
                                                <div class="col-md-10">
                                                    <input value="{{ $client->sname.' '.$client->onames }}" class="form-control" type="text" id="payingName" readonly>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3 row">
                                                <label class="col-form-label col-md-2">Email</label>
                                                <div class="col-md-10">
                                                    <input value="{{ $client->email }}" class="form-control" type="text" id="payingEmail" readonly>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3 row">
                                                <label class="col-form-label col-md-2">Property</label>
                                                <div class="col-md-10">
                                                    
                                                    <select class="form-control" wire:change="onSelectProperty($event.target.value)" id="payingPropertyId">
                                                        <option value="">Please select one</option>
                                                        @foreach ($client->properties as $property)
                                                            <option value="{{ $property->id }}">
                                                                
                                                                {{ $property->estatePropertyType ? $property->estatePropertyType->propertyType ? $property->estatePropertyType->propertyType->name: null : null }} 

                                                                [{{ $property->estatePropertyType ? $property->estatePropertyType->estate ? $property->estatePropertyType->estate->name: null : null }}]

                                                                [{{ $property->unique_number }}]
                                                            
                                                            </option>
                                                        @endforeach
                                                        
                                                    </select>

                                                </div>
                                            </div>
                                            
                                            <div class="mb-3 row">
                                                <label class="col-form-label col-md-2">Amount</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="number" max="{{ $propertybalance }}" id="payingAmount">
                                                    <small>Max: {{ $propertybalance }}</small>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- /.box-body -->
                                        @if ($client->id)
                                        <div class="box-footer">
                                            <a href="#" class="btn btn-primary btn-block" id="onlinePaymentBtn">Pay Now</a>
                                        </div>    
                                        @endif
                                        
                                    </form>

                                </div>
                            </div>
                        </div>    
                        
                    </div>

                    @if ($client->transactions->isNotEmpty())
                        
                    <div class="table-responsive">
                    <table id="payments" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                        <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-left">Property</th>
                                    <th class="text-right">Amount</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Action(s)</th>
                                </tr>
                        </thead>
                        <tbody>
                            @foreach ($client->transactions as $transaction)
                            <tr>
                                <th scope="row" class="text-center">{{ $loop->iteration }}</th>

                                <td>
                                    @if ($transaction->property)
                                        @if ($transaction->property->estatePropertyType)
                                            <span class="text-warning">{{ $transaction->property->estatePropertyType->estate ? $transaction->property->estatePropertyType->estate->name : null }}</span> - {{ $transaction->property->estatePropertyType->propertyType ? $transaction->property->estatePropertyType->propertyType->name : null }}
                                        @endif
                                    @endif
                                </td>

                                <td class="text-right">{{ number_format($transaction->amount, 2) }}</td>

                                <td class="text-center">
                                    
                                    @if ($transaction->onlinePayment)
                                    <span class="badge bg-primary">online</span>
                                    @else
                                    <span class="badge bg-danger">recorded</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    {{ $transaction->created_at ? $transaction->created_at->toFormattedDateString() : null }}
                                </td>

                                <td class="text-center">
                                    <a href="{{ route('frontend.clients.downloadReciept', [$client->id, $transaction->id]) }}" class="text-primary p-0" data-original-title="" title="Download Reciept" download>
                                        <i class="fa fa-download font-medium-3 mr-2"></i>
                                    </a>

                                    @if (!$transaction->onlinePayment)
                                    <a href="{{ $transaction->getFirstMediaUrl('proofOfPayment') }}" class="text-danger p-0"
                                        data-original-title="" title="Proof of Payment" target="_blank">
                                        <i class="fa fa-file-pdf font-medium-3 mr-2"></i>
                                    </a>    
                                    @endif
                                    
                                    <a  href="{{ route('frontend.clients.mailReciept', [$client->id, $transaction->id]) }}" href="#" class="text-success p-0"
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
                                <th class="text-right">Amount</th>
                                <th class="text-center">Type</th>
                                <th class="text-center">Date</th>
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