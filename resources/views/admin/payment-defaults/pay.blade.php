@extends('layouts.app')

@section('content')
    <livewire:payment-defaults.pay :unique_number="$unique_number" :client_id="$client_id" />
@endsection
