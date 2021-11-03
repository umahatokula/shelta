<div>
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h4 class="page-title">{{ config('app.name', 'Real Estate App') }} Staff</h4>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page"><a
                                    href="{{ route('staff.index') }}">Staff</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Add Staff
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
                            <h4 class="box-title text-info mb-0"><i class="ti-user me-15"></i> Staff</h4>
                            <hr class="my-15">

                            <div class="form-group">
                                <label class="form-label" id="name">Name</label>
                                <input wire:model.lazy="name" class="form-control" type="text">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" id="phone">Phone</label>
                                <input wire:model.lazy="phone" class="form-control" type="number">
                                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" id="email">Email</label>
                                <input wire:model.lazy="email" class="form-control" type="email">
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" id="dob">Date of Birth</label>
                                <input wire:model.lazy="dob" class="form-control" type="date">
                                @error('dob') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
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
                            <input type="button" class="btn btn-warning me-1" value="Cancel">
                            <input type="submit" class="btn btn-primary" value="Save">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

</div>
