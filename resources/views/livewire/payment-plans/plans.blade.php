<!-- Content Header (Page header) -->
<div>
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>{{ config('app.name', 'Real Estate App') }} - Add Payment Plan</h1>
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
                            <a href="{{ route('payment-plans.create') }}" class="btn-lg btn btn-primary">Add Payment Plan</a>
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
                                                    <span class="material-icons-outlined">
                                                        edit
                                                        </span>
                                                </a> &nbsp
                                                <a wire:click="destroy({{ $plan->id }})" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"  href="#" class="text-danger p-0"
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
