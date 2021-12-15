<div>
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>{{ config('app.name', 'Real Estate App') }} - Add User</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">&nbsp</h5>
                </div>

                <div>
                    @if (session()->has('message'))
                    <div class="alert alert-danger tada ">
                        {{ session('message') }}
                    </div>
                    @endif
                </div>

                <div class="row">
                    <div class="col-md-6">

                        <div class="card-body">
                            <div class="example-container">
                                <div class="example-content">
                                    <div class="box">
                                        <form wire:submit.prevent="saveStaff">

                                            <div class="box-body">
                                                <h4 class="box-title text-info mb-0"><i class="ti-user me-15"></i> Staff
                                                </h4>
                                                <hr class="my-15">

                                                <div class="form-group mb-5">
                                                    <label class="form-label" id="staff_id">Staff</label>
                                                    <select wire:model.lazy="staff_id" class="form-select form-control">
                                                        <option value="">Please select one</option>
                                                        @foreach ($staffs as $staff)
                                                        <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('staff_id') <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form- mb-5">
                                                    <label class="form-label" id="staff_password">Password</label>
                                                    <input wire:model.lazy="staff_password" class="form-control"
                                                        type="password">
                                                    @error('staff_password') <span
                                                        class="text-danger">{{ $message }}</span> @enderror
                                                </div>

                                                <div class="form-group mb-5">
                                                    <label class="form-label" id="staff_password_confirmation">Confirm
                                                        Password</label>
                                                    <input wire:model.lazy="staff_password_confirmation"
                                                        class="form-control" type="password">
                                                    @error('staff_password_confirmation') <span
                                                        class="text-danger">{{ $message }}</span> @enderror
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

                    <div class="col-md-6">

                        <div class="card-body">
                            <div class="example-container">
                                <div class="example-content">
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
                                                <h4 class="box-title text-info mb-0"><i class="ti-user me-15"></i>
                                                    Client</h4>
                                                <hr class="my-15">

                                                <div class="form-group mb-5">
                                                    <label class="form-label" id="client_id">Client</label>
                                                    <select wire:model.lazy="client_id"
                                                        class="form-select select2  form-control">
                                                        <option value="">Please select one</option>
                                                        @foreach ($clients as $client)
                                                        <option value="{{ $client->id }}">{{ $client->onames }}
                                                            {{ $client->sname }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('client_id') <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group mb-5">
                                                    <label class="form-label" id="client_password">Password</label>
                                                    <input wire:model.lazy="client_password" class="form-control"
                                                        type="password">
                                                    @error('client_password') <span
                                                        class="text-danger">{{ $message }}</span> @enderror
                                                </div>

                                                <div class="form-group mb-5">
                                                    <label class="form-label" id="client_password_confirmation">Confirm
                                                        Password</label>
                                                    <input wire:model.lazy="client_password_confirmation"
                                                        class="form-control" type="password">
                                                    @error('client_password_confirmation') <span
                                                        class="text-danger">{{ $message }}</span> @enderror
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
        </div>
    </div>

</div>
