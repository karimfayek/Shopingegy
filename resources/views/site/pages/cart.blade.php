@extends('site.app')
@section('title', $heading['cart'])
@section('content')
  
@include('site.partials.breadcrumb', ['name' => $heading['cart'] ])
  <!-- Grid view \Cart::getContent() -->
   
  <section id="cart" class="section section-lg bg-transparent novi-background">
    
  </section>
    
@stop
