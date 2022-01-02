<div>
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>{{ config('app.name', 'Real Estate App') }} - Dashboard</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <form wire:submit.prevent="fetchPropertiesDueForPayment">
                                <div class="row">
                                    <div class="col-3 col-md-1 mt-3">
                                        Due in
                                    </div>
                                    <div class="col-3 col-md-1">
                                        <input wire:model.defer="dueIn" type="number" class="form-control"
                                            placeholder="3" aria-label="Due in">
                                    </div>
                                    <div class="col-3 col-md-1 mt-3">
                                        days
                                    </div>
                                    <div class="col-md-3 mt-3 mt-md-0">
                                        <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <th>#</th>
                                        <th>Client</th>
                                        <th>Property</th>
                                    </thead>
                                    <tbody>
                                        @foreach($properties as $property)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $property->client->name }}</td>
                                            <td>
                                                {{ $property->unique_number }}
                                                <small>
                                                    (
                                                    @if ($property->estatePropertyType)
                                                    {{ $property->estatePropertyType->propertyType ? $property->estatePropertyType->propertyType->name : null }}

                                                    <span class="font-weight-bold font-italic">-</span>

                                                    @if ($property->estatePropertyType)
                                                    <span
                                                        class="text-warning">{{ $property->estatePropertyType->estate ? $property->estatePropertyType->estate->name : null }}</span>
                                                    @endif
                                                    @else
                                                    Property
                                                    @endif
                                                    )
                                                </small>
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

@push('scripts')

@endpush
