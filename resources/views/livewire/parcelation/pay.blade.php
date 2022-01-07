<div>
    <div class="rs-contact contact-style2 pt-95 pb-100 md-pt-65 md-pb-70">
        <div class="container">
            <div class="sec-title2 mb-55 md-mb-35 text-center">
                <div class="sub-text">Online Payment</div>
                <h2 class="title mb-0">Make payment for plot <span>{{ $property->unique_number }}</span></h2>
            </div>
            <div class="row y-middle">
                <div class="col-lg-12">
                    <div class="contact-wrap">
                        <div id="form-messages"></div>

                        @if (session()->has('message'))
                        <div class="col-lg-12">
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        </div>
                        @endif

                        @if (session()->has('danger'))
                        <div class="col-lg-12">
                            <div class="alert alert-danger">
                                {{ session('danger') }}
                            </div>
                        </div>
                        @endif
                        
                        @if ($propertyisUnallocated)
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
                                            <input value="{{ $property->id }}" type="hidden" id="payingPropertyId"/>
                                            <p>{{ $property->estatePropertyType ? $property->estatePropertyType->propertyType ? $property->estatePropertyType->propertyType->name: null : null }}
                                                [{{ $property->estatePropertyType ? $property->estatePropertyType->estate ? $property->estatePropertyType->estate->name: null : null }}][{{ $property->unique_number }}]</p>
                                            
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 mb-30">
                                            <select class="from-select from-control"wire:change="onSelectPaymentPlan($event.target.value)"  id="paymentPlanId" required>

                                                @isset($paymentPlans[$key])
                                                    @forelse ($paymentPlans[$key] as $paymentPlan)
                                                        <option value="{{ $paymentPlan['id'] }}">{{ $paymentPlan['name'] }}</option>                                                
                                                    @empty
                                                        <option value="">No options</option>                                                
                                                    @endforelse
                                                @endisset
                                                
                                            </select>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 mb-30">
                                            <input class="from-control" name="amount" type="number" max="{{ $propertybalance }}" {{ $propertybalance == 0 ? 'disabled' : '' }} id="payingAmount" required>
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
                        @else
                            <p>This plot has already been allocated.</p>
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
            var payment_plan_id = document.getElementById('paymentPlanId').value;

            let handler = PaystackPop.setup({
                    key: '{{env("PAYSTACK_PK")}}', // Replace with your public key
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
                        payment_plan_id,
                        reference: response.reference,
                        amount,
                        message: response.message,
                        reference: response.reference,
                        status: response.status,
                    }

                    Livewire.emit('frontendOnlinePaymentOnPlotSelectionSuccessful', data)
                }
            });

            handler.openIframe();
        }

    </script>

	<script src="js/pages/advanced-form-element.js"></script>

@endpush

