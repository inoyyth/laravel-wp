@extends('layouts.app')
@section('content')
<div class="container-fluid pt-5">
  <div class="mb-4">
    <div class="px-lg-5 px-sm-2">
      <div class="row">
        <div class="col-lg-3 col-sm-6">
          @include('pages.customer.component.left_menu')
        </div>
        <div class="col-lg-9 col-sm-6">
          @if(Route::current()->getName() == 'customer.main')
            @include('pages.customer.component.profile')
          @endif
          @if(Route::current()->getName() == 'customer.address')
            @include('pages.customer.component.address')
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection