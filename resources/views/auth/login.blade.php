@extends('layouts.auth')

@section('content')
    <!-- Main Content -->
    <login-component base-link-name="" base-link="{{route('register')}}" panel-title='User Login' post-action={{route('user.auth')}}/>
@endsection