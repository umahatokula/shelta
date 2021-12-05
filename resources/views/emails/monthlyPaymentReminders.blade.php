
@extends('emails.layout.emailLayout')

@section('content')

<p>Hello {{ $client->name }}</p>

@endsection