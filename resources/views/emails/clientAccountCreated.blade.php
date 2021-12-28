
@extends('emails.layout.emailLayout')

@section('content')

<p>Hello {!! $client->sname !!},</p>

<p>Your account has been created. Kindly <a href="{{ route('frontend.password.change') }}">login</a> with the details below and remember to change your password.</p>

<p>Username: <b>{!! $client->email !!}</b></p>
<p>Password: <b>{!! $password !!}</b></p>

@endsection