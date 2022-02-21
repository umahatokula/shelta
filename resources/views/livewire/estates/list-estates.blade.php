<div>
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>{{ config('app.name', 'Real Estate App') }} - Estates</h1>
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
                            <a href="{{ route('estates.create') }}" class="btn-lg btn btn-primary">Add Estate</a>
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
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th class="text-left">Name</th>
                                            <th>Address</th>
                                            <th>Property Types</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($estates as $estate)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-left">{{ $estate->name }}</td>
                                            <td>{{ $estate->address }}</td>
                                            <td>
                                                <ul class="list-unstyled">
                                                    @foreach ($estate->propertyTypes as $propertyType)
                                                        <li><a href="{{ route('property-types.show', $propertyType) }}">{{ ucfirst(strtolower($propertyType->name)) }}</a></li>
                                                    @endforeach     
                                                </ul>   
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('estates.edit', $estate) }}" class="text-warning p-0" data-original-title=""
                                                    title="Edit">
                                                    <span class="material-icons-outlined">
                                                        edit
                                                        </span>
                                                </a>
                                                <a wire:click="destroy({{ $estate->id }})" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"  href="#" class="text-danger p-0"
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
    
                                {{ $estates->links() }}
    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
