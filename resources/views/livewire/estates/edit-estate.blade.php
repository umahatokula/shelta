<div>
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>{{ config('app.name', 'Real Estate App') }} - Edit Estate</h1>
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
        
                                <div class="box-body">
                                    
                                    <h4 class="box-title text-info mb-0"><i class="ti-user me-15"></i> Estate Details</h4>
                                    <hr class="my-15">
                                    <div class="row">
                                        <div class="col-md-6 mb-5">
                                            <div class="form-group">
                                                <label class="form-label">Name</label>
                                                <input wire:model.lazy="name" class="form-control" type="text">
                                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-5">
                                            <div class="form-group">
                                                <label class="form-label">Address</label>
                                                <input wire:model.lazy="address" class="form-control" type="text">
                                                @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="row">
                                        <div class="col-md-6 mb-5">
                                            <h4 class="box-title text-info mb-0 mt-20"><i class="ti-save me-15"></i> Properties
                                            </h4>
                                        </div>
                                        <div class="col-md-6 mb-5 d-flex justify-content-end  d-flex align-items-center">
                                            <a wire:click.prevent="addProperty" href="#" class="mt-4"> <span class="badge badge-success">Add Property Type</span> </a>
                                        </div>
                                    </div>
                                    <hr class="my-15">
        
                                    @if ($errors->any())
                                        <div class="alert alert-danger" role="alert">
                                            Ensure there are no duplicate selections for Property Type
                                        </div>
                                    @endif 
        
                                    @foreach ($this->properties as $key => $property)
                                    <div class="row">
                                        <div class="col-md-3 mb-5">
                                            <div class="form-group">
                                                <label class="form-label">Property Type</label>
                                                <select wire:model.lazy="addedProperties.{{$key}}.property_id"
                                                    class="form-select form-control" required>
                                                    <option value="">Please select one</option>
                                                    @foreach ($propertyTypes as $propertyType)
                                                    <option value="{{ $propertyType->id }}">{{ $propertyType->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-5">
                                            <div class="form-group">
                                                <label class="form-label">Price</label>
                                                <input wire:model.lazy="addedProperties.{{$key}}.price" class="form-control"
                                                    type="number" required>
                                                @error('price') <span class="error">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-5">
                                            <div class="form-group">
                                                <label class="form-label">Number of Units</label>
                                                <input wire:model.lazy="addedProperties.{{$key}}.number_of_units" class="form-control"
                                                    type="number" required>
                                                @error('number_of_units') <span class="error">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-5 pt-4 d-flex justify-content-end align-items-center">
                                            <div class="form-group">
                                                <a wire:click.prevent="removeProperty({{ $key }})" href="#"
                                                    class="text-white"> <span class="badge badge-danger">Remove</span> </a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
        
                                </div>
                                <!-- /.box-body -->
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
