<div>
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>{{ config('app.name', 'Real Estate App') }} - Edit Property Price</h1>
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
                                    <h4 class="box-title text-info mb-0"><i class="ti-user me-15"></i> Property Price</h4>
                                    <hr class="my-15">

                                    <div class="form-group mb-5">
                                        <label class="form-label">Price</label>
                                        <input wire:model.lazy="price" class="form-control" type="number" autofocus>
                                        @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <a class="btn-lg btn btn-warning me-1" href="{{ url()->previous() }}">Cancel</a>
                                    <input type="submit" class="btn-lg btn btn-primary" value="Edit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
