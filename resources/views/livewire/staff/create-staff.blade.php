<div>
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>{{ config('app.name', 'Real Estate App') }} - Add Staff</h1>
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
                                    <h4 class="box-title text-info mb-0"><i class="ti-user me-15"></i> Staff</h4>
                                    <hr class="my-15">
        
                                    <div class="form-group mb-5">
                                        <label class="form-label" id="name">Name</label>
                                        <input wire:model.lazy="name" class="form-control" type="text">
                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
        
                                    <div class="form-group mb-5">
                                        <label class="form-label" id="phone">Phone</label>
                                        <input wire:model.lazy="phone" class="form-control" type="number">
                                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
        
                                    <div class="form-group mb-5">
                                        <label class="form-label" id="email">Email</label>
                                        <input wire:model.lazy="email" class="form-control" type="email">
                                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
        
                                    <div class="form-group mb-5">
                                        <label class="form-label" id="dob">Date of Birth</label>
                                        <input wire:model.lazy="dob" class="form-control" type="date">
                                        @error('dob') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
        
                                    <div class="form-group mb-5">
                                        <label class="form-label" id="gender_id">Gender</label>
                                        <select wire:model.lazy="gender_id"
                                            class="form-select" required>
                                            <option value="">Please select one</option>
                                            @foreach ($genders as $gender)
                                            <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('gender_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
        
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
