<!-- resources/views/welcome.blade.php -->

@extends('layouts.master')

@section('content')
    @include('template.navigation')

    @include('template.header')

    @include('template.about')

    <!-- Projects Section -->
    @include('template.project')


    <!-- Signup Section -->
    @include('template.signup')
    @include('template.footer')
@endsection
