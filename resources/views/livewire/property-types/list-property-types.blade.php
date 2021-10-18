<div>
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h4 class="page-title">Ochacho Property Types</h4>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <Link :href="route('home')">
                                    <i class="mdi mdi-home-outline"></i>
                                </Link>
                            </li>
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

            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6 d-flex justify-content-end">
                                <a href="{{ route('property-types.create') }}" class="btn btn-success">Add Property Type</a>
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
                                            <a href="{{ route('property-types.edit', $propertyType) }}" class="primary p-0" data-original-title=""
                                                title="">
                                            <i class="fa fa-file-photo-o font-medium-3 mr-2"></i>
                                            </a>
                                            <a href="{{ route('property-types.edit', $propertyType) }}" class="primary p-0" data-original-title=""
                                                title="">
                                            <i class="fa fa-pencil font-medium-3 mr-2"></i>
                                            </a>
                                            <a wire:click="destroy"  href="#" class="danger p-0"
                                                data-original-title="" title="">
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
            </div>
        </div>

    </section>

</div>
