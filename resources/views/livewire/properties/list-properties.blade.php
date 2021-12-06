<div>
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h4 class="page-title">{{ config('app.name', 'Real Estate App') }} Properties</h4>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <Link :href="route('home')">
                                    <i class="mdi mdi-home-outline"></i>
                                </Link>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Properties</li>
                        </ol>
                    </nav>
                </div>
            </div>

        </div>
    </div>

    <!-- Main content -->
    <section class="content">

        <div class="row">

            @if (session()->has('message'))
            <div class="col-lg-12">
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            </div>
            @endif

            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>List of Property</h4>
                            </div>
                            <div class="col-md-3">
                                <input wire:model="search" type="search" class="form-control" placeholder="Filter Property...">
                            </div>
                            <div class="col-md-3 d-flex justify-content-end float-right">
                                <a href="{{ route('properties.create') }}" class="btn btn-primary">Add Property</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <div class="table-responsive-sm">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
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
                                        <td>{{ $loop->iteration }}</td>
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
                                            <i class="fa fa-eye font-medium-3 mr-2"></i>
                                            </a>
                                            <a href="{{ route('properties.edit', $property) }}" class="text-warning p-0" data-original-title=""
                                                title="Edit">
                                            <i class="fa fa-pencil font-medium-3 mr-2"></i>
                                            </a>
                                            <a wire:click.prevent="destroy({{ $property->id }})" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" href="#" class="text-danger p-0"
                                                data-original-title="" title="Delete">
                                            <i class="fa fa-trash-o font-medium-3 mr-2"></i>
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

    </section>
</div>
