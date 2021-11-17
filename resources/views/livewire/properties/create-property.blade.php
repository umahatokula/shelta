<div>
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h4 class="page-title">{{ config('app.name', 'Real Estate App') }} Property</h4>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page"><a
                                    href="{{ route('clients.index') }}">property</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Add property
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

                <div class="box">
                    <form wire:submit.prevent="save">

                        <div class="box-header">
                            <h4 class="box-title">Add Property</h4>
                        </div>
                        <div class="box-body">

                            <div class="form-group row">
                                <label class="col-form-label col-md-3">Property Number</label>
                                <div class="col-md-9">
                                    <input wire:model.lazy="unique_number" class="form-control" type="text">
                                    @error('unique_number') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group row">
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

                            <div class="form-group row">
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
                            <a class="btn btn-warning me-1" href="{{ url()->previous() }}">Cancel</a>
                            <input type="submit" class="btn btn-primary" value="Save">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

</div>
