<div>
    <div class="rs-contact contact-style2 pt-95 pb-100 md-pt-65 md-pb-70">
        <div class="container">
            <div class="sec-title2 mb-55 md-mb-35 text-start">
                <h1 class="title mb-0">Subscription Form </h1>
            </div>
            <div class="row y-middle">
                <div class="col-lg-12">
                    <div class="contact-wrap">
                        <div id="form-messages"></div>

                        <form x-data wire:submit.prevent="save">
                            <div class="box-header with-border">
                                <h4 class="box-title">&nbsp</h4>
                            </div>

                            <input type="hidden" name="amount" id="amount" value="10000">

                            {{-- PAGE ONE --}}
                            <div x-show="$wire.pageOne" x-transition.duration.100ms class="box-body">

                                <fieldset>
                                    <legend>Vio data</legend>
                                    <div>
                                        <div class="form-group row mb-3 mb-md-5">
                                            <label class="col-form-label col-md-2" id="sname">Surname Name <span class="text-danger">*</span></label>
                                            <div class="col-md-10">
                                                <input wire:model.lazy="sname" class="from-control" type="text">
                                                @error('sname') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3 mb-md-5">
                                            <label class="col-form-label col-md-2" id="onames">Other Names <span class="text-danger">*</span></label>
                                            <div class="col-md-10">
                                                <input wire:model.lazy="onames" class="from-control" type="text">
                                                @error('onames') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3 mb-md-5">
                                            <label class="col-form-label col-md-2" for="gender">Gender <span class="text-danger">*</span></label>
                                            <div class="col-md-10">
                                                <select wire:model.lazy="gender" class="from-control">
                                                    <option value="">Select one</option>
                                                    @foreach ($genders as $gender)
                                                        <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('gender') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3 mb-md-5">
                                            <label class="col-form-label col-md-2" for="email">Email</label>
                                            <div class="col-md-10">
                                                <input wire:model.lazy="email" value="{{ $email }}" class="from-control" type="email" id="email">
                                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3 mb-md-5">
                                            <label class="col-form-label col-md-2" id="phone">Phone number <span class="text-danger">*</span></label>
                                            <div class="col-md-10">
                                                <input wire:model="phone" class="from-control" type="number">
                                                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3 mb-md-5">
                                            <label class="col-form-label col-md-2" id="marital_status_id">Marital Status <span class="text-danger">*</span></label>
                                            <div class="col-md-10">
                                                <select wire:model.lazy="marital_status_id" class="from-control">
                                                    <option value="">Please select one</option>
                                                    @foreach ($maritalStatuses as $maritalStatus)
                                                        <option value="{{ $maritalStatus->id }}">{{ $maritalStatus->name }}</option>
                                                    @endforeach

                                                </select>
                                                @error('marital_status_id') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3 mb-md-5">
                                            <label class="col-form-label col-md-2" id="dob">Date of birth <span class="text-danger">*</span></label>
                                            <div class="col-md-10">
                                                <input wire:model.lazy="dob" class="from-control" type="date">
                                                @error('dob') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3 mb-md-5">
                                            <label class="col-form-label col-md-2" for="country_code">Country <span class="text-danger">*</span></label>
                                            <div class="col-md-10">
                                                <select wire:model.lazy="country_code" class="from-control" id="country_code">
                                                    <option value="">Select one</option>
                                                    @foreach ($countries as $code =>  $country)
                                                        <option value="{{ $code }}">{{ $country['name'] }}</option>
                                                    @endforeach
                                                </select>
                                                @error('country_code') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3 mb-md-5">
                                            <label class="col-form-label col-md-2" id="place_of_birth">Place of birth</label>
                                            <div class="col-md-10">
                                                <input wire:model.lazy="place_of_birth" value="" class="from-control" type="text">
                                                @error('place_of_birth') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3 mb-md-5">
                                            <label class="col-form-label col-md-2" id="state_id">State of origin <span class="text-danger">*</span></label>
                                            <div class="col-md-10">
                                                <select wire:model.lazy="state_id" class="from-control">
                                                    <option value="">Select one</option>
                                                    @foreach ($states as $state)
                                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('state_id') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3 mb-md-5">
                                            <label class="col-form-label col-md-2" id="lga_id">Local Govt. of origin <span class="text-danger">*</span></label>
                                            <div class="col-md-10">
                                                <select wire:model.lazy="lga_id" class="from-control">
                                                    <option value="">Select one</option>
                                                    @foreach ($lgas as $lga)
                                                        <option value="{{ $lga->id }}">{{ $lga->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('lga_id') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3 mb-md-5">
                                            <label class="col-form-label col-md-2" id="profile_picture">Upload Photo (Please take a selfie or upload any picture that captures your face) <span class="text-danger">*</span></label>
                                            <div class="col-md-10">
                                                <input wire:model="profile_picture" class="from-control" type="file">
                                                @error('profile_picture') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="d-grid grid-2">
                                        <input x-on:click="$wire.setPageTwo()" type="button" class="readon submit mb-2" value="Next">
                                    </div>
                                </fieldset>

                            </div>

                            {{-- PAGE TWO --}}
                            <div x-show="$wire.pageTwo" x-transition.duration.100ms class="box-body">

                                <fieldset>
                                    <legend>Next-of-kin</legend>

                                    <div class="form-group row mb-3 mb-md-5">
                                        <label class="col-form-label col-md-2" id="nok_name">Name <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input wire:model.lazy="nok_name" class="from-control" type="text">
                                            @error('nok_name') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3 mb-md-5">
                                        <label class="col-form-label col-md-2" id="nok_dob">Date of birth <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input wire:model.lazy="nok_dob" class="from-control" type="date">
                                            @error('nok_dob') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3 mb-md-5">
                                        <label class="col-form-label col-md-2" id="nok_gender_id">Gender <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <select wire:model.lazy="nok_gender_id" class="from-control">
                                                <option value="">Select one</option>
                                                @foreach ($genders as $gender)
                                                    <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('nok_gender_id') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3 mb-md-5">
                                        <label class="col-form-label col-md-2" id="relationship_with_nok">Relationship</label>
                                        <div class="col-md-10">
                                            <input wire:model.lazy="relationship_with_nok" class="from-control" type="text">
                                            @error('relationship_with_nok') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3 mb-md-5">
                                        <label class="col-form-label col-md-2" id="nok_phone">Phone number <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input wire:model="nok_phone" class="from-control" type="number">
                                            @error('nok_phone') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3 mb-md-5">
                                        <label class="col-form-label col-md-2" id="nok_email">Email</label>
                                        <div class="col-md-10">
                                            <input wire:model.lazy="nok_email" class="from-control" type="email">
                                            @error('nok_email') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3 mb-md-5">
                                        <label class="col-form-label col-md-2" id="nok_address">Contact Address</label>
                                        <div class="col-md-10">
                                            <textarea wire:model.lazy="nok_address" class="from-control" type="email"></textarea>
                                            @error('nok_address') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="d-grid grid-2">
                                        <input x-on:click="$wire.setPageOne()" type="button" class="readon submit mb-2" value="Previous">
                                        <input x-on:click="$wire.setPageThree()" type="button" class="readon submit mb-2" value="Next">
                                    </div>
                                </fieldset>

                            </div>

                            {{-- PAGE THREE --}}
                            <div x-show="$wire.pageThree" x-transition.duration.100ms class="box-body">

                                <fieldset>
                                    <legend>Property Details</legend>

                                    <div class="form-group row mb-3 mb-md-5">
                                        <label class="col-form-label col-md-2" id="number_of_plots">How Many Plots Are You Buying? <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input wire:model.lazy="number_of_plots" class="from-control" type="text">
                                            @error('number_of_plots') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3 mb-md-5">
                                        <label class="col-form-label col-md-2" id="estate_id">Estate <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <select wire:model.lazy="estate_id" wire:change="onSelectEstate($event.target.value)" class="from-control">
                                                <option value="">Select one</option>
                                                @foreach ($estates as $estate)
                                                    <option value="{{ $estate->id }}">{{ $estate->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('estate_id') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3 mb-md-5">
                                        <label class="col-form-label col-md-2" id="propertyType_id">Which Property Type Are You Subscribing For <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <select wire:model.lazy="propertyType_id" wire:change="onSelectPropertyType($event.target.value)" class="from-control">
                                                <option value="">Select one</option>
                                                @forelse ($propertyTypes as $propertyType)
                                                    <option value="{{ $propertyType['id'] }}">{{ $propertyType['name'] }}</option>
                                                @empty

                                                @endforelse
                                            </select>
                                            @error('propertyType_id') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3 mb-md-5">
                                        <label class="col-form-label col-md-2" id="payment_plan_id">Select your prefered Payment Plan <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <select wire:model.lazy="payment_plan_id" class="from-control">
                                                <option value="">Select one</option>
                                                @forelse  ($paymentPlans as $paymentPlan)
                                                <option value="{{ $paymentPlan['id'] }}">{{ $paymentPlan['name'] }}</option>
                                                @empty

                                                @endforelse
                                            </select>
                                            @error('payment_plan_id') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3 mb-md-5">
                                        <label class="col-form-label col-md-2" id="referrer">Who Referred You?</label>
                                        <div class="col-md-10">
                                            <input wire:model.lazy="referrer" class="from-control" type="text">
                                            @error('referrer') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3 mb-md-5">
                                        <label class="col-form-label col-md-2" id="signature">Signature (Please sign on a plain sheet, snap it and upload)</label>
                                        <div class="col-md-10">
                                            <input wire:model.lazy="signature" class="from-control" type="file">
                                            @error('signature') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3 mb-md-5">
                                        <div class="alert alert-info" role="alert">
                                            <strong>Important</strong> <br>
                                            You will rediercted to  the payment page. Your details will only be saved if payment is successful.
                                        </div>
                                    </div>

                                    <div class="d-grid grid-2">
                                        <input x-on:click="$wire.setPageTwo()" type="button" class="readon submit mb-2" value="Previous">
                                        <input wire:click="" type="submit" class="readon submit mb-2" value="Make payment" id="onlinePaymentBtn">
                                    </div>
                                </fieldset>

                            </div>

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

            var email = document.getElementById('email').value;
            var amount = document.getElementById('amount').value;

            const data = {
                email,
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

            var email = document.getElementById('email').value;
            var amount = document.getElementById('amount').value;

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
