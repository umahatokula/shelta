@extends('layouts.app')

@section('content')
    <livewire:properties.edit-property :property="$property" />
@endsection