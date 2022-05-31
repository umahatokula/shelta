
@extends('emails.layout.emailLayout')

@section('content')

    @php
        $property = $transaction->property;
    @endphp


    <p> First payment notification. </p>

    <p>Find details below:</p>

    <table class="table">
        <tbody>
        <tr>
            <td scope="row"><b>Client:</b></td>
            <td>{{ $transaction->client->name }} </td>
        </tr>
        <tr>
            <td scope="row"><b>Property Number:</b></td>
            <td>{{ $property->unique_number }} </td>
        </tr>
        <tr>
            <td scope="row"><b>Property Type:</b></td>
            <td>{{ $property->estatePropertyType->propertyType ? $property->estatePropertyType->propertyType->name : null }} </td>
        </tr>
        <tr>
            <td scope="row"><b>Estate:</b></td>
            <td>{{ $property->estatePropertyType->estate ? $property->estatePropertyType->estate->name : null }}</td>
        </tr>
        <tr>
            <td scope="row"><b>Property price:</b></td>
            <td>{{ number_format(($property->getPropertyPrice()), 2) }}</td>
        </tr>
        <tr>
            <td scope="row"><b>Amount paid:</b></td>
            <td>{{ number_format(($property->totalPaid()), 2) }}</td>
        </tr>
        </tbody>
    </table>

@endsection
