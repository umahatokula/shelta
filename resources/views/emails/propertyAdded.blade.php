@extends('emails.layout.emailLayout')

@section('content')

<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Hi {{ $client->onames }},</p>
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Please note that there has been an update on your list of properties with us.</p>

<p>Click <a href="{{ route('frontend.clients.properties') }}">here</a> to view this change.</p>

<p>Regards, <br> {{ config('app.name') }}</p>

@endsection