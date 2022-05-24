@extends('layouts.frontend')

@section('content')
    <livewire:signup.signup-preview :client="$client" :estateId="$estate" :propertyTypeId="$propertyType" :paymentPlanId="$paymentPlan" />

{{--<div>--}}
{{--    <div class="rs-contact contact-style2 pt-95 pb-100 md-pt-65 md-pb-70">--}}
{{--        <div class="container">--}}
{{--            <div class="sec-title2 mb-55 md-mb-35 text-start">--}}
{{--                <h1 class="title mb-0">Subscription Form </h1>--}}
{{--            </div>--}}
{{--            <div class="row y-middle">--}}
{{--                <div class="col-lg-12">--}}
{{--                    <div class="contact-wrap">--}}
{{--                        <div id="form-messages"></div>--}}

{{--                            <input type="hidden" name="amount" id="amount" value="10000">--}}

{{--                            --}}{{-- PAGE ONE --}}
{{--                            <div class="box-body">--}}

{{--                                <input type="hidden" name="processing_fee" id="processing_fee" value="{{$processingFee}}">--}}
{{--                                <input type="hidden" name="amount" id="amount" value="{{$propertyPrice}}">--}}
{{--                                <input type="hidden" name="email" id="email" value="{{$client->email}}">--}}
{{--                                <input type="hidden" name="total_amount" id="total_amount" value="{{$processingFee + $propertyPrice}}">--}}

{{--                                <div class="row">--}}
{{--                                    <div class="col-md-7">--}}

{{--                                        <table class="table table-bordered">--}}
{{--                                            <tbody>--}}
{{--                                            <tr><td colspan="2"><strong>Personal Information</strong></td></tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Surname Name</td>--}}
{{--                                                <td>{{ $client->sname  }}</td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Other Names</td>--}}
{{--                                                <td>{{ $client->onames  }}</td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Gender</td>--}}
{{--                                                <td>{{ $client->gender  }}</td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Email</td>--}}
{{--                                                <td>{{ $client->email  }}</td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Phone number</td>--}}
{{--                                                <td>{{ $client->phone  }}</td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Marital Status</td>--}}
{{--                                                <td>{{ $client->marital_status  }}</td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Date of birth</td>--}}
{{--                                                <td>{{ $client->dob  }}</td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Country</td>--}}
{{--                                                <td>{{ $client->country  }}</td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Place of birth</td>--}}
{{--                                                <td>{{ $client->place_of_birth  }}</td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>State of origin</td>--}}
{{--                                                <td>{{ $client->state->name  }}</td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Local Govt. of origin</td>--}}
{{--                                                <td>{{ $client->lga->name  }}</td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>State of origin</td>--}}
{{--                                                <td>{{ $client->state->name  }}</td>--}}
{{--                                            </tr>--}}
{{--                                            <tr><td colspan="2"><strong>Next-of-Kin</strong></td></tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Name</td>--}}
{{--                                                <td>{{ $client->nok_name  }}</td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Date of birth</td>--}}
{{--                                                <td>{{ $client->nok_dob  }}</td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Gender</td>--}}
{{--                                                <td>{{ $client->nok_gender_id  }}</td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Relationship</td>--}}
{{--                                                <td>{{ $client->relationship_with_nok  }}</td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Phone number</td>--}}
{{--                                                <td>{{ $client->nok_phone  }}</td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Email</td>--}}
{{--                                                <td>{{ $client->nok_email  }}</td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Contact Address</td>--}}
{{--                                                <td>{{ $client->nok_address  }}</td>--}}
{{--                                            </tr>--}}
{{--                                            <tr><td colspan="2"><strong>Property Information</strong></td></tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Estate</td>--}}
{{--                                                <td>{{ $estate->name  }}</td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Which Property Type Are You Subscribing For</td>--}}
{{--                                                <td>{{ $propertyType->name  }}</td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Prefered Payment Plan</td>--}}
{{--                                                <td>{{ $paymentPlan->name  }}</td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Referrer</td>--}}
{{--                                                <td>{{ $client->referrer }}</td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Signature</td>--}}
{{--                                                <td>{{ $client->signature }}</td>--}}
{{--                                            </tr>--}}
{{--                                            </tbody>--}}
{{--                                        </table>--}}

{{--                                    </div>--}}
{{--                                    <div class="col-md-5">--}}

{{--                                        <table class="table table-bordered">--}}
{{--                                            <tr><td colspan="2"><strong>Payment Information</strong></td></tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Property</td>--}}
{{--                                                <td>{{$property->unique_number}}</td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Processing Fee</td>--}}
{{--                                                <td class="text-end"> {{number_format($processingFee)}}</td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Price</td>--}}
{{--                                                <td class="text-end"> {{number_format($propertyPrice)}}</td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td><strong>TOTAL:</strong></td>--}}
{{--                                                <td class="text-end"><strong>&#8358; {{number_format($processingFee + $propertyPrice)}}</strong></td>--}}
{{--                                            </tr>--}}
{{--                                        </table>--}}

{{--                                        <div class="form-group row mb-0">--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="d-grid grid-2">--}}
{{--                                                    <a class="readon submit mb-2">Back to form</a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="d-grid grid-2">--}}
{{--                                                    <input type="submit" class="readon submit mb-2" value="Pay Now" id="onlinePaymentBtn">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                    </div>--}}
{{--                                </div>--}}

{{--                            </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}


{{--@push('scripts')--}}

{{--    <script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/js/pages/data-table.js') }}"></script>--}}
{{--    <script src="//unpkg.com/alpinejs" defer></script>--}}

{{--    --}}{{-- Paystack --}}
{{--    <script src="https://js.paystack.co/v1/inline.js"></script>--}}

{{--    <script>--}}

{{--        const onlinePaymentBtn = document.getElementById('onlinePaymentBtn');--}}

{{--        onlinePaymentBtn.addEventListener("click", payWithPaystack, false);--}}

{{--        // load paystack plugin--}}
{{--        function payWithPaystack(e) {--}}

{{--            e.preventDefault();--}}

{{--            var email = document.getElementById('email').value;--}}
{{--            var amount = document.getElementById('total_amount').value;--}}

{{--            let handler = PaystackPop.setup({--}}
{{--                key: '{{env("PAYSTACK_PK")}}', // public key--}}
{{--                email: email,--}}
{{--                amount: amount * 100,--}}
{{--                onClose: function(){--}}
{{--                    // alert('Window closed.');--}}
{{--                },--}}
{{--                callback: function(response){--}}
{{--                    // let message = 'Payment complete! Reference: ' + response.reference;--}}

{{--                    const data = {--}}
{{--                        reference: response.reference,--}}
{{--                        email,--}}
{{--                        amount,--}}
{{--                        message: response.message,--}}
{{--                        reference: response.reference,--}}
{{--                        status: response.status,--}}
{{--                    }--}}

{{--                    Livewire.emit('onlinePaymentSuccessful', data)--}}
{{--                }--}}
{{--            });--}}

{{--            handler.openIframe();--}}
{{--        }--}}

{{--    </script>--}}

{{--    <script src="js/pages/advanced-form-element.js"></script>--}}

{{--@endpush--}}

@endsection
