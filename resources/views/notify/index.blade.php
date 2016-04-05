@extends('home')

@section('meta_redirect')
    <meta http-equiv="refresh" content="3; url={{$redirect_uri}}">
@endsection

@section('content-page')
    <h1>{{$header}}</h1>
    <p>{{$message}}</p>
@endsection
