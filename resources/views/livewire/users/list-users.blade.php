<div>
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>{{ config('app.name', 'Real Estate App') }} - Add Users</h1>
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
                            <a href="{{ route('users.create') }}" class="btn-lg btn btn-primary">Add/Edit Users</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="example-container">
                        <div class="example-content">

                            <div>
                                @if (session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session('message') }}
                                    </div>
                                @endif
                            </div>

                            <div class="table-responsive-sm">

                                @if ($users->isNotEmpty())
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th class="text-left">Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Role(s)</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-left">{{ $user->name }}</td>
                                            <td>
                                                @if ($user->staff)
                                                {{ $user->staff->phone ?? '' }}
                                                @else
                                                {{ $user->client ? $user->client->phone : '' }}
                                                @endif
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @foreach($user->roles as $role)
                                                    {{ $role->name }} <br>
                                                @endforeach
                                            </td>
                                            <td class="text-center">
{{--                                                <a href="{{ route('users.edit', $user) }}" class="text-warning p-0" data-original-title=""--}}
{{--                                                    title="Edit">--}}
{{--                                                    <span class="material-icons-outlined">--}}
{{--                                                        edit--}}
{{--                                                        </span>--}}
{{--                                                </a>--}}
                                                <a wire:click="destroy({{ $user->id }})" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"  href="#" class="text-danger p-0" data-original-title="" title="Delete">
                                                    <span class="material-icons-outlined">
                                                        delete
                                                        </span>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                                {{ $users->links() }}

                                @else
                                <p>No users</p>
                                @endif


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
