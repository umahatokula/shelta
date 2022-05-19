@extends('layouts.frontend')

@section('content')
{{--    <livewire:signup.signup-form :estates="$estates" />--}}

<div>
    <div class="rs-contact contact-style2 pt-95 pb-100 md-pt-65 md-pb-70">
        <div class="container">
            <div class="sec-title2 mb-55 md-mb-35 text-start">
                <h1 class="title mb-0">Subscription Form </h1>
            </div>
            <div class="row y-middle">
                <div class="col-lg-12">
                    <div class="contact-wrap">
                        <div for="form-messages"></div>

                        @if (count($errors) > 0)
                            <div class="alert alert-danger alert-important">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{route('signUpPost')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="box-header with-border">
                                <h4 class="box-title">&nbsp</h4>
                            </div>

                            <input type="hidden" name="amount" for="amount" value="10000">

                            <fieldset>
                                <legend>Bio data</legend>
                                <div>
                                    <div class="form-group row mb-3 mb-md-5">
                                        <label class="col-form-label col-md-2" for="sname">Surname Name <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            {!! Form::text('sname', null, ['class'=>'form-control', 'id'=>'sname']) !!}
                                            @error('sname') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3 mb-md-5">
                                        <label class="col-form-label col-md-2" for="onames">Other Names <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            {!! Form::text('onames', null, ['class'=>'form-control', 'id'=>'onames']) !!}
                                            @error('onames') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3 mb-md-5">
                                        <label class="col-form-label col-md-2" for="gender">Gender <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            {!! Form::select('gender', $genders->pluck('name', 'id'), null, ['class'=>'form-control', 'id'=>'gender']) !!}
                                            @error('gender') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3 mb-md-5">
                                        <label class="col-form-label col-md-2" for="email">Email</label>
                                        <div class="col-md-10">
                                            {!! Form::email('email', null, ['class'=>'form-control', 'id'=>'email']) !!}
                                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3 mb-md-5">
                                        <label class="col-form-label col-md-2" for="phone">Phone number <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            {!! Form::number('phone', null, ['class'=>'form-control', 'id'=>'phone']) !!}
                                            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3 mb-md-5">
                                        <label class="col-form-label col-md-2" for="marital_status_id">Marital Status <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            {!! Form::select('marital_status_id', $maritalStatuses->pluck('name', 'id'), null, ['class'=>'form-control', 'id'=>'marital_status_id']) !!}
                                            @error('marital_status_id') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3 mb-md-5">
                                        <label class="col-form-label col-md-2" for="dob">Date of birth <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            {!! Form::date('dob', null, ['class'=>'form-control', 'id'=>'dob']) !!}
                                            @error('dob') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3 mb-md-5">
                                        <label class="col-form-label col-md-2" for="country_code">Country <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            {!! Form::select('country_code', $countries, null, ['class'=>'form-control', 'id'=>'country_code']) !!}
                                            @error('country_code') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3 mb-md-5">
                                        <label class="col-form-label col-md-2" for="place_of_birth">Place of birth</label>
                                        <div class="col-md-10">
                                            {!! Form::text('place_of_birth', null, ['class'=>'form-control', 'id'=>'place_of_birth']) !!}
                                            @error('place_of_birth') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3 mb-md-5">
                                        <label class="col-form-label col-md-2" for="state_id">State of origin <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            {!! Form::select('state_id', $states->pluck('name', 'id'), null, ['class'=>'form-control', 'id'=>'state_id']) !!}
                                            @error('state_id') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3 mb-md-5">
                                        <label class="col-form-label col-md-2" for="lga_id">Local Govt. of origin <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            {!! Form::select('lga_id', $lgas->pluck('name', 'id'), null, ['class'=>'form-control', 'id'=>'lga_id']) !!}
                                            @error('lga_id') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3 mb-md-5">
                                        <label class="col-form-label col-md-2" for="profile_picture">Upload Photo (Please take a selfie or upload any picture that captures your face) <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            {!! Form::file('profile_picture', null, ['class'=>'form-control', 'id'=>'profile_picture']) !!}
                                            @error('profile_picture') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                </div>
                            </fieldset>

                            <fieldset>
                                <legend>Next-of-kin</legend>

                                <div class="form-group row mb-3 mb-md-5">
                                    <label class="col-form-label col-md-2" for="nok_name">Name <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        {!! Form::text('nok_name', null, ['class'=>'form-control', 'id'=>'nok_name']) !!}
                                        @error('nok_name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-3 mb-md-5">
                                    <label class="col-form-label col-md-2" for="nok_dob">Date of birth <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        {!! Form::date('nok_dob', null, ['class'=>'form-control', 'id'=>'nok_dob']) !!}
                                        @error('nok_dob') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-3 mb-md-5">
                                    <label class="col-form-label col-md-2" for="nok_gender_id">Gender <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        {!! Form::select('nok_gender_id', $genders->pluck('name', 'id'), null, ['class'=>'form-control', 'id'=>'nok_gender_id']) !!}
                                        @error('nok_gender_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-3 mb-md-5">
                                    <label class="col-form-label col-md-2" for="relationship_with_nok">Relationship</label>
                                    <div class="col-md-10">
                                        {!! Form::text('relationship_with_nok', null, ['class'=>'form-control', 'id'=>'relationship_with_nok']) !!}
                                        @error('relationship_with_nok') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-3 mb-md-5">
                                    <label class="col-form-label col-md-2" for="nok_phone">Phone number <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        {!! Form::number('nok_phone', null, ['class'=>'form-control', 'id'=>'nok_phone']) !!}
                                        @error('nok_phone') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-3 mb-md-5">
                                    <label class="col-form-label col-md-2" for="nok_email">Email</label>
                                    <div class="col-md-10">
                                        {!! Form::text('nok_email', null, ['class'=>'form-control', 'id'=>'nok_email']) !!}
                                        @error('nok_email') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-3 mb-md-5">
                                    <label class="col-form-label col-md-2" for="nok_address">Contact Address</label>
                                    <div class="col-md-10">
                                        {!! Form::textarea('nok_address', null, ['class'=>'form-control', 'id'=>'nok_address']) !!}
                                        @error('nok_address') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                            </fieldset>

                            <fieldset>
                                <legend>Property Details</legend>

                                <div class="form-group row mb-3 mb-md-5">
                                    <label class="col-form-label col-md-2" for="estate_id">Estate <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        {!! Form::select('estate_id', $estates->pluck('name', 'id'), null, ['class'=>'form-control', 'id'=>'estate_id']) !!}
                                        @error('estate_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-3 mb-md-5">
                                    <label class="col-form-label col-md-2" for="propertyType_id">Which Property Type Are You Subscribing For <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        {!! Form::select('propertyType_id', $propertyTypes->pluck('name', 'id'), null, ['class'=>'form-control', 'id'=>'propertyType_id']) !!}
                                        @error('propertyType_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-3 mb-md-5">
                                    <label class="col-form-label col-md-2" for="payment_plan_id">Select your prefered Payment Plan <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        {!! Form::select('payment_plan_id', $paymentPlans->pluck('name', 'id'), null, ['class'=>'form-control', 'id'=>'payment_plan_id']) !!}
                                        @error('payment_plan_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-3 mb-md-5">
                                    <label class="col-form-label col-md-2" for="referrer">Who Referred You?</label>
                                    <div class="col-md-10">
                                        {!! Form::text('referrer', null, ['class'=>'form-control', 'id'=>'referrer']) !!}
                                        @error('referrer') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-3 mb-md-5">
                                    <label class="col-form-label col-md-2" for="signature">Signature (Please sign on a plain sheet, snap it and upload)</label>
                                    <div class="col-md-10">
                                        {!! Form::file('signature', null, ['class'=>'form-control', 'id'=>'signature']) !!}
                                        @error('signature') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-3 mb-md-5">
                                    <div class="col-md-3">
                                        <div class="d-grid grid-2">
                                            {!! Form::submit('Preview', ['class'=>'btn btn-primary', 'id'=>'submit']) !!}
                                        </div>
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

    <script src="//unpkg.com/alpinejs" defer></script>

    <script src="js/pages/advanced-form-element.js"></script>

    <script>
        $(document).ready(function () {
            $('#estate_id').on('change', function () {

                let estate_id = this.value;
                console.log(estate_id)

                $("#propertyType_id").html('');

                $.ajax({
                    url: "{{url('api/fetch-property-types')}}",
                    type: "POST",
                    data: {
                        estate_id: estate_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#propertyType_id').html('<option value="">Select Property Type</option>');
                        $.each(result.property_types, function (key, value) {
                            $("#propertyType_id").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        $('#payment_plan_id').html('<option value="">Select Payment Plan</option>');
                    }
                });
            });
            $('#propertyType_id').on('change', function () {
                let estate_id = document.getElementById('estate_id').value;
                let propertyType_id = this.value;

                $("#payment_plan_id").html('');

                $.ajax({
                    url: "{{url('api/fetch-payment-plan')}}",
                    type: "POST",
                    data: {
                        estate_id: estate_id,
                        propertyType_id: propertyType_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#payment_plan_id').html('<option value="">Select Payment Plan</option>');
                        $.each(res.payment_plans, function (key, value) {
                            $("#payment_plan_id").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
        });
    </script>

@endpush

@endsection
