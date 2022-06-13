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
                    <div class="row">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6 d-flex justify-content-end">
                            @can('create staff')
                            <a href="{{ route('staff.create') }}" class="btn-lg btn btn-primary">Add Staff</a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="example-container">
                        <div class="example-content">

                            @can('view staffs')

                            <div>
                                @if (session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session('message') }}
                                    </div>
                                @endif
                            </div>

                            <div class="table-responsive-sm">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th class="text-left">Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($staffs as $staff)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-left">{{ $staff->name }}</td>
                                            <td>{{ $staff->phone }}</td>
                                            <td>{{ $staff->email }}</td>
                                            <td>
                                                @can('edit staff')
                                                <a href="{{ route('staff.edit', $staff) }}" class="text-warning p-0" data-original-title=""
                                                    title="Edit">
                                                    <span class="material-icons-outlined">
                                                        edit
                                                        </span>
                                                </a>
                                                @endcan

                                                @can('delete staff')
                                                <a wire:click="destroy({{ $staff->id }})" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"  href="#" class="text-danger p-0" data-original-title="" title="Delete">
                                                    <span class="material-icons-outlined">
                                                        delete
                                                        </span>
                                                </a>
                                                    @endcan
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                            <div class="row mt-5">
                                <div class="col-12 d-flex justify-content-center">
                                    {{ $staffs->links() }}
                                </div>
                            </div>

                            @endcan

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
