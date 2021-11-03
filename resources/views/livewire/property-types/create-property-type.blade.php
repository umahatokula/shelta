<div>
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h4 class="page-title">{{ config('app.name', 'Real Estate App') }} Property Types</h4>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page"><a
                                    href="{{ route('estates.index') }}">Property Types</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Add Property Type
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
                            <h4 class="box-title text-info mb-0"><i class="ti-user me-15"></i> Property Type</h4>
                            <hr class="my-15">
                            
                            <div class="form-group">
                                <label class="form-label">Name</label>
                                <input wire:model.lazy="name" class="form-control" type="text">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <textarea wire:model.lazy="description" class="form-control""></textarea>
                                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="box-title text-info mb-0 mt-20"><i class="ti-save me-15"></i> Photos
                                    </h4>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end  d-flex align-items-center">
                                    
                                </div>
                            </div>
                            <hr class="my-15">
                    
                            <div class="form-group">
                                <label class="form-label">Photos</label>
                                                            
                                <input type="file" wire:model="photos" multiple>
                            
                                @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>


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
