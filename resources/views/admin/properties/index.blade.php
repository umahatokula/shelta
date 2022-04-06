@extends('layouts.app')

@section('content')
    {{-- <livewire:properties.list-properties /> --}}
    <div>
        <div class="row">
            <div class="col">
                <div class="page-description">
                    <h4>{{ config('app.name', 'Real Estate App') }} - Properties</h4>
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
                            <div class="col-md-6 d-flex justify-content-end">
                                <div class="mb-3 d-grid">
                                    <a href="{{ route('properties.create') }}" class="btn btn-primary btn-md m">Add Property</a>
                                </div>
                                <div class="mb-3 d-grid">
                                    <a href="{{ route('properties.export') }}" class="btn btn-success btn-md m">CSV</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        @if (session()->has('message'))
                        <div class="col-lg-12">
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        </div>
                        @endif
                        <form action="{{ route('properties.index') }}" method="get">
                            <div class="row mb-2">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        {!! Form::select('price_id', $propertyPrices->pluck('price', 'id'), $price_id, ['class' => 'form-control rounded bg-light border-0', 'placeholder' => 'Select Price']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        {!! Form::select('plan_id', $paymentPlans->pluck('name', 'id'), $plan_id, ['class' => 'form-control rounded bg-light border-0', 'placeholder' => 'Select Plan']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        {!! Form::select('estate_id', $estates->pluck('name', 'id'), $estate_id, ['class' => 'form-control rounded bg-light border-0', 'placeholder' => 'Select Estate']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        {!! Form::select('property_type_id', $propertyTypes->pluck('name', 'id'), $property_type_id, ['class' => 'form-control rounded bg-light border-0', 'placeholder' => 'Select Property Type']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        {!! Form::search('unique_number', null, ['class' => 'form-control rounded bg-light border-0', 'placeholder' => 'Property number']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 d-grid">
                                        <button type="submit" class="btn btn-success btn-md">Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive-md">
                            <table class="table table-centered table-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-left">Property Number</th>
                                        <th class="text-left">Property Type</th>
                                        <th>Estate</th>
                                        <th>Owner</th>
                                        <th class="text-end">Price</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($properties as $property)
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
                                                    <span class="badge bg-danger">not subscribed</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                    {{ number_format($property->getPropertyPrice(), 2) }}
                                            </td>
                                            <td>
                                                {{-- <a href="{{ route('properties.show', $property) }}" class="text-primary p-0" data-original-title="View"
                                                    title="View">
                                                    <span class="material-icons-outlined">
                                                        show
                                                        </span>
                                                </a> --}}
                                                <a href="{{ route('properties.edit', $property) }}" class="text-success p-0" data-original-title=""
                                                    title="Edit">
                                                    <span class="material-icons-outlined">
                                                        edit
                                                        </span>
                                                </a>

                                                <form action="{{ route('properties.destroy', $property) }}" method="post" class="form-inline">

                                                    <a onclick="confirm('Are you sure?') || event.stopImmediatePropagation(); this.closest('form').submit();return false;" href="#" class="text-danger p-0"
                                                        data-original-title="" title="Delete">
                                                        <span class="material-icons-outlined">
                                                            delete
                                                            </span>
                                                    </a>

                                                    @method('delete')
                                                    @csrf
                                                </form>

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">No properties</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>

                        <div class="row mt-4">
                            <div class="col-sm-6">
                                <div>
                                    <p class="mb-sm-0">Showing {{ $properties->currentPage() }} to {{ $properties->perPage() }} of {{ $properties->total() }} entries</p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="float-sm-end">
                                    {{ $properties->appends(request()->input())->links() }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
