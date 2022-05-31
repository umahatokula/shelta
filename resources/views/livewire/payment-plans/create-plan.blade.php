<div>
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>{{ config('app.name', 'Real Estate App') }} - Add Payment Plan</h1>
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
                            @can('create payment plan')
                            <form wire:submit.prevent="save">

                                <div class="box-body">
                                    <h4 class="box-title text-info mb-0"><i class="ti-user me-15"></i> Payment Plan</h4>
                                    <hr class="my-15">

                                    <div class="form-group mb-5">
                                        <label class="form-label">Name</label>
                                        <input wire:model.lazy="name" class="form-control" type="text">
                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="form-group mb-5">
                                        <label class="form-label">Number of months</label>
                                        <input wire:model.lazy="number_of_months" class="form-control" type="number">
                                        @error('number_of_months') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <a class="btn-lg btn btn-warning me-1" href="{{ url()->previous() }}">Cancel</a>
                                    <input type="submit" class="btn-lg btn btn-primary" value="Save">
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
