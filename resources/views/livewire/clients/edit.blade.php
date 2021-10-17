<div>
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
                                    Add Client
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

                            <input type="hidden" value="{{ $client_id }}" name="client_id" />
                            <div class="box-header with-border">
                                <h4 class="box-title">Edit Client</h4>
                            </div>
                            <div class="box-body">
                                
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2" id="name">Name <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input wire:model.lazy="name" class="form-control" type="text">
                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2" id="phone">Phone Number <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input wire:model.lazy="phone" class="form-control" type="text">
                                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2" id="email">Email</label>
                                    <div class="col-md-10">
                                        <input wire:model.lazy="email" class="form-control" type="email">
                                        @error('email') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2" id="address">Address</label>
                                    <div class="col-md-10">
                                        <textarea wire:model.lazy="address" class="form-control"></textarea>
                                        @error('address') <span class="error">{{ $message }}</span> @enderror
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
    
</div>
