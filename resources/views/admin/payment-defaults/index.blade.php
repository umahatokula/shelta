@extends('layouts.app')

@section('content')
    {{-- <livewire:transactions.list-transactions /> --}}
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h4>{{ config('app.name', 'Real Estate App') }} - Payment Defaults</h4>
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

                    <form action="{{ route('payment-defaults.index') }}" method="get">
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
                                <div class="mb-3 d-grid gap-2 d-md-flex justify-content-md-start">
                                    <button type="submit" name="filter" class="btn btn-primary btn-md">Filter</button>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a href="{{ route('payment-defaults.csv', [$date_from, $date_to]) }}" class="btn btn-success btn-md">CSV</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive-md">
                        <table class="table table-centered table-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="text-start">Client (&#8358;)</th>
                                    <th class="text-start">Property</th>
                                    <th class="text-end">Amount</th>
                                    <th class="text-start">Date</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($defaults as $default)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-start">{{ $default->client->name }}</td>
                                        <td class="text-start">{{ $default->property->unique_number }}</td>
                                        <td class="text-end">{{ number_format($default->default_amount, 2) }}</td>
                                        <td class="text-start">{{ $default->missed_date->toFormattedDateString() }}</td>
                                        <td class="text-center">

                                            @if ($default->property->unique_number && $default->client->id)

                                                <a href="{{ route('payment-defaults.pay', [$default->property->unique_number, $default->client->id]) }}">[Pay]</a>

                                            @endif

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
                                <p class="mb-sm-0">Showing {{ $defaults->currentPage() }} to {{ $defaults->perPage() }} of {{ $defaults->total() }} entries</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="float-sm-end">
                                {{ $defaults->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
