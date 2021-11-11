<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">{{ config('app.name', 'Real Estate App') }} Payment Plans</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Payment Plans</li>
                    </ol>
                </nav>
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
                                <a href="{{ route('payment-plans.create') }}" class="btn btn-primary">Add Payment Plan</a>
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
                                        <th class="text-center">Number of months</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($plans as $plan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-left">{{ $plan->name }}</td>
                                        <td class="text-center">{{ $plan->number_of_months }}</td>
                                        <td>
                                            <a href="{{ route('payment-plans.edit', $plan) }}" class="text-warning p-0" data-original-title="Edit"
                                                title="">
                                            <i class="fa fa-pencil font-medium-3 mr-2"></i>
                                            </a> &nbsp
                                            <a wire:click="destroy({{ $plan->id }})" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"  href="#" class="text-danger p-0"
                                                data-original-title="" title="Delete">
                                            <i class="fa fa-trash-o font-medium-3 mr-2"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
                <!-- /.box -->
            </div>
        </div>

    </section>
</div>
