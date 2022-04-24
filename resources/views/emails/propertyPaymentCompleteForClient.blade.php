
@extends('emails.layout.emailLayout')

@section('content')

@php
    $property = $transaction->property;
@endphp

    <p>
        Hi {{ $transaction->client->name }},
    </p>


    <p>
        Congrats, you have completed payment for the underlisted property. Expect to hear from us soon as regards your land papers.
    </p>

    <p>Find details below:</p>

    <table class="table">
        <tbody>
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
