<div>
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h4 class="page-title">{{ config('app.name', 'Real Estate App') }} Transactions</h4>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <Link :href="route('home')">
                                    <i class="mdi mdi-home-outline"></i>
                                </Link>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Transactions</li>
                        </ol>
                    </nav>
                </div>
            </div>

        </div>
    </div>

    <!-- Main content -->
    <section class="content">

        <div class="row">

            @if (session()->has('message'))
            <div class="col-lg-12">
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            </div>
            @endif

            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-md-3">
                                <input wire:model="search" type="search" class="form-control" placeholder="Filter transactions...">
                            </div>
                            <div class="col-md-6 d-flex justify-content-end float-right">
                                &nbsp
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <div class="table-responsive-sm">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-left">transaction Number</th>
                                        <th class="text-left">Client</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-left">Date</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-left">{{ $transaction->transaction_number }}</td>
                                        <td class="text-left">
                                            {{ $transaction->client->sname.' '.$transaction->client->onames }}
                                        </td>

                                        <td class="text-center">
                                            @if ($transaction->status == 1)
                                                <span class="badge badge-success">approved</span>
                                            @elseif ($transaction->status == 2)
                                                <span class="badge badge-danger">unapproved</span>
                                            @else
                                                <span class="badge badge-default">unprocessed</span>
                                            @endif
                                        </td>
                                        <td class="text-left">
                                            {{ $transaction->created_at->toFormattedDateString() }}
                                        </td>

                                        <td class="text-center">

                                            <a data-toggle="modal" data-keyboard="false" data-target="#modal-center" data-remote="{{ route('transactions.show', $transaction) }}" href="#" class="text-warning p-0" data-original-title="" title="View Details" >
                                                <i class="fa fa-eye font-medium-3 mr-2"></i>
                                            </a>

                                            <a wire:click.prevent="downloadReciept({{$transaction->client->id}}, {{$transaction->id}})" href="#" class="text-primary p-0" data-original-title="" title="Download Reciept" download>
                                                <i class="fa fa-download font-medium-3 mr-2"></i>
                                            </a>
                
                                            @if (!$transaction->onlinePayment)
                                            <a href="{{ $transaction->getFirstMediaUrl('proofOfPayment') }}" class="text-danger p-0"
                                                data-original-title="" title="Proof of Payment" target="_blank">
                                                <i class="fa fa-file-pdf-o font-medium-3 mr-2"></i>
                                            </a>    
                                            @endif
                                            
                                            <a wire:click.prevent="mailReciept({{$transaction->client->id}}, {{$transaction->id}})" href="#" class="text-success p-0"
                                                data-original-title="" title="Email Reciept">
                                                <i class="fa fa-envelope-open-o font-medium-3 mr-2"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                        <div class="row my-5">
                          <div class="col-12 d-flex justify-content-center">

                            {{ $transactions->links() }}
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
