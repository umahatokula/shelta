@extends('layouts.app')

@section('content')
    <livewire:payment-plans.edit-plan :paymentPlan="$paymentPlan" />
@endsection
