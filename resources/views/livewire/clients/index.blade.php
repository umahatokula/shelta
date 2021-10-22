<div>
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h4 class="page-title">Ochacho Clients</h4>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <Link :href="route('home')">
                                    <i class="mdi mdi-home-outline"></i>
                                </Link>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Clients</li>
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
                                <a href="{{ route('clients.create') }}" class="btn btn-primary">Add Client</a>
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
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-left">Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $client)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-left">{{ $client->name }}</td>
                                        <td>{{ $client->email }}</td>
                                        <td>{{ $client->phone }}</td>
                                        <td>
                                            <a href="{{ route('clients.show', $client) }}" class="text-primary p-0" data-original-title="View"
                                                title="View">
                                            <i class="fa fa-eye font-medium-3 mr-2"></i>
                                            </a>
                                            <a href="{{ route('clients.edit', $client) }}" class="text-warning p-0" data-original-title=""
                                                title="Edit">
                                            <i class="fa fa-pencil font-medium-3 mr-2"></i>
                                            </a>
                                            <a wire:click.prevent="destroy({{ $client->id }})" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" href="#" class="text-danger p-0"
                                                data-original-title="" title="Delete">
                                            <i class="fa fa-trash-o font-medium-3 mr-2"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>

                            {{ $clients->links() }}

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
