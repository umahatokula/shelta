@extends('layouts.app')

@section('content')
    <livewire:transactions.transactions-edit :client="$client" :transaction="$transaction" />
@endsection