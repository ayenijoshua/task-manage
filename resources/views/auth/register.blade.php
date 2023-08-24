@extends('layouts.auth')

@section('content')
    <!-- Main Content -->
    <register-component base-link-name="User" base-link="{{route('user.auth')}}" panel-title='User Register' post-action="{{route('user.register')}}"/>
@endsection