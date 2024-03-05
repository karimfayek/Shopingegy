@extends('site.app')
@section('title', 'Checkout')
@section('content')
 
<section class="section section-sm bg-transparent novi-background" data-preset='{"title":"Breadcrumb","category":"breadcrumb","reload":false,"id":"breadcrumb-6"}'>
    <div class="container">
            <!-- Breadcrumb-->
            <ul class="breadcrumb  justify-content-center no-border mb-0">
                <li class="breadcrumb-item"><a class="breadcrumb-link" href="/">Home</a></li>
                <li class="breadcrumb-item"><a class="breadcrumb-text breadcrumb-active" href="#">Checkout</a></li>
                </ul>
    </div>
  </section>
    <section class="section section-lg bg-transparent novi-background">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    @if (Session::has('error'))
                        <p class="alert alert-danger">{{ Session::get('error') }}</p>
                    @endif
					@if (Session::has('success'))
                        <p class="alert alert-success">{{ Session::get('success') }}</p>
                    @endif
                </div>
            </div>
			@if($cartCount > 0)
          <div id="checkout"></div>
			@else
			<h3 class="m-4 team-area">Cart Empty</h3>
			@endif
        </div>
    </section>
@stop
