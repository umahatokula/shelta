
@extends('emails.layout.emailLayout')

@section('content')

{{--@if($property->date_of_first_payment)--}}
{{--    <p>Hello {{ $property->client->name }},</p>--}}

{{--    <p>--}}
{{--        {!! $notification_message !!}--}}
{{--    </p>--}}
{{--@else--}}
{{--    <p>This is to kindly remind you of your next payment.</p>--}}
{{--@endif--}}

<p>
    {!! $notification_message !!}
</p>

@endsection
