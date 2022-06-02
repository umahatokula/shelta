<div>

    <div class="bloghead">
        <h1>Subscription Form</h1>
    </div>

    <div class="subbody">
        <div class="subform">

            <form wire:submit.prevent="signUpPreview">

                <input type="hidden" name="processing_fee" id="processing_fee" value="{{$processingFee}}">
                <input type="hidden" name="property_price" id="property_price" value="{{$propertyPrice}}">
                <input type="hidden" name="total_amount" id="total_amount" value="{{$processingFee + $propertyPrice}}">

                <h3>Basic Info</h3>

                <label for="sname">Surname Name <span>*</span></label>
                <input  wire:model.lazy="sname" type="text" placeholder="Your Full name" minlength="3" maxlength="25" id="sname">
                @error('sname') <small><span class="text-danger">{{ $message }}</span></small> @enderror

                <label for="onames">Other Names <span>*</span></label>
                <input  wire:model.lazy="onames" type="text" placeholder="Your Full name" minlength="3" maxlength="25" id="onames">
                @error('onames') <small><span class="text-danger">{{ $message }}</span></small> @enderror

                <label for="gender">Gender<span>*</span></label>
                <select wire:model.lazy="gender" class="from-control">
                    <option value="">Select one</option>
                    @foreach ($genders as $gender)
                        <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                    @endforeach
                </select> <br>
                @error('gender') <small><span class="text-danger">{{ $message }}</span></small> @enderror

                <label for="email">Email<span>*</span></label>
                <input wire:model.lazy="email" value="{{ $email }}" class="from-control" type="email" id="email">
                @error('email') <small><span class="text-danger">{{ $message }}</span> </small>@enderror

                <label for="phone">Phone Number<span>*</span></label>
                <input wire:model="phone" class="from-control" type="number">
                @error('phone') <small><span class="text-danger">{{ $message }}</span> </small>@enderror

                <label for="marital_status_id">Marital Status<span>*</span></label>
                <select wire:model.lazy="marital_status_id" class="from-control">
                    <option value="">Please select one</option>
                    @foreach ($maritalStatuses as $maritalStatus)
                        <option value="{{ $maritalStatus->id }}">{{ $maritalStatus->name }}</option>
                    @endforeach

                </select> <br>
                @error('marital_status_id') <small><span class="text-danger">{{ $message }}</span> </small>@enderror

                <label for="dob">Date of Birth<span>*</span></label>
                <input wire:model.lazy="dob" class="from-control" type="date">
                @error('dob') <small><span class="text-danger">{{ $message }}</span> </small>@enderror

                <label for="country_code">Nationality<span>*</span></label>
                <select wire:model.lazy="country_code" class="from-control" id="country_code">
                    <option value="">Select one</option>
                    @foreach ($countries as $code =>  $country)
                        <option value="{{ $code }}">{{ $country['name'] }}</option>
                    @endforeach
                </select> <br>
                @error('country_code') <small><span class="text-danger">{{ $message }}</span> </small>@enderror

                <label for="place_of_birth">Place of Birth<span>*</span></label>
                <input wire:model.lazy="place_of_birth" value="" class="from-control" type="text">
                @error('place_of_birth') <small><span class="text-danger">{{ $message }}</span> </small>@enderror

                <label for="state_id">State of Origin <span>*</span></label>
                <select wire:model.lazy="state_id" class="from-control">
                    <option value="">Select one</option>
                    @foreach ($states as $state)
                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                    @endforeach
                </select> <br>
                @error('state_id') <small><span class="text-danger">{{ $message }}</span> </small>@enderror

                <label for="lga_id">Local Government of Origin <span>*</span></label>
                <select wire:model.lazy="lga_id" class="from-control">
                    <option value="">Select one</option>
                    @foreach ($lgas as $lga)
                        <option value="{{ $lga->id }}">{{ $lga->name }}</option>
                    @endforeach
                </select> <br>
                @error('lga_id') <small><span class="text-danger">{{ $message }}</span> </small>@enderror

                <label for="residential_address">Residential Address <span>*</span></label>
                <input wire:model.lazy="residential_address" class="from-control" type="text">
                @error('residential_address') <small><span class="text-danger">{{ $message }}</span> </small>@enderror

                <label for="profile_picture">Upload Photo (Please take a selfie or upload any picture that captures your face)<span>*</span></label>
                <input wire:model="profile_picture" class="from-control" type="file">
{{--                <div class="profile_picture">--}}
{{--                    @if ($profile_picture)--}}
{{--                        <p style="margin: 10px 0;">Photo Preview:</p>--}}
{{--                        <img src="{{ $profile_picture->temporaryUrl() }}" style="max-width: 150px;">--}}
{{--                    @endif--}}
{{--                </div>--}}
                @error('profile_picture') <small><span class="text-danger">{{ $message }}</span> </small>@enderror

                <br><br>
                <h3>Next of Kin Details</h3>

                <label for="nok_name">Full Name <span>*</span></label>
                <input wire:model.lazy="nok_name" class="from-control" type="text">
                @error('nok_name') <small><span class="text-danger">{{ $message }}</span> </small>@enderror

                <label for="nok_dob">Date of Birth<span>*</span></label>
                <input wire:model.lazy="nok_dob" class="from-control" type="date">
                @error('nok_dob') <small><span class="text-danger">{{ $message }}</span> </small>@enderror

                <label for="nok_gender_id">Gender<span>*</span></label>
                <select wire:model.lazy="nok_gender_id" class="from-control">
                    <option value="">Select one</option>
                    @foreach ($genders as $gender)
                        <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                    @endforeach
                </select> <br>
                @error('nok_gender_id') <small><span class="text-danger">{{ $message }}</span> </small>@enderror

                <label for="relationship_with_nok">Relationship <span>*</span></label>
                <input wire:model.lazy="relationship_with_nok" class="from-control" type="text">
                @error('relationship_with_nok') <small><span class="text-danger">{{ $message }}</span> </small>@enderror

                <label for="nok_phone">Phone Number<span>*</span></label>
                <input wire:model="nok_phone" class="from-control" type="number">
                @error('nok_phone') <small><span class="text-danger">{{ $message }}</span> </small>@enderror

                <label for="nok_email">Email<span>*</span></label>
                <input wire:model.lazy="nok_email" class="from-control" type="email">
                @error('nok_email') <small><span class="text-danger">{{ $message }}</span> </small>@enderror


                <label for="nok_address">Contact Address<span>*</span></label>
                <textarea wire:model.lazy="nok_address" class="" type="email"></textarea>
                @error('nok_address') <small><span class="text-danger">{{ $message }}</span> </small>@enderror


                <br><br>
                <h3>Property Details</h3>

                <label for="estate_id">Select the Estate to buy fom <span>*</span></label>
                <select wire:model.lazy="estate_id" wire:change="onSelectEstate($event.target.value)" class="from-control">
                    <option value="">Select one</option>
                    @foreach ($estates as $estate)
                        <option value="{{ $estate->id }}">{{ $estate->name }}</option>
                    @endforeach
                </select> <br>
                @error('estate_id') <small><span class="text-danger">{{ $message }}</span> </small>@enderror

                <label for="propertyType_id">Which Property Are You Subscribing For<span>*</span></label>
                <select wire:model.lazy="propertyType_id" wire:change="onSelectPropertyType($event.target.value)" class="from-control">
                    <option value="">Select one</option>
                    @forelse ($propertyTypes as $propertyType)
                        <option value="{{ $propertyType['id'] }}">{{ $propertyType['name'] }}</option>
                    @empty

                    @endforelse
                </select> <br>
                @error('propertyType_id') <small><span class="text-danger">{{ $message }}</span> </small>@enderror

                <label for="payment_plan_id">Select your prefered Payment Plan<span>*</span></label>
                <select wire:model.lazy="payment_plan_id" class="from-control" wire:change="onSelectPaymentPlan($event.target.value)" class="from-control">
                    <option value="">Select one</option>
                    @forelse  ($paymentPlans as $paymentPlan)
                    <option value="{{ $paymentPlan['id'] }}">{{ $paymentPlan['name'] }}</option>
                    @empty

                    @endforelse
                </select> <br>
                @error('payment_plan_id') <small><span class="text-danger">{{ $message }}</span> </small>@enderror

                <label for="referrer">Who Referred You? </label>
                <input wire:model.lazy="referrer" class="from-control" type="text">
                @error('referrer') <small><span class="text-danger">{{ $message }}</span> </small>@enderror

{{--                <div x-data="{ open: false }">--}}
{{--                <label for="payment_mode">Choose a payment type </label>--}}
{{--                <input wire:model.lazy="payment_mode" class="from-control" type="radio" value="transfer" id="transfer" checked required x-model="open = true">--}}
{{--                <label class="form-check-label" for="transfer">--}}
{{--                    Transfer--}}
{{--                </label> <br>--}}
{{--                <input wire:model.lazy="payment_mode" class="from-control" type="radio" value="online" id="online" required @click="open = false">--}}
{{--                <label class="form-check-label" for="online">--}}
{{--                    Online--}}
{{--                </label>--}}
{{--                @error('payment_mode') <small><span class="text-danger">{{ $message }}</span> </small>@enderror--}}
{{--                <br>--}}


{{--                    <div x-show="open">--}}
{{--                        <h4>Account Details</h4>--}}
{{--                        <p>Upon submission of this form, kindl make payment to the company account details within 24 hours. </p>--}}
{{--                        <br>--}}
{{--                        <p>--}}
{{--                            <b>Account Name:</b> Richboss Realty Limited<br>--}}
{{--                            <b>Account Number:</b> 7810850387 <br>--}}
{{--                            <b>Bank Name:</b> Wema Bank<br>--}}
{{--                        </p><br>--}}
{{--                        <p>Please note that Richboss Realty Limited will not be held liable for any payment not made directly--}}
{{--                            into our designated bank account.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}

                <br>
                <label for="signature">Signature (Please sign on a plain sheet, snap it and upload)<span>*</span></label>
                <input wire:model.prevent="signature" class="from-control" type="file">
                @error('signature') <small><span class="text-danger">{{ $message }}</span> </small>@enderror
                <br><br>

                <button type="submit" id="onlinePaymentBtn">Submit</button>

            </form>

        </div>

    </div>
</div>


@push('css')
    <style>

        .subform form input {
            padding: 10px;
            outline: none;
            width: 100%;
        }
        .subform form select {
            padding: 10px;
            width: 100%;
        }
        .subform form textarea {
            padding: 10px;
            width: 100%;
        }
        .subform form h3 {
            background-color: var(--primary);
            color: black;
            padding: 10px;
            width: 100%;
        }

        .text-danger {
        color: red;
    }
    </style>
@endpush

@push('scripts')

    {{-- Paystack --}}
    <script src="https://js.paystack.co/v1/inline.js"></script>

    <script>

        const onlinePaymentBtn = document.getElementById('onlinePaymentBtn');

        onlinePaymentBtn.addEventListener("click", validateInput, false);


        function validateInput(e) {

            e.preventDefault();

            Livewire.emit('validateInput')

            window.addEventListener('inputValidated', event => {
                payWithPaystack(e)
            })

        }


        // load paystack plugin
        function payWithPaystack(e) {

            e.preventDefault();

            var email = document.getElementById('email').value;
            var amount = document.getElementById('total_amount').value;

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
                        reference: response.reference,
                        email,
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
