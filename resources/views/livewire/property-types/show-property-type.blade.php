<div>

    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>{{ config('app.name', 'Real Estate App') }} - {{ $propertyType->name }}</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">&nbsp</h5>
                </div>
                <div class="card-body">
                    <div class="example-container">
                        <div class="example-content">
                            
                            {{ $propertyType->name }}

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="flexslider2">
                                        <ul class="slides">
    
                                            @foreach($propertyType->getMedia('propertyTypephotos') as $photo)
                                            <li data-thumb="{{ $photo->getUrl('thumb') }}">
                                                <img src="{{ $photo->getUrl() }}" alt="slide" />
                                            </li>
                                            @endforeach
    
                                        </ul>
                                    </div>
                                </div>
    
                                <div class="col-lg-8 col-12">
                                    <div class="table-responsive">
                                       <table class="table table-hover">
                                            <tbody>
                                                <thead>
                                                    <tr>
                                                        <th>Estate</th>
                                                        <th class="text-center">No of Units</th>
                                                        <th class="text-right">Unit Price (&#x20A6;)</th>
                                                        {{-- <th class="text-right">Total til date (&#x20A6;)</th> --}}
                                                    </tr>
                                                </thead>
    
                                                @forelse ($estates as $estate)
                                                    <tr>
                                                        <td>
                                                            {{ $estate->name }}
                                                            <small class="d-block"><a href="{{ route('estate-property-type.clients', [$estate, $propertyType]) }}">See Clients</a></small>
                                                        </td>
                                                        <td class="text-center">{{ $estate->number_of_units }}</td>
                                                        <td class="text-right">
                                                            @forelse ($estate->getPaymentPlanAndPriceOfPropertType($propertyType->id) as $value)
                                                            {{ $value->paymentPlan->name }} - &#8358; {{ number_format($value->propertyPrice->price) }} <br>
                                                            @empty
                                                                <p>No price assigned</p>
                                                            @endforelse
                                                        </td>
                                                        {{-- <td class="text-right">{{ number_format($estate->property_transaction_total) }}</td> --}}
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3" class="text-center">Property type not assigned to estate</td>
                                                    </tr>
                                                @endforelse
    
                                                {{-- <tfoot>
                                                    <tr>
                                                        <td><b>Total:</b></td>
                                                        <td colspan="4" class="text-right"><b>&#x20A6; {{ number_format($propertyTypeTotal) }}</b></td>
                                                    </tr>
                                                </tfoot> --}}
                                                
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
    </div>
</div>
