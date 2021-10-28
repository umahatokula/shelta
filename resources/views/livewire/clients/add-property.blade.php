<div>
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h4 class="page-title">Ochacho Clients</h4>
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
                                <div class="col-12">
                                    
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
