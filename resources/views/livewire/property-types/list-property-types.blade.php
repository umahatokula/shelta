<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Property Types</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Property Types</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>
</div>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6 d-flex justify-content-end">
                            <a href="{{ route('property-types.create') }}" class="btn btn-primary">Add Property Type</a>
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
                                        <a href="{{ route('property-types.edit', $propertyType) }}" class="text-primary p-0" data-original-title=""
                                            title="View">
                                        <i class="fa fa-file-photo-o font-medium-3 mr-2"></i>
                                        </a> &nbsp
                                        <a href="{{ route('property-types.edit', $propertyType) }}" class="text-warning p-0" data-original-title="Edit"
                                            title="">
                                        <i class="fa fa-pencil font-medium-3 mr-2"></i>
                                        </a> &nbsp
                                        <a wire:click.prevent="destroy({{ $propertyType->id }})"  onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"  href="#" class="text-danger p-0"
                                            data-original-title="" title="Delete">
                                        <i class="fa fa-trash-o font-medium-3 mr-2"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>

                        {{ $propertyTypes->links() }}

                    </div>
                </div>

            </div>
            <!-- /.box -->
        </div>
    </div>

</section>
