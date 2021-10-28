<div>
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h4 class="page-title">Ochacho User</h4>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page"><a
                                    href="{{ route('users.index') }}">User</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Add User
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
            <div class="col-6">

                <div>
                    @if (session()->has('message'))
                        <div class="alert alert-danger tada ">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
                
                <div class="box">
                    <form wire:submit.prevent="saveStaff">

                        <div class="box-body">
                            <h4 class="box-title text-info mb-0"><i class="ti-user me-15"></i> Staff</h4>
                            <hr class="my-15">

                            <div class="form-group">
                                <label class="form-label" id="staff_id">Staff</label>
                                <select wire:model.lazy="staff_id"
                                    class="form-select">
                                    <option value="">Please select one</option>
                                    @foreach ($staffs as $staff)
                                    <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                                    @endforeach
                                </select>
                                @error('staff_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" id="staff_password">Password</label>
                                <input wire:model.lazy="staff_password" class="form-control" type="password">
                                @error('staff_password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" id="staff_password_confirmation">Confirm Password</label>
                                <input wire:model.lazy="staff_password_confirmation" class="form-control" type="password">
                                @error('staff_password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
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
            <div class="col-6">

                <div>
                    @if (session()->has('message'))
                        <div class="alert alert-danger tada ">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
                
                <div class="box">
                    <form wire:submit.prevent="saveClient">

                        <div class="box-body">
                            <h4 class="box-title text-info mb-0"><i class="ti-user me-15"></i> Client</h4>
                            <hr class="my-15">

                            <div class="form-group">
                                <label class="form-label" id="client_id">Client</label>
                                <select wire:model.lazy="client_id"
                                    class="form-select select2">
                                    <option value="">Please select one</option>
                                    @foreach ($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->onames }} {{ $client->sname }}</option>
                                    @endforeach
                                </select>
                                @error('client_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" id="client_password">Password</label>
                                <input wire:model.lazy="client_password" class="form-control" type="password">
                                @error('client_password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" id="client_password_confirmation">Confirm Password</label>
                                <input wire:model.lazy="client_password_confirmation" class="form-control" type="password">
                                @error('client_password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
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
