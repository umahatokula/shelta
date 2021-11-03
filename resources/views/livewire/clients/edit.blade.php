<div>
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h4 class="page-title">{{ config('app.name', 'Real Estate App') }} Clients</h4>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page"><a
                                    href="{{ route('clients.index') }}">Clients</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Add Clients
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">

                <div>
                    @if (session()->has('message'))
                    <div class="alert alert-danger tada ">
                        {{ session('message') }}
                    </div>
                    @endif
                </div>

                <div class="box">
                    <form wire:submit.prevent="save">

                        <div class="box-body">
                            <h4 class="box-title text-info mb-0"><i class="ti-user me-15"></i> Client's Details</h4>
                            <hr class="my-15">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="" id="sname">Surname Name <span class="text-danger">*</span></label>
                                        <input wire:model.lazy="sname" class="form-control" type="text">
                                        @error('sname') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="" id="onames">Other Names <span
                                                class="text-danger">*</span></label>
                                        <input wire:model.lazy="onames" class="form-control" type="text">
                                        @error('onames') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="" id="phone">Phone Number <span class="text-danger">*</span></label>
                                        <input wire:model.lazy="phone" class="form-control" type="text">
                                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class="" id="email">Email</label>
                                        <input wire:model.lazy="email" class="form-control" type="text">
                                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="" id="gender">Gender <span
                                                class="text-danger">*</span></label>
                                        <select wire:model.lazy="gender" class="form-control">
                                            <option value="">Select one</option>
                                            @foreach ($genders as $gender)
                                                <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('gender') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class="" id="dob">Date of birth</label>
                                        <input wire:model.lazy="dob" class="form-control" type="date">
                                        @error('dob') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class="" id="city">City</label>
                                        <input wire:model.lazy="city" class="form-control" type="text">
                                        @error('city') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="" id="state_id">State </label>
                                        <select wire:model.lazy="state_id" class="form-control">
                                            <option value="">Select one</option>
                                            @foreach ($states as $state)
                                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('state_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label class="" id="address">Address</label>
                                        <textarea wire:model.lazy="address" class="form-control" type="text"></textarea>
                                        @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>


                            {{-- NEXT OF KIN  --}}

                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="box-title text-info mb-0 mt-20"><i class="ti-home me-15"></i> Next-of-Kin Information
                                    </h4>
                                </div>
                            </div>
                            <hr class="my-15">

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class="" id="nok_name">Next of kin Name</label>
                                        <input wire:model.lazy="nok_name" class="form-control" type="text">
                                        @error('nok_name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="" id="relationship_with_nok">Relationship with Next of kin </label>
                                        <input wire:model.lazy="relationship_with_nok" class="form-control" type="text">
                                        @error('relationship_with_nok') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class="" id="nok_city">Next of kin City</label>
                                        <input wire:model.lazy="nok_city" class="form-control" type="text">
                                        @error('nok_city') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="" id="nok_state_id">Next of kin State </label>
                                        <select wire:model.lazy="nok_state_id" class="form-control">
                                            <option value="">Select one</option>
                                            @foreach ($states as $state)
                                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('nok_state_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label class="" id="nok_address">Next of kin Address</label>
                                        <textarea wire:model.lazy="nok_address" class="form-control" type="text"></textarea>
                                        @error('nok_address') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                            </div>


                            {{-- EMPLOYERS INFO  --}}

                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="box-title text-info mb-0 mt-20"><i class="ti-home me-15"></i> Employer's Information
                                    </h4>
                                </div>
                            </div>
                            <hr class="my-15">

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class="" id="employer_name">Employer Name</label>
                                        <input wire:model.lazy="employer_name" class="form-control" type="text">
                                        @error('employer_name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="" id="employer_phone">Employer Phone</label>
                                        <input wire:model.lazy="employer_phone" class="form-control" type="text">
                                        @error('employer_phone') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class="" id="employer_city">Employer City</label>
                                        <input wire:model.lazy="employer_city" class="form-control" type="text">
                                        @error('employer_city') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="" id="employer_state_id">Employer State</label>
                                        <select wire:model.lazy="employer_state_id" class="form-control">
                                            <option value="">Select one</option>
                                            @foreach ($states as $state)
                                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('employer_state_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class="" id="employer_country_id">Employer Country</label>
                                        <select wire:model.lazy="employer_country_id" class="form-control select2">
                                            <option value="">Select one</option>
                                            @foreach ($countries as $code =>  $country)
                                                <option value="{{ $code }}">{{ $country }}</option>
                                            @endforeach
                                        </select>
                                        @error('employer_country_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="" id="employer_address">Employer Address</label>
                                        <textarea wire:model.lazy="employer_address" class="form-control"></textarea>
                                        @error('employer_address') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>



                            {{-- CLIENTS PROPERTIES  --}}

                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="box-title text-info mb-0 mt-20"><i class="ti-home me-15"></i> Client's
                                        Properties
                                    </h4>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end  d-flex align-items-center">
                                    <a wire:click.prevent="addProperty" href="#" class="mt-4"> <span
                                            class="badge badge-success">Add Property Type</span> </a>
                                </div>
                            </div>
                            <hr class="my-15">

                            @foreach ($properties as $key => $property)

                            <div class="row mb-5">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Estate</label>
                                        <select wire:model.lazy="clientProperties.{{$key}}.estate_id"wire:change="getPropertyTypes($event.target.value)" class="form-select"
                                            required>
                                            <option value="">Please select one</option>
                                            @foreach ($estates as $estate)
                                            <option value="{{ $estate->id }}">{{ $estate->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Property Type</label>
                                        <select wire:model.lazy="clientProperties.{{$key}}.property_type_id"
                                            class="form-select" required>
                                            <option value="">Please select one</option>
                                            @foreach ($propertyTypes as $propertyType)
                                            <option value="{{ $propertyType->id }}">{{ $propertyType->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Payment Plan</label>
                                        <select wire:model.lazy="clientProperties.{{$key}}.payment_plan_id"
                                            class="form-select" required>
                                            <option value="">Please select one</option>
                                            @foreach ($paymentPlans as $paymentPlan)
                                            <option value="{{ $paymentPlan->id }}">{{ $paymentPlan->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-label">Property Number</label>
                                        <input wire:model.lazy="clientProperties.{{$key}}.unique_number"
                                            class="form-control" type="text" required>
                                        @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-1 pt-4 d-flex justify-content-end align-items-center">
                                    <div class="form-group">
                                        <a wire:click.prevent="removeProperty({{ $key }})" href="#" class="text-white">
                                            <span class="badge badge-danger">Remove</span> </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <input type="submit" class="btn btn-warning me-1" value="Cancel">
                            <input type="submit" class="btn btn-primary" value="Save">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

</div>
