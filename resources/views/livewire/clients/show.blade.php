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
                            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('clients.index') }}">Clients</a></li>
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


            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="box-title">Client's Profile</h4>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end">
                                <a href="{{ route('transactions.create', $client) }}" class="btn btn-success">Make Payment</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-6">
                <div class="box p-15">

                    <h3>Payments</h3>

                    <div class="table-responsive-sm">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
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

                                    <td class="text-right">
                                        {{ number_format($transaction->amount, 2) }}</td>

                                    <td class="text-center">
                                        <span class="badge badge-pill badge-success">{{ $transaction->type }}</span>
                                    </td>

                                    <td class="text-center">
                                        {{ $transaction->created_at ? $transaction->created_at->toFormattedDateString() : null }}
                                    </td>

                                    <td class="text-center">
                                        <a wire:click.prevent="downloadReciept({{$client->id}}, {{$transaction->id}})"
                                            href="#" class="default p-0" data-original-title="" title="">
                                            <i class="fa fa-download font-medium-3 mr-2"></i>
                                        </a>
                                        <a href="{{ route('clients.show', $client) }}"
                                            class="default p-0" data-original-title="" title="">
                                            <i class="fa fa-print font-medium-3 mr-2"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            
            <div class="col-6">
                <div class="box p-15">
                            
                    <div class="row">
                        <div class="col-12">
                            <div>
                                <p><h3>{{ $client->name }}</h3></p>
                                <p>Email :<span
                                        class="text-gray ps-10">David@yahoo.com</span>
                                </p>
                                <p>Phone :<span class="text-gray ps-10">+11 123 456
                                        7890</span></p>
                                <p>Address :<span class="text-gray ps-10">123, Lorem
                                        Ipsum, Florida, USA</span></p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="pb-15">
                                <p class="mb-10">Social Profile</p>
                                <div class="user-social-acount">
                                    <button
                                        class="btn btn-circle btn-social-icon btn-facebook"><i
                                            class="fa fa-facebook"></i></button>
                                    <button
                                        class="btn btn-circle btn-social-icon btn-twitter"><i
                                            class="fa fa-twitter"></i></button>
                                    <button
                                        class="btn btn-circle btn-social-icon btn-instagram"><i
                                            class="fa fa-instagram"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div>
                                <div class="map-box">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2805244.1745767146!2d-86.32675167439648!3d29.383165774894163!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88c1766591562abf%3A0xf72e13d35bc74ed0!2sFlorida%2C+USA!5e0!3m2!1sen!2sin!4v1501665415329"
                                        style="border:0; width:100%; height:100px;"
                                        allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-12">
                <div class="box p-15">

                    <h3>Properties</h3>

                    @foreach ($client->properties->chunk(3) as $chunk)

                    <div class="row">

                        @foreach ($chunk as $property)
                        <div class="col-4">
                            <div class="card-deck">
                                <div class="card">
                                    <img class="card-img-top"
                                        src="{{ asset('assets/images/img1.jpg') }}"
                                        alt="Card image cap">
                                    <div class="card-body">
                                        <div class="card-block">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">This is a wider card with
                                                supporting
                                                text below as a natural lead-in to additional
                                                content.
                                                This content is a little bit longer.</p>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">Last updated 3 mins ago</small>
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
