<div>
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>{{ config('app.name', 'Real Estate App') }} Clients</h1>
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
                            <a href="{{ route('clients.create') }}" class="btn btn-primary btn-lg">Add Client</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    @if (session()->has('message'))
                    <div class="col-lg-12">
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    </div>
                    @endif

                    <div class="example-container">
                        <div class="example-content">
                            
                        <div class="table-responsive-sm">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-left">Surname Name</th>
                                        <th class="text-left">Other Names</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $client)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-left">{{ $client->sname }}</td>
                                        <td class="text-left">{{ $client->onames }}</td>
                                        <td>{{ $client->email }}</td>
                                        <td>{{ $client->phone }}</td>
                                        <td>
                                            <a href="{{ route('clients.show', $client) }}" class="text-primary p-0" data-original-title="View"
                                                title="View">
                                                <span class="material-icons-outlined">
                                                    visibility
                                                    </span>
                                            </a>
                                            <a href="{{ route('clients.edit', $client) }}" class="text-warning p-0" data-original-title=""
                                                title="Edit">
                                                <span class="material-icons-outlined">
                                                    edit
                                                    </span>
                                            </a>
                                            <a wire:click.prevent="destroy({{ $client->id }})" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" href="#" class="text-danger p-0"
                                                data-original-title="" title="Delete">
                                                <span class="material-icons-outlined">
                                                    delete
                                                    </span>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                        <div class="row my-5">
                          <div class="col-12 d-flex justify-content-center">

                            {{ $clients->links() }}
                          </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
