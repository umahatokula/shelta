<div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">&nbsp</h5>
        </div>
        <div class="card-body">
            <div class="example-container">
                <div class="example-content">

                    <div class="col-lg-12">
                        <div class="box p-15">

                            <div x-data="{show: false}" class="row mb-4">
                                <div class="col-md-6">
                                    <h3 class="box-title">Payments</h3>
                                </div>
                                <div class="col-md-6 d-grid gap-2 d-md-flex justify-content-md-end">
                                        @can('online payment')
                                            <button @click="show = true" x-show="!show" href="#"  class="btn btn-primary me-md-2" type="button">Online
                                                Payment</button>
                                            <button @click="show = false" x-show="show" href="#"  class="btn btn-danger me-md-2" type="button">Cancel Online
                                                Payment</button>
                                        @endcan

                                        @can('record payment')
                                            <a href="{{ route('transactions.create', $client) }}"  class="btn btn-success" type="button">Record
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

                                                <div class="form-group row mb-5">
                                                    <label class="col-form-label col-md-2">Name</label>
                                                    <div class="col-md-10">
                                                        <input value="{{ $client->sname.' '.$client->onames }}" class="form-control" type="text" id="payingName" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-5">
                                                    <label class="col-form-label col-md-2">Email</label>
                                                    <div class="col-md-10">
                                                        <input value="{{ $client->email }}" class="form-control" type="text" id="payingEmail" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-5">
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

                                                <div class="form-group row mb-5">
                                                    <label class="col-form-label col-md-2">Amount</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" type="number" max="{{ $propertybalance }}" {{ $propertybalance == 0 ? 'disabled' : '' }} id="payingAmount">
                                                        <small>Max: {{ $propertybalance }}</small>
                                                    </div>
                                                </div>

                                                <!-- /.box-body -->
                                                @if ($client->id)
                                                <div class="box-footer">
                                                    <div class="d-grid grid-2">
                                                        <a href="#" class="btn btn-primary btn-lg" id="onlinePaymentBtn">Pay Now</a>
                                                    </div>
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
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Date Recorded</th>
                                            <th class="text-center">Last Instalment</th>
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
                                                    <span class="text-warning">{{

                                                    $transaction->property->estatePropertyType->estate ? $transaction->property->estatePropertyType->estate->name : null }}</span> -

                                                    {{ $transaction->property->estatePropertyType->propertyType ? $transaction->property->estatePropertyType->propertyType->name : null }}

                                                    [{{ $transaction->property->unique_number }}]
                                                @endif
                                            @endif
                                        </td>

                                        <td class="text-right">{{ number_format($transaction->amount, 2) }}</td>

                                        <td class="text-center">

                                            @if ($transaction->onlinePayment)
                                                <span class="badge badge-primary">online</span>
                                            @else
                                                <span class="badge badge-danger">recorded</span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            @if ($transaction->status == 1)
                                                <span class="badge badge-success">approved</span>
                                            @elseif ($transaction->status == 2)
                                                <span class="badge badge-danger">unapproved</span>
                                            @else
                                                <span class="badge badge-secondary">unprocessed</span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            {{ $transaction->date ? $transaction->date->toFormattedDateString() : null }}
                                        </td>

                                        <td class="text-center">
                                            {{ $transaction->instalment_date ? $transaction->instalment_date->toFormattedDateString() : null }}
                                        </td>

                                        <td class="text-center">

                                            @can('process transactions')
                                            <a  data-toggle="modal" data-keyboard="false" data-target="#modal-center" data-remote="{{ route('transactions.process', $transaction) }}" href="#" class="text-default p-0" data-original-title="" title="Process Transaction">
                                                <span class="material-icons-outlined">
                                                    flaky
                                                    </span>
                                            </a>
                                            @endcan

                                            <a data-toggle="modal" data-keyboard="false" data-target="#modal-center" data-remote="{{ route('transactions.show', $transaction) }}" href="#" class="text-primary p-0" data-original-title="" title="View Details">
                                                <span class="material-icons-outlined">
                                                    visibility
                                                    </span>
                                            </a>

                                            <a wire:click.prevent="downloadReciept({{$client->id}}, {{$transaction->id}})"
                                                href="#" class="text-success p-0" data-original-title="" title="Download Reciept" download>
                                                <span class="material-icons-outlined">
                                                file_download
                                                </span>
                                            </a>

                                            @if (!$transaction->onlinePayment)
                                            <a href="{{ $transaction->getFirstMediaUrl('proofOfPayment') }}" class="text-danger p-0"
                                                data-original-title="" title="Proof of Payment" target="_blank">
                                                <span class="material-icons-outlined">
                                                    picture_as_pdf
                                                    </span>
                                            </a>
                                            @endif

                                            <a wire:click.prevent="mailReciept({{$client->id}}, {{$transaction->id}})" href="#" class="text-warning p-0"
                                                data-original-title="" title="Email Reciept">
                                                <span class="material-icons-outlined">
                                                    email
                                                    </span>
                                            </a>

                                            <a href="{{ route('transactions.edit', [$client, $transaction]) }}" class="text-default p-0" data-original-title="" title="Edit Transaction">
                                                <span class="material-icons-outlined">
                                                    edit
                                                    </span>
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
                                        <th class="text-center">Status</th>
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
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">&nbsp</h5>
        </div>
        <div class="card-body">
            <div class="example-container">
                <div class="example-content">
                    <div class="col-lg-12">
                        <div class="box p-15">

                            <div class="row mb-5">
                                <div class="col-md-6 float-right">
                                    <h3>Properties</h3>
                                </div>
                                <div class="col-md-6 d-grid gap-2 d-md-flex justify-content-md-end">
                                    @can('assign property')
                                    <a href="{{ route('clients.add-property', $client) }}" class="btn btn-primary" >Add properties</a>
                                    @endcan
                                </div>
                            </div>

                            @forelse ($client->properties->chunk(3) as $chunk)

                            <div class="row mb-5">

                                @foreach ($chunk as $property)
                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-lg-12 col-12">
                                            <div class="box">
                                                <div class="mb-4">
                                                    <h4 class="box-title">
                                                        @if ($property->estatePropertyType)
                                                        {{ $property->estatePropertyType->propertyType ? $property->estatePropertyType->propertyType->name : null }}

                                                            <span class="font-weight-bold font-italic" style="font-size: 1rem">in</span>

                                                            @if ($property->estatePropertyType)
                                                                <span class="text-warning">{{ $property->estatePropertyType->estate ? $property->estatePropertyType->estate->name : null }}</span>
                                                            @endif
                                                        @else
                                                        Property
                                                        @endif
                                                    </h4>
                                                </div>
                                                <!-- /.box-header -->
                                                <div class="box-body">
                                                    <!-- Place somewhere in the <body> of your page -->
                                                    <div class="row">
                                                        {{-- <div class="col-lg-4">
                                                            <div class="flexslider2">
                                                                <ul class="slides">

                                                                    @if ($property->estatePropertyType)
                                                                        @if ($property->estatePropertyType->propertyType)

                                                                            @foreach ($property->estatePropertyType->propertyType->getMedia('propertyTypephotos') as $photo)
                                                                                <li
                                                                                    data-thumb="{{ $photo->getUrl('thumb') }}">
                                                                                    <img src="{{ $photo->getUrl() }}"
                                                                                        alt="slide" />
                                                                                </li>
                                                                            @endforeach

                                                                        @endif
                                                                    @endif

                                                                </ul>
                                                            </div>
                                                        </div> --}}

                                                        <div class="col-lg-6 col-12">
                                                            <table class="table table-hover">
                                                                <tbody>
                                                                    <tr>
                                                                        <td colspan="2"><b>Property Info:</b></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Estate:</td>
                                                                        <td>
                                                                            @if ($property->estatePropertyType)
                                                                            {{ $property->estatePropertyType->estate ? $property->estatePropertyType->estate->name : null }}
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Payment Plan:</td>
                                                                        <td>
                                                                            {{ $property->paymentPlan->name }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Price:</td>
                                                                        <td>
                                                                            @if ($property->estatePropertyType)
                                                                            &#x20A6; {{ number_format($property->estatePropertyType->priceOfPaymentPlan($property->payment_plan_id), 2) }}
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>House number:</td>
                                                                        <td>{{ $property->unique_number }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>First Payment:</td>
                                                                        <td>{{ $property->date_of_first_payment ? $property->date_of_first_payment->toFormattedDateString() : null }}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                          <div class="col-lg-6 col-12">
                                                              <table class="table table-hover">
                                                                  <tbody>
                                                                    <tr>
                                                                        <td colspan="2"><b>Payment Info:</b></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Total Paid:</td>
                                                                        <td>&#x20A6; {{ number_format($property->totalPaid(), 2) }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Monthly Payment Date:</td>
                                                                        <td>
                                                                            @if ($property->lastPayment())
                                                                            <strong>
                                                                                @if ($property->date_of_first_payment)
                                                                                {{ ltrim($property->date_of_first_payment->format('d'), '0').$property->propertyPaymentDateSuffix($property->date_of_first_payment->format('d')) }}
                                                                                @endif
                                                                            </strong> monthly
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Last Instalment:</td>
                                                                        <td>
                                                                            @if ($property->lastPayment())
                                                                            {{ $property->lastPayment()->instalment_date ? $property->lastPayment()->instalment_date->toFormattedDateString() : null }}
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Next Payment:</td>
                                                                        <td>
                                                                            @if($property->totalPaid() >= $property->estatePropertyType->priceOfPaymentPlan($property->payment_plan_id) ) Payment completed

                                                                            @else
                                                                                @if ($property->lastPayment())
                                                                                {{ $property->nextPaymentDueDate() ? $property->nextPaymentDueDate()->toFormattedDateString() : null }}
                                                                                @endif
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Payment Default Total:</td>
                                                                        <td>
                                                                            &#8358; {{ number_format($property->getClientPaymentDefaultsBalance(), 2) }} &nbsp; <a href="{{ route('payment-defaults.pay', [$property->unique_number, $client->id]) }}">[Pay]</a>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>

                            @empty

                            <p>No properties yet</p>

                            @endforelse
                        </div>
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

        onlinePaymentBtn.addEventListener("click", validateInput, false);

        // perform validation
        function validateInput(e) {

            e.preventDefault();

            var clientId = @json($client->id);
            var email = document.getElementById('payingEmail').value;
            var amount = document.getElementById('payingAmount').value;
            var property_id = document.getElementById('payingPropertyId').value;

            const data = {
                client_id: @json($client->id),
                property_id,
                amount,
            }

            Livewire.emit('validateInput', data)

        }

        // on successful validation
        window.addEventListener('onSuccessfulValidation', event => {
            payWithPaystack()
        })

        // load paystack plugin
        function payWithPaystack() {

            var clientId = @json($client->id);
            var email = document.getElementById('payingEmail').value;
            var amount = document.getElementById('payingAmount').value;
            var property_id = document.getElementById('payingPropertyId').value;

            let handler = PaystackPop.setup({
                    key: '{{env("PAYSTACK_PK")}}', // public key
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

                    Livewire.emit('onlinePaymentSuccessful', data)
                }
            });

            handler.openIframe();
        }

    </script>

	<script src="js/pages/advanced-form-element.js"></script>

@endpush
