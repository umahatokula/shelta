<div>

    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h4 class="page-title">Ochacho Clients</h4>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">
                                    <i class="mdi mdi-home-outline"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page"><a
                                    href="{{ route('clients.index') }}">Clients</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $client->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>

        </div>
    </div>

    <!-- Main content -->
    <section class="content">

        <div class="row">

            <div class="col-lg-3">
                <div class="box p-15">

                    <div class="row">
                        <div class="col-12">
                            <div>
                                <p>
                                    <h3>{{ $client->name }}</h3>
                                </p>
                                <p>Email :<span class="text-gray ps-10"> <a href="mailto:{{ $client->email }}">{{ $client->email }}</a></span>
                                </p>
                                <p>Phone :<span class="text-gray ps-10"> <a href="tel:{{ $client->phone }}">{{ $client->phone }}</a></span></p>
                                <p>Address :<span class="text-gray ps-10"> {{ $client->aadress }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="box p-15">

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h4 class="box-title">Payments</h4>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('transactions.create', $client) }}" class="waves-effect waves-light btn btn-primary btn-sm float-right">Make
                                Payment</a>

                            <!-- Taking namespace into account for component Admin/Actions/EditUser -->
                            {{-- <button x-data="{}" x-on:click="$wire.emitTo('transactions.transactions-create', 'show')">Make Payment</button> --}}
                            <button wire:click="$emit('openModal', 'transactions.transactions-create')">Open Modal</button>


                        </div>
                    </div>

                    @if ($client->transactions->isNotEmpty())
                    <div class="table-responsive-sm">
                        <table class="table mb-0">
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
                                @foreach ($client->transactions as $transaction)

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
                                        <span class="badge badge-primary">{{ $transaction->type }}</span>
                                    </td>

                                    <td class="text-center">
                                        {{ $transaction->created_at ? $transaction->created_at->toFormattedDateString() : null }}
                                    </td>

                                    <td class="text-center">
                                        <a wire:click.prevent="downloadReciept({{$client->id}}, {{$transaction->id}})"
                                            href="#" class="text-primary p-0" data-original-title="" title="Download">
                                            <i class="fa fa-download font-medium-3 mr-2"></i>
                                        </a>
                                        <a href="{{ route('clients.show', $client) }}" class="text-danger p-0"
                                            data-original-title="" title="Print">
                                            <i class="fa fa-print font-medium-3 mr-2"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div> 
                    @else
                    <p>
                        No payments yet
                    </p>
                    @endif

                    
                </div>
            </div>


            <div class="col-12">
                <div class="box p-15">

                    <h3>Properties</h3>

                    @foreach ($client->properties->chunk(3) as $chunk)

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
                                                <div class="col-lg-6">
                                                    <div class="flexslider2">
                                                        <ul class="slides">

                                                            @if ($property->estatePropertyType->propertyType)

                                                                @foreach ($property->estatePropertyType->propertyType->getMedia('propertyTypephotos') as $photo)
                                                                    <li
                                                                        data-thumb="{{ $photo->getUrl('thumb') }}">
                                                                        <img src="{{ $photo->getUrl() }}"
                                                                            alt="slide" />
                                                                    </li>
                                                                @endforeach
                                                                
                                                            @endif
                                                            
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-12">
                                                    <p>
                                                        @if ($property->estatePropertyType)
                                                            <div class="d-block">
                                                                <span class="lead font-weight-bold">Estate:</span> {{ $property->estatePropertyType->estate ? $property->estatePropertyType->estate->name : null }}
                                                            </div>
                                                            <div class="d-block">
                                                                <span class="lead font-weight-bold">Price:</span> &#x20A6; {{ number_format($property->estatePropertyType->price, 2) }}
                                                            </div>
                                                        @endif
                                                    </p>
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

                    @endforeach
                </div>
            </div>

        </div>

    </section>
</div>
