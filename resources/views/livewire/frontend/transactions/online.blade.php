<div>
    <div class="rs-contact contact-style2 pt-95 pb-100 md-pt-65 md-pb-70">
        <div class="container">
            <div class="sec-title2 mb-55 md-mb-35 text-center">
                <div class="sub-text">Online Payment</div>
                <h2 class="title mb-0">You may make <span>online</span> payments here</h2>
            </div>
            <div class="row y-middle">
                <div class="col-lg-12">
                    <div class="contact-wrap">
                        <div id="form-messages"></div>

                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                @foreach ($errors->all() as $error)
                                    <div>{{$error}}</div>
                                @endforeach
                            </div>
                        @endif

                        @if (session()->has('error'))
                        <div class="col-lg-12">
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        </div>
                        @endif

                        <form id="onlinePaymentForm">
                            <fieldset>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 mb-30">
                                        <input value="{{ $client->name }}" class="from-control" type="text" name="name" placeholder="Name" id="payingName" readonly="">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 mb-30">
                                        <input value="{{ $client->email }}" class="from-control" type="email" name="email" placeholder="E-Mail" id="payingEmail" readonly>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 mb-30">
                                        <select class="from-control" wire:change="onSelectProperty($event.target.value)" id="payingPropertyId">

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
                                    <div class="col-lg-6 col-md-6 col-sm-6 mb-30">
                                        <input class="from-control" name="amount" type="number" max="{{ $propertybalance }}" {{ $propertybalance == 0 ? 'disabled' : '' }} id="payingAmount">
                                        <small>Max: {{ $propertybalance }}</small>
                                    </div>

                                </div>
                                <div class="btn-part">
                                    <div class="form-group mb-0">
                                        <input class="readon submit" type="submit" value="Pay Now" id="onlinePaymentBtn">
                                    </div>
                                </div>
                            </fieldset>
                        </form>

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
            console.log('success')
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

