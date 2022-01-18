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
                                        @foreach($properties as $property)
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
                                        @endforeach
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
                            <form wire:submit.prevent="getPaymentDefaultersList">
                                <div class="row">
                                    <div class="col-12 col-md-3 mb-2">
                                        <select wire:model="defaulters_estate" class="form-control">
                                            <option value="">Estate</option>
                                            @foreach ($estates as $estate)
                                                <option value="{{ $estate->id }}">{{ $estate->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-3 mb-2">
                                        <input wire:model.defer="defaulters_start_date" type="date" class="form-control">
                                    </div>
                                    <div class="col-12 col-md-3 mb-2">
                                        <input wire:model.defer="defaulters_end_date" type="date" class="form-control">
                                    </div>
                                    <div class="col-12 col-md-3 mb-2">
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
                                        <th class="text-end">Default balance</th>
                                    </thead>
                                    <tbody>
                                        @forelse($defaulters as $defaulter)
                                        <tr>
                                            <td>
                                                <a href="{{ route('clients.show', $defaulter['slug']) }}">{{ $defaulter['name'] }}</a>
                                            </td>
                                            <td class="text-end">
                                               {{ number_format($defaulter['total_payment_default_owed'] - $defaulter['total_payment_default_paid']) }}
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
