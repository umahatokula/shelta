<div>
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>{{ config('app.name', 'Real Estate App') }} - Add Property Type</h1>
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
                            @can('create property type')
                            <form wire:submit.prevent="save">

                                <div class="box-body">
                                    <h4 class="box-title text-info mb-0"><i class="ti-user me-15"></i> Property Type</h4>
                                    <hr class="my-15">

                                    <div class="form-group mb-5">
                                        <label class="form-label">Name</label>
                                        <input wire:model.lazy="name" class="form-control" type="text">
                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="form-group mb-5">
                                        <label class="form-label">Description</label>
                                        <textarea wire:model.lazy="description" class="form-control" rows="8"></textarea>
                                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="row mb-5">
                                        <div class="col-md-6">
                                            <h4 class="box-title text-info mb-0 mt-20"><i class="ti-save me-15"></i> Photos
                                            </h4>
                                        </div>
                                        <div class="col-md-6 d-flex justify-content-end  d-flex align-items-center">

                                        </div>
                                    </div>
                                    <hr class="my-15">

                                    <div class="form-group mb-5">
                                        <label class="form-label">Photos</label>

                                        <input type="file" wire:model="photos" multiple>

                                        @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>


                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <input type="submit" class="btn btn-lg btn-warning me-1" value="Cancel">
                                    <input type="submit" class="btn btn-lg btn-primary" value="Save">
                                </div>
                            </form>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
