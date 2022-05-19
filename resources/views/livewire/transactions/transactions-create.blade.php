<div>
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>{{ config('app.name', 'Real Estate App') }} - Record Payment</h1>
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

                            <div class="alert alert-info">
                                Please not that the system runs a 28 day payment cycle. Any date on or after 28th defaults to 28th. Eg, if a client's first instalment is Jan 31, the system automatically records it as Jan 28.
                            </div>

                            <form wire:submit.prevent="save">
                                <div class="box-header with-border">
                                    <h4 class="box-title">&nbsp</h4>
                                </div>
                                <div class="box-body">

                                    <input type="hidden" wire:model="client_id" />

                                    <div class="form-group row mb-5">
                                        <label class="col-form-label col-md-2" id="sname">Surname Name <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input value="{{ $client->sname }}" class="form-control" type="text" readonly>
                                            @error('sname') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-5">
                                        <label class="col-form-label col-md-2" id="onames">Other Names <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input value="{{ $client->onames }}" class="form-control" type="text" readonly>
                                            @error('onames') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-5">
                                        <label class="col-form-label col-md-2" id="email">Email</label>
                                        <div class="col-md-10">
                                            <input value="{{ $client->email }}" class="form-control" type="email" readonly>
                                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-5">
                                        <label class="col-form-label col-md-2" id="address">Property <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <select wire:model.lazy="property_id" wire:change="onSelectProperty($event.target.value)" class="form-control">
                                                <option value="">Please select one</option>
                                                @foreach ($client->properties as $property)
                                                    <option value="{{ $property->id }}">

                                                        {{ $property->estatePropertyType ? $property->estatePropertyType->propertyType ? $property->estatePropertyType->propertyType->name: null : null }}

                                                        [{{ $property->estatePropertyType ? $property->estatePropertyType->estate ? $property->estatePropertyType->estate->name: null : null }}]

                                                        [{{ $property->unique_number }}]

                                                    </option>
                                                @endforeach

                                            </select>
                                            @error('property_id') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-5">
                                        <label class="col-form-label col-md-2" id="amount">Amount <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input wire:model="amount" class="form-control" type="number" max="{{ $propertybalance }}" {{ $propertybalance == 0 ? 'disabled' : '' }}>
                                            <span class="d-block"><small>Max: {{ $propertybalance }}</small></span>
                                            @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

{{--                                    <div class="form-group row mb-5">--}}
{{--                                        <label class="col-form-label col-md-2" id="date">Transaction Date <span class="text-danger">*</span></label>--}}
{{--                                        <div class="col-md-10">--}}
{{--                                            <input wire:model="date" class="form-control" type="date">--}}
{{--                                            @error('date') <span class="text-danger">{{ $message }}</span> @enderror--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                    <div class="form-group row mb-5">
                                        <label class="col-form-label col-md-2" id="instalment_date">Instalment Date </label>
                                        <div class="col-md-10">
                                            <input wire:model="instalment_date" class="form-control" type="date">
                                            @error('instalment_date') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-5">
                                        <label class="col-form-label col-md-2" id="proof_reference_number">Proof of payment Ref.<span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input wire:model="proof_reference_number" class="form-control" type="text">
                                            @error('proof_reference_number') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-5">
                                        <label class="col-form-label col-md-2" id="proof">Proof of payment <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input wire:model="proof" class="form-control" type="file">
                                            @error('proof') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <input type="submit" class="btn-lg btn btn-warning me-1" value="Cancel">
                                    <input type="submit" class="btn-lg btn btn-primary" value="Save">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
