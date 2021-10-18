<div>
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h4 class="page-title">Ochacho Estates</h4>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page"><a
                                    href="{{ route('estates.index') }}">Estates</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Add Estate
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
                            <h4 class="box-title text-info mb-0"><i class="ti-user me-15"></i> Estate Details</h4>
                            <hr class="my-15">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="form-label">Name</label>
                                        <input wire:model.lazy="name" class="form-control" type="text">
                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="form-label">Address</label>
                                        <input wire:model.lazy="address" class="form-control" type="text">
                                        @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="box-title text-info mb-0 mt-20"><i class="ti-save me-15"></i> Properties
                                    </h4>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end  d-flex align-items-center">
                                    <a wire:click.prevent="addProperty" href="#" class="mt-4"> <span class="badge badge-success">Add Property Type</span> </a>
                                </div>
                            </div>
                            <hr class="my-15">

                            @foreach ($properties as $key => $property)
                            <div class="row mb-5">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="form-label">Property Type</label>
                                        <select wire:model.lazy="addedProperties.{{$key}}.property_id"
                                            class="form-select" required>
                                            <option value="">Please select one</option>
                                            @foreach ($propertyTypes as $propertyType)
                                            <option value="{{ $propertyType->id }}">{{ $propertyType->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="form-label">Price</label>
                                        <input wire:model.lazy="addedProperties.{{$key}}.price" class="form-control"
                                            type="text" required>
                                        @error('price') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 pt-4 d-flex justify-content-end align-items-center">
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
                            <button type="button" class="btn btn-warning me-1">
                                <i class="ti-trash"></i> Cancel
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="ti-save-alt"></i> Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

</div>
