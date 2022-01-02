<div>
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>{{ config('app.name', 'Real Estate App') }} - Properties</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>List of Property</h4>
                        </div>
                        <div class="col-md-3">
                            <input wire:model="search" type="search" class="form-control" placeholder="Filter Property...">
                        </div>
                        <div class="col-md-3 d-flex justify-content-end float-right">
                            <a href="{{ route('properties.create') }}" class="btn btn-primary btn-lg">Add Property</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="example-container">
                        <div class="example-content">

                            @if (session()->has('message'))
                            <div class="col-lg-12">
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            </div>
                            @endif

                            <div class="table-responsive-sm">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Property Number</th>
                                            <th class="text-left">Property Type</th>
                                            <th>Estate</th>
                                            <th>Owner</th>
                                            <th>Payment Plan</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($properties as $property)
                                        <tr>
                                            <td class="text-left">{{ $property->unique_number }}</td>
                                            <td class="text-left">
                                                @if ($property->estatePropertyType)
                                                    {{ $property->estatePropertyType->propertyType->name }}
                                                @endif
                                            </td>
                                            <td class="text-left">
                                                @if ($property->estatePropertyType)
                                                    {{ $property->estatePropertyType->estate->name }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($property->client )
                                                    {{ $property->client->sname.' '.$property->client->onames }}                                                
                                                @else
                                                    <span class="badge badge-danger">not subscribed</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($property->paymentPlan)
                                                    {{ $property->paymentPlan->name }}
                                                @else
                                                    <span class="badge badge-danger">not subscribed</span>                                                
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('properties.show', $property) }}" class="text-primary p-0" data-original-title="View"
                                                    title="View">
                                                <span class="material-icons-outlined">
                                                    visibility
                                                    </span>
                                                </a>
                                                <a href="{{ route('properties.edit', $property) }}" class="text-warning p-0" data-original-title=""
                                                    title="Edit">
                                                <span class="material-icons-outlined">
                                                    edit
                                                    </span>
                                                </a>
                                                <a wire:click.prevent="destroy({{ $property->id }})" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" href="#" class="text-danger p-0"
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
    
                                {{ $properties->links() }}
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
