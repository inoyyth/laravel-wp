@extends('layouts.app')
@section('content')

    <!-- Slider Start -->
    @include('pages.homepage.component.slider')
    <!-- Slider End -->

    <!-- Featured Start -->
    @include('pages.homepage.component.featured')
    <!-- Featured End -->


    <!-- Categories Start -->
    @include('pages.homepage.component.category')
    <!-- Categories End -->


    <!-- Offer Start -->
    @include('pages.homepage.component.offer')
    <!-- Offer End -->


    <!-- Products Start -->
    @include('pages.homepage.component.product')
    <!-- Products End -->


    <!-- Subscribe Start -->
    @include('pages.homepage.component.subscribe')
    <!-- Subscribe End -->


    <!-- Arrived Products Start -->
    @include('pages.homepage.component.arrived_product')
    <!-- Arrived Products End -->


    <!-- Vendor Start -->
    @include('pages.homepage.component.vendor')
    <!-- Vendor End -->
@endsection