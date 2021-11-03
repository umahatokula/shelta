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
                <div class="box p-15">

                    @if ($propertyType->estates->isNotEmpty())
                        
					<div class="table-responsive">
                    <table id="payments" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                          <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-left">Property</th>
                                    <th class="text-right">Amount</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Action(s)</th>
                                </tr>
                          </thead>
                          <tbody>
                            @foreach ($propertyType->estates as $estate)
                            <tr>
                                <th scope="row" class="text-center">{{ $loop->iteration }}</th>

                                <td>
                                    @if ($transaction->property)
                                        @if ($transaction->property->estatePropertyType)
                                            <span class="text-warning">{{ $transaction->property->estatePropertyType->estate ? $transaction->property->estatePropertyType->estate->name : null }}</span> - {{ $transaction->property->estatePropertyType->propertyType ? $transaction->property->estatePropertyType->propertyType->name : null }}
                                        @endif
                                    @endif
                                </td>

                                <td class="text-right">{{ number_format($transaction->amount, 2) }}</td>

                                <td class="text-center">
                                    
                                    @if ($transaction->onlinePayment)
                                    <span class="badge badge-primary">online</span>
                                    @else
                                    <span class="badge badge-warning">recorded</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    {{ $transaction->created_at ? $transaction->created_at->toFormattedDateString() : null }}
                                </td>

                                <td class="text-center">
                                    <a wire:click.prevent="downloadReciept({{$client->id}}, {{$transaction->id}})"
                                        href="#" class="text-primary p-0" data-original-title="" title="Download Reciept" download>
                                        <i class="fa fa-download font-medium-3 mr-2"></i>
                                    </a>

                                    @if (!$transaction->onlinePayment)
                                    <a href="{{ $transaction->getFirstMediaUrl('proofOfPayment') }}" class="text-danger p-0"
                                        data-original-title="" title="Proof of Payment" target="_blank">
                                        <i class="fa fa-file-pdf-o font-medium-3 mr-2"></i>
                                    </a>    
                                    @endif
                                    
                                    <a wire:click.prevent="mailReciept({{$client->id}}, {{$transaction->id}})" href="#" class="text-success p-0"
                                        data-original-title="" title="Email Reciept">
                                        <i class="fa fa-envelope-open-o font-medium-3 mr-2"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                          </tbody>				  
                          <tfoot>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-left">Property</th>
                                <th class="text-right">Amount</th>
                                <th class="text-center">Type</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Action(s)</th>
                            </tr>
                          </tfoot>
                      </table>
                      </div>
                    @else
                    <p>
                        No estates yet
                    </p>
                    @endif

                    
                </div>
            </div>

        </div>

    </section>
</div>
