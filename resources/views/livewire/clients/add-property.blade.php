<div>
        
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>{{ config('app.name', 'Real Estate App') }} - Add Property</h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">&nbsp</h5>
                </div>
                <div class="card-body">
                    <div class="example-container">
                        <div class="example-content">
                            
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    <a href="{{ route('clients.edit', $client) }}" class="btn btn-primary btn-lg" >Edit Profile</a>
                                </div>
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
            </div>


                            {{-- CLIENTS PROPERTIES  --}}

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">&nbsp</h5>
                </div>
                <div class="card-body">
                    <div class="example-container">
                        <div class="example-content">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="box-title text-info mb-0 mt-20"><i class="ti-home me-15"></i> Client's
                                        Properties
                                    </h4>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end  d-flex align-items-center">
                                    <a wire:click.prevent="addProperty" href="#" class="mt-4"> <span
                                            class="badge badge-success">Add Property</span> </a>
                                </div>
                            </div>
                            <hr class="my-15">

                            @foreach ($clientSubscribedProperties as $key => $clientSubscribedProperty)
                            <div class="row" style="margin-bottom: 25px">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Estate</label>
                                        <select wire:model.lazy="clientProperties.{{$key}}.estate_id" wire:change="onSelectEstate($event.target.value, {{$key}})" class="form-select form-control"
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
                                        <select wire:model.lazy="clientProperties.{{$key}}.property_type_id" wire:change="onSelectPropertyType($event.target.value, {{$key}})"
                                            class="form-select form-control" required>
                                            <option value="">Please select one</option>
                                            @foreach ($propertyTypes[$key] as $propertyType)
                                            <option value="{{ $propertyType['id'] }}">{{ $propertyType['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-label">Property</label>
                                        <select wire:model.lazy="clientProperties.{{$key}}.property_id"
                                            class="form-select form-control" required>
                                            <option value="">Please select one</option>
                                            @isset($properties[$key])
                                                @foreach ($properties[$key] as $property)
                                                <option value="{{ $property['id'] }}">{{ $property['unique_number'] }}</option>
                                                @endforeach
                                            @endisset
                                            
                                        </select>
                                        @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Payment Plan</label>
                                        <select wire:model.lazy="clientProperties.{{$key}}.payment_plan_id"
                                            class="form-select form-control" required>
                                            <option value="">Please select one</option>
                                            @foreach ($paymentPlans as $paymentPlan)
                                            <option value="{{ $paymentPlan->id }}">{{ $paymentPlan->name }}</option>
                                            @endforeach
                                        </select>
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

                            <div class="box-footer">
                                <a class="btn btn-warning me-1 btn-lg" href="{{ url()->previous() }}">Cancel</a>
                                <input type="submit" class="btn btn-primary btn-lg" value="Save">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
