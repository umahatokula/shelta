<div>

    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h4 class="page-title">{{ config('app.name', 'Real Estate App') }} Clients</h4>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">
                                    <i class="mdi mdi-home-outline"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page"><a
                                    href="{{ route('property-types.index') }}">Property Type</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $propertyType->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>

        </div>
    </div>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">
                            {{ $propertyType->name }}
                        </h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- Place somewhere in the <body> of your page -->
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
                                @if ($estates->isNotEmpty())
                                <div class="table-responsive">
                                   <table class="table table-hover">
                                        <tbody>
                                            <thead>
                                                <tr>
                                                    <th>Estate</th>
                                                    <th class="text-center">No of Units</th>
                                                    <th class="text-right">Unit Price (&#x20A6;)</th>
                                                    <th class="text-right">Total til date (&#x20A6;)</th>
                                                </tr>
                                            </thead>

                                            @foreach ($estates as $estate)
                                                <tr>
                                                    <td>
                                                        {{ $estate->name }}
                                                        <small class="d-block"><a href="{{ route('estate-property-type.clients', [$estate, $propertyType]) }}">See Clients</a></small>
                                                    </td>
                                                    <td class="text-center">{{ $estate->number_of_units }}</td>
                                                    <td class="text-right">{{ number_format($estate->unit_price) }}</td>
                                                    <td class="text-right">{{ number_format($estate->property_transaction_total) }}</td>
                                                </tr>
                                            @endforeach

                                            <tfoot>
                                                <tr>
                                                    <td><b>Total:</b></td>
                                                    <td colspan="4" class="text-right"><b>&#x20A6; {{ number_format($propertyTypeTotal) }}</b></td>
                                                </tr>
                                            </tfoot>
                                            
                                        </tbody>
                                    </table>  
                                </div>
                                   
                                @else
                                <p>Property type not assigned to estate</p>
                                @endif
                                
                            </div>

                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>

    </section>
</div>
