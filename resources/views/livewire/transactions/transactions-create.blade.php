<div>
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h4 class="page-title">Ochacho Clients</h4>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('clients.index') }}">Client</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Make Payment
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
                        <div class="box-header with-border">
                            <h4 class="box-title">Make Payment</h4>
                        </div>
                        <div class="box-body">

                            <input type="hidden" wire:model="client_id" />
                            
                            <div class="form-group row">
                                <label class="col-form-label col-md-2" id="name">Name <span class="text-danger">*</span></label>
                                <div class="col-md-10">
                                    <input value="{{ $client->name }}" class="form-control" type="text" readonly>
                                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-form-label col-md-2" id="email">Email</label>
                                <div class="col-md-10">
                                    <input value="{{ $client->email }}" class="form-control" type="email" readonly>
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-form-label col-md-2" id="address">Property <span class="text-danger">*</span></label>
                                <div class="col-md-10">
                                    <select wire:model.lazy="property_id" class="form-control">
                                        <option value="">Please select one</option>
                                        @foreach ($client->properties as $property)
                                            <option value="{{ $property->id }}">
                                                
                                                {{ $property->estatePropertyType ? $property->estatePropertyType->propertyGroup ? $property->estatePropertyType->propertyGroup->name: null : null }} 

                                                [{{ $property->estatePropertyType ? $property->estatePropertyType->estate ? $property->estatePropertyType->estate->name: null : null }}]

                                                [{{ $property->unique_number }}]
                                            
                                            </option>
                                        @endforeach
                                        
                                    </select>
                                    @error('property_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-form-label col-md-2" id="amount">Amount <span class="text-danger">*</span></label>
                                <div class="col-md-10">
                                    <input wire:model="amount" class="form-control" type="number">
                                    @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-form-label col-md-2" id="amount">Date</label>
                                <div class="col-md-10">
                                    <input wire:model="date" class="form-control" type="date">
                                    @error('date') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

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
