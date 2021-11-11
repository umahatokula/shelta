@extends('layouts.app')

@section('content')
    <livewire:transactions.transactions-create :client="$client" />
@endsection