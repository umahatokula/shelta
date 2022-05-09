@extends('layouts.frontend')

@section('content')
    <livewire:signup.signup-preview :client="$client" :estateId="$estate" :propertyTypeId="$propertyType" :paymentPlanId="$paymentPlan" />
@endsection
