
@extends('layouts.app')

@section('content')
    <livewire:search.search-result :query="$query" />
@endsection