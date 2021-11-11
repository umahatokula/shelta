@extends('layouts.app')

@section('content')
    <livewire:estate-propert-type.show-clients :estate="$estate" :propertyType="$propertyType" />
@endsection
