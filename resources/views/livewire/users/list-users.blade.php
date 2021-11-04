<div>
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h4 class="page-title">{{ config('app.name', 'Real Estate App') }} Users</h4>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <Link :href="route('home')">
                                    <i class="mdi mdi-home-outline"></i>
                                </Link>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Users</li>
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
                <div class="box">
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6 d-flex justify-content-end">
                                <a href="{{ route('users.create') }}" class="btn btn-primary">Add Users</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

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
                                        <th>Role(s)</th>
                                        <th>Actions</th>
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
                                            <a href="{{ route('users.edit', $user) }}" class="text-warning p-0" data-original-title=""
                                                title="Edit">
                                            <i class="fa fa-pencil font-medium-3 mr-2"></i>
                                            </a>
                                            <a wire:click="destroy({{ $user->id }})" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"  href="#" class="text-danger p-0" data-original-title="" title="Delete">
                                            <i class="fa fa-trash-o font-medium-3 mr-2"></i>
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

    </section>
</div>
