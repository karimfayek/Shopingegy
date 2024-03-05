@extends('site.app')
@section('title', $heading['products'])
@section('content')
  
@include('site.partials.breadcrumb', ['name' =>$heading['products'] ])


<section class="section section-padding top-border p-t-70 m-b-70">
    <div class="section-container">
        <!-- Block Product Categories -->
        <div class="block block-product-cats slider">
            <div class="block-widget-wrap">
                <div class="block-title"><h2>Shop by Category</h2></div>
                <div class="block-content">
                    <div class="product-cats-list slick-wrap">
                        <div class="slick-sliders content-category" id="home-cats">
                           
                           
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section section-padding">
    <div class="section-container">
        <!-- Block Products -->
        <div class="block block-products slider" >
            <div class="block-widget-wrap">
                <div class="block-title"><h2>{{ $heading['RecomProducts'] }}</h2></div>
                <div class="block-content">
                    <div class="content-product-list slick-wrap" id="Rprs">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop