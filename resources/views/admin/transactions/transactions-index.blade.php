@extends('layouts.app')

@section('content')
    {{-- <livewire:transactions.list-transactions /> --}}
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h4>{{ config('app.name', 'Real Estate App') }} - Transactions</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                
                <div class="card-body">

                    @if (session()->has('message'))
                    <div class="col-lg-12">
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    </div>
                    @endif

                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <span class="lead">Total: 	&#8358; {{ number_format($transactionTotal, 2) }}</span> 
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('transactions.index') }}" method="get">
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    {!! Form::date('date_from', $date_from, ['class' => 'form-control rounded bg-light border-0']) !!}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    {!! Form::date('date_to', $date_to, ['class' => 'form-control rounded bg-light border-0']) !!}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    {!! Form::select('status', ['1' => 'Approved', '2' => 'Unapproved', '3' => 'Unprocessed',], $status, ['class' => 'form-control rounded bg-light border-0', 'placeholder' => 'All']) !!}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    {!! Form::search('transaction_number', $transaction_number, ['class' => 'form-control rounded bg-light border-0', 'placeholder' => 'Txn number...']) !!}
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
                                    <th>#</th>
                                    <th class="text-left">Txn Number</th>
                                    <th class="text-end">Amt (&#8358;)</th>
                                    <th class="text-left">Client</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-left">Date</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-left">{{ $transaction->transaction_number }}</td>
                                        <td class="text-end">{{ number_format($transaction->amount, 2) }}</td>
                                        <td class="text-left">
                                            <a href="">
                                                {{ $transaction->client->name }}
                                            </a>
                                        </td>

                                        <td class="text-center">
                                            @if ($transaction->status == 1)
                                                <span class="badge bg-success">approved</span>
                                            @elseif ($transaction->status == 2)
                                                <span class="badge bg-danger">unapproved</span>
                                            @else
                                                <span class="badge bg-dark">unprocessed</span>
                                            @endif
                                        </td>
                                        <td class="text-left">
                                            {{ $transaction->date->toFormattedDateString() }}
                                        </td>

                                        <td class="text-center">
    
                                            <a data-toggle="modal" data-keyboard="false" data-target="#modal-center" data-remote="{{ route('transactions.show', $transaction) }}" href="#" class="text-warning p-0" data-original-title="" title="View Details" >
                                                <span class="material-icons-outlined">
                                                    visibility
                                                    </span>
                                            </a>

                                            <a wire:click.prevent="downloadReciept({{$transaction->client->id}}, {{$transaction->id}})" href="#" class="text-primary p-0" data-original-title="" title="Download Reciept" download>
                                                <span class="material-icons-outlined">
                                                file_download
                                                </span>
                                            </a>
                
                                            @if (!$transaction->onlinePayment)
                                            <a href="{{ $transaction->getFirstMediaUrl('proofOfPayment') }}" class="text-danger p-0"
                                                data-original-title="" title="Proof of Payment" target="_blank">
                                                <span class="material-icons-outlined">
                                                    picture_as_pdf
                                                    </span>
                                            </a>    
                                            @endif
                                            
                                            <a wire:click.prevent="mailReciept({{$transaction->client->id}}, {{$transaction->id}})" href="#" class="text-success p-0"
                                                data-original-title="" title="Email Reciept">
                                                <span class="material-icons-outlined">
                                                    email
                                                    </span>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">No transactions</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-6">
                            <div>
                                <p class="mb-sm-0">Showing {{ $transactions->currentPage() }} to {{ $transactions->perPage() }} of {{ $transactions->total() }} entries</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="float-sm-end">
                                {{ $transactions->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection