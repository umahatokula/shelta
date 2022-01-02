<div>
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>{{ config('app.name', 'Real Estate App') }} - Update Settings</h1>
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
                                    <h4 class="box-title text-info mb-0"><i class="ti-user me-15"></i> Settings</h4>
                                    <hr class="my-15">
                                    
                                    <div class="form-group mb-5">
                                        <label class="form-label" id="company_name">Company Name</label>
                                        <input wire:model.lazy="company_name" class="form-control" type="text">
                                        @error('company_name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <div class="form-group mb-5">
                                        <label class="form-label" id="company_phone">Company Phone number</label>
                                        <input wire:model.lazy="company_phone" class="form-control" type="number">
                                        @error('company_phone') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <div class="form-group mb-5">
                                        <label class="form-label" id="company_email">Company Email</label>
                                        <input wire:model.lazy="company_email" class="form-control" type="text">
                                        @error('company_email') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <div class="form-group mb-5">
                                        <label class="form-label" id="company_address">Company Address</label>
                                        <input wire:model.lazy="company_address" class="form-control" type="text">
                                        @error('company_address') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <div class="form-group mb-5">
                                        <label class="form-label" id="company_website">Company Website</label>
                                        <input wire:model.lazy="company_website" class="form-control" type="text">
                                        @error('company_website') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <div class="form-group mb-5">
                                        <label class="form-label" id="logo_light">Company Logo (Light)</label>
                                        <input wire:model.lazy="logo_light" class="form-control" type="file">
                                        @error('logo_light') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <div class="form-group mb-5">
                                        <label class="form-label" id="logo_dark">Company Logo (Dark)</label>
                                        <input wire:model.lazy="logo_dark" class="form-control" type="file">
                                        @error('logo_dark') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
        
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="cancel" class="btn btn-warning me-1">
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
            </div>
        </div>
    </div>

</div>
