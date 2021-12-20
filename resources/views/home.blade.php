@extends('layouts.home_master')

@section('main_content')

    @include('layouts.home.slider')

    <main id="main">

        @include('layouts.home.about_us')
        @include('layouts.home.services')
        @include('layouts.home.porfolio')
        @include('layouts.home.brands')

    </main><!-- End #main -->
  @endsection