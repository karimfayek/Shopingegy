

@extends('site.app')
@section('title',  $brand->name  )
@push('styles')
    
<link rel="stylesheet" href="/components/media/media.css">
<link rel="stylesheet" href="/components/product-toolbar/product-toolbar.css">
<link rel="stylesheet" href="/components/product/product.css">
<link rel="stylesheet" href="/components/badge/badge.css">
@endpush
<style>
    .product-toolbar-icon.active {
    color: #171724;
}
</style>

@section('content')
<div class="container section-xs" data-animate='{"class":"fadeInRight"}'>
  <nav aria-label="breadcrumb">
    
  <ul class="breadcrumb  justify-content-center no-border mb-0">
    <li class="breadcrumb-item"><a class="breadcrumb-link" href="/">Home</a></li>
    <li class="breadcrumb-item"><a class="breadcrumb-link" href="/brands">Brands</a></li>
    <li class="breadcrumb-item"><a class="breadcrumb-text breadcrumb-active" href="#">{{ $brand->name }}</a></li>
    </ul>
</nav>

<div class="hero-content pb-5 text-center"><h1 class="text-uppercase mt-4">{{ $brand -> name }}</h1>
  <div><div class="col-xl-8 offset-xl-2"> <p> {{ $brand->name }}</p> </div></div></div>
</div>	



<section id="brand" data-slug="{{ $brand->slug }}"  data-id="{{ $brand->id }}"  data-preset='{"title":"List Shop Left Sidebar","brand":"shop","reload":true,"id":"list-shop-left-sidebar"}'>



</section>


@stop