@extends('layouts.frontend')

@section('content')
    <livewire:parcelation.select-plot :estate_slug="$estate_slug" />
@endsection