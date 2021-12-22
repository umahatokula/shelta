@extends('layouts.frontend')

@section('content')

<!-- Faq Section Start -->
<div id="rs-faq" class="rs-faq pt-100 pb-100 md-pt-70 md-pb-70">
    <div class="container">

        <div class="row">
            <div class="col-12">
                <div class="sec-title mb-50">
                    <h2 class="title black-color">
                        My<span class="new-text"> Properties</span>
                    </h2>
                </div>
            </div>
        </div>

        <div class="row y-middle">
            <div class="col-lg-12 pl-30 md-pl-15">
                <div class="faq-content">
                    <div id="accordion" class="accordion">
                        <div class="col-lg-12">

                            @forelse ($client->properties as $property)

                                <div class="card">
                                    <div class="card-header">
                                        <a class="card-link {{ $loop->first ? 'collapsed' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#collapseOne-{{ $property->id }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}">
                                            @if ($property->estatePropertyType)
                                            {{ $property->estatePropertyType->propertyType ? $property->estatePropertyType->propertyType->name : null }} 
                                            
                                                <span class="font-weight-bold font-italic" style="font-size: 1rem">in</span>

                                                @if ($property->estatePropertyType)
                                                    <span class="black-text">{{ $property->estatePropertyType->estate ? $property->estatePropertyType->estate->name : null }}</span>
                                                @endif

                                                 - {{ $property->unique_number }}
                                                 
                                            @else
                                            Property
                                            @endif
                                        </a>
                                    </div>
                                    <div id="collapseOne-{{ $property->id }}" class="collapse show" data-bs-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-6 col-12">
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
                                                                    @if ($property->getPaymentPlanAndPrice())
                                                                    &#x20A6; {{ number_format($property->getPaymentPlanAndPrice()->propertyPrice->price, 2) }} 
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>House number:</td>
                                                                <td>{{ $property->unique_number }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="col-lg-6 col-12">
                                                    <table class="table table-hover">
                                                        <tbody>
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
                                    </div>
                                </div>

                            @empty
                    
                                <p>No properties yet</p>
                    
                            @endforelse
                    
                        </div>
                    </div>
                </div>
            </div>  
        </div>

    </div>
</div>
<!-- Faq Section End -->

@push('scripts')

<script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/data-table.js') }}"></script>
@endpush

@endsection