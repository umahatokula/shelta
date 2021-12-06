
@extends('emails.layout.emailLayout')

@section('content')

@if($property->date_of_first_payment)
    <p>Hello {{ $property->client->name }},</p>

    <p>
        Kindly note that your next payment 
            
            @if ($property->estatePropertyType)
                for

                {{ $property->estatePropertyType->propertyType ? $property->estatePropertyType->propertyType->name : null }} 

                @if ($property->estatePropertyType)
                in
                    <span class="text-default">{{ $property->estatePropertyType->estate ? $property->estatePropertyType->estate->name : null }}</span> estate
                @endif

                is due on <b>{{ $nextDueDate->toFormattedDateString() }}</b>.

            @endif
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
                <td scope="row"><b>Amount:</b></td>
                <td>{{ number_format(($property->estatePropertyType->price / $property->paymentPlan->number_of_months), 2) }}</td>
            </tr>
            <tr>
                <td scope="row"><b>Due Date:</b></td>
                <td>{{ $nextDueDate->toFormattedDateString() }}</td>
            </tr>
        </tbody>
    </table>
@else
    <p>This is to kindly remind you of your next payment.</p>
@endif

@endsection