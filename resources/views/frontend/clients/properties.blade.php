@extends('layouts.frontend')

@section('content')
<div>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">Properties</h4>
    
    
            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- Main content -->

    <div class="row">

        <div>
            @if (session()->has('message'))
            <div class="col-lg-12">
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            </div>
            @endif
        </div>

        <div class="col-lg-12">
            <div class="card p-15">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6 float-right">
                            <h3>Properties</h3>
                        </div>
                        <div class="col-md-6 float-right">
                            @if (auth()->user()->hasRole('staff'))
                            <a href="{{ route('clients.add-property', $client) }}" class="waves-effect waves-light btn btn-primary btn-sm float-right" >Add properties</a>
                            @endif
                        </div>
                    </div>

                    @forelse ($client->properties->chunk(3) as $chunk)

                    <div class="row">

                        @foreach ($chunk as $property)
                        <div class="col-12">
                            <div class="row">

                                <div class="col-lg-12 col-12">
                                    <div class="box">
                                        <div class="box-header">
                                            <h4 class="box-title">
                                                @if ($property->estatePropertyType)
                                                {{ $property->estatePropertyType->propertyType ? $property->estatePropertyType->propertyType->name : null }} 
                                                
                                                    <span class="font-weight-bold font-italic" style="font-size: 1rem">in</span>

                                                    @if ($property->estatePropertyType)
                                                        <span class="text-warning">{{ $property->estatePropertyType->estate ? $property->estatePropertyType->estate->name : null }}</span>
                                                    @endif
                                                @else
                                                Property
                                                @endif
                                            </h4>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <!-- Place somewhere in the <body> of your page -->
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="flexslider2">
                                                        <ul class="slides" style="list-style: none">

                                                            @if ($property->estatePropertyType)
                                                                @if ($property->estatePropertyType->propertyType)

                                                                    @foreach ($property->estatePropertyType->propertyType->getMedia('propertyTypephotos') as $photo)
                                                                        <li
                                                                            data-thumb="{{ $photo->getUrl('thumb') }}">
                                                                            <img src="{{ $photo->getUrl() }}"
                                                                                alt="slide" width="300px" />
                                                                        </li>
                                                                    @endforeach
                                                                    
                                                                @endif
                                                            @endif
                                                            
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="col-lg-8 col-12">
                                                    <table class="table table-hover">
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="2"><b>Property Info:</b></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Estate:</td>
                                                                <td>
                                                                    @if ($property->estatePropertyType)
                                                                    {{ $property->estatePropertyType->estate ? $property->estatePropertyType->estate->name : null }} 
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Price:</td>
                                                                <td> 
                                                                    @if ($property->estatePropertyType)
                                                                    &#x20A6; {{ number_format($property->estatePropertyType->price, 2) }} 
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>House number:</td>
                                                                <td>{{ $property->unique_number }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2"><b>Payment Info:</b></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Total Paid:</td>
                                                                <td>&#x20A6; {{ number_format($property->totalPaid(), 2) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Next Payment Date:</td>
                                                                <td>
                                                                    @if ($property->nextPaymentDueDate())
                                                                    {{ $property->nextPaymentDueDate()->toFormattedDateString() }}
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Last Payment:</td>
                                                                <td>
                                                                    @if ($property->lastPayment())
                                                                    {{ $property->lastPayment()->date ? $property->lastPayment()->date->toFormattedDateString() : null }}
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>

                    @empty

                    <p>No properties yet</p>

                    @endforelse
                </div>
            </div>
        </div>    
        

    </div>

</div>

@push('scripts')

<script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/data-table.js') }}"></script>
@endpush

@endsection