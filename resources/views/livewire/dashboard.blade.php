<div>
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>{{ config('app.name', 'Real Estate App') }} - Dashboard</h1>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xl-4">
            <div class="card widget widget-stats">
                <div class="card-body">
                    <div class="widget-stats-container d-flex">
                        <div class="widget-stats-icon widget-stats-icon-primary">
                            <i class="material-icons-outlined">maps_home_work</i>
                        </div>
                        <div class="widget-stats-content flex-fill">
                            <span class="widget-stats-title">Total Properties</span>
                            <span class="widget-stats-amount">{{ $propertyCount }}</span>
                            <span class="widget-stats-info">{{ $subscribed->count() }} subscribed</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card widget widget-stats">
                <div class="card-body">
                    <div class="widget-stats-container d-flex">
                        <div class="widget-stats-icon widget-stats-icon-warning">
                            <i class="material-icons-outlined">person</i>
                        </div>
                        <div class="widget-stats-content flex-fill">
                            <span class="widget-stats-title">Total Clients</span>
                            <span class="widget-stats-amount">{{ $clients->count() }}</span>
                            <span class="widget-stats-info">{{ $clients->count() }} active</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <livewire:s-m-s.balance />
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Due for payment</h4>
                            <form wire:submit.prevent="fetchPropertiesDueForPayment">
                                <div class="row">
                                    <div class="col-2 col-md-3 mt-3">
                                        Due in
                                    </div>
                                    <div class="col-2 col-md-3">
                                        <input wire:model.defer="dueIn" type="number" class="form-control"
                                            placeholder="3" aria-label="Due in">
                                    </div>
                                    <div class="col-2 col-md-3 mt-3">
                                        days
                                    </div>
                                    <div class="col-md-3 mt-3 mt-md-0">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <th>Client</th>
                                        <th>Property</th>
                                    </thead>
                                    <tbody>
                                        @forelse ($properties as $property)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('clients.show', $property->client) }}">{{ $property->client->name }}</a>
                                                </td>
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
                                        @empty
                                            <tr>
                                                <td colspan="2">No due payments</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Payments Defaulters</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-nowrap">
                                    <thead>
                                        <th>Client</th>
                                        <th>Property</th>
                                        <th class="text-end">Default AAmt</th>
                                        <td>Default Date</td>
                                    </thead>
                                    <tbody>
                                        @forelse($defaulters as $defaulter)
                                        <tr>
                                            <td>
                                                <a href="{{ route('clients.show', $defaulter->client) }}">{{ $defaulter->client->name }}</a>
                                            </td>
                                            <td>{{ $defaulter->property->unique_number }}</td>
                                            <td class="text-end">
                                               {{ number_format($defaulter->default_amount, 2) }}
                                            </td>
                                            <td>
                                                {{ $defaulter->missed_date->toFormattedDateString() }}
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3">No defaulters</td>
                                        </tr>
                                        @endforelse
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
