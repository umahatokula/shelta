@extends('layouts.frontend')

@section('content')

<livewire:frontend.client.properties />

@push('scripts')

<script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/data-table.js') }}"></script>
@endpush

@endsection