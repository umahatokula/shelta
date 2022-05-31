<div>
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>{{ config('app.name', 'Real Estate App') }} - Property Types</h1>
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
                            @can('create property type')
                            <a href="{{ route('property-types.create') }}" class="btn-lg btn btn-primary">Add Property Type</a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="example-container">
                        <div class="example-content">

                            @can('view property types')
                            <div class="table-responsive-sm">

                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th class="text-left">Name</th>
                                            <th>Photo</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($propertyTypes as $propertyType)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-left">{{ $propertyType->name }}</td>
                                            <td>
                                                @if ($propertyType->getFirstMedia('propertyTypephotos'))
                                                    <img src="{{ $propertyType->getFirstMedia('propertyTypephotos')->getUrl('thumb') }}" alt="" style="max-width: 80px">
                                                @endif

                                            </td>
                                            <td>
                                                @can('view property types')
                                                <a href="{{ route('property-types.show', $propertyType) }}" class="text-primary p-0" data-original-title=""
                                                    title="View">
                                                <span class="material-icons-outlined">
                                                    visibility
                                                    </span>
                                                </a> &nbsp
                                                @endcan

                                                @can('edit property type')
                                                <a href="{{ route('property-types.edit', $propertyType) }}" class="text-warning p-0" data-original-title="Edit"
                                                    title="">
                                                <span class="material-icons-outlined">
                                                    edit
                                                    </span>
                                                </a> &nbsp
                                                    @endcan

                                                    @can('delete property type')
                                                <a wire:click.prevent="destroy({{ $propertyType->id }})"  onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"  href="#" class="text-danger p-0"
                                                    data-original-title="" title="Delete">
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

                                {{ $propertyTypes->links() }}

                            </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
