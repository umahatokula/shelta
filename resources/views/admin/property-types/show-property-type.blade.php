@extends('layouts.app')

@section('content')
    <livewire:property-types.show-property-type :propertyType="$propertyType" />
@endsection
