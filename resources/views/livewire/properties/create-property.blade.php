<div>
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>{{ config('app.name', 'Real Estate App') }} - Add Property</h1>
                <span>Description</span>
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
                            <form wire:submit.prevent="save">
        
                                <div class="box-header">
                                    <h4 class="box-title">Add Property</h4>
                                </div>
                                <div class="box-body">
        
                                    <div class="form-group row mb-5">
                                        <label class="col-form-label col-md-3">Property Number</label>
                                        <div class="col-md-9">
                                            <input wire:model.lazy="unique_number" class="form-control" type="text">
                                            @error('unique_number') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
        
                                    <div class="form-group row mb-5">
                                        <label class="col-form-label col-md-3">Estate</label>
                                        <div class="col-md-9">
                                            <select wire:model.lazy="estate_id"
                                                wire:change="getPropertyTypes($event.target.value)" class="form-control">
                                                <option value="">Select one</option>
                                                @foreach ($estates as $estate)
                                                <option value="{{ $estate->id }}">{{ $estate->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('estate_id') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
        
                                    <div class="form-group row mb-5">
                                        <label class="col-form-label col-md-3">Property Type</label>
                                        <div class="col-md-9">
                                            <select wire:model.lazy="property_type_id"
                                                wire:change="getEstatePropertyTypeBinding($event.target.value)"
                                                class="form-control">
                                                <option value="">Select one</option>
                                                @foreach ($propertyTypes as $propertyType)
                                                <option value="{{ $propertyType->id }}">{{ $propertyType->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('property_type_id') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
        
                                </div>
                                <div class="box-footer">
                                    <a class="btn-lg btn btn-warning me-1" href="{{ url()->previous() }}">Cancel</a>
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
