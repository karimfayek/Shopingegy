@extends('site.app')
@section('title', $heading['onlineshop'])
@section('content')
  
@include('site.partials.breadcrumb', ['name' =>$heading['onlineshop'] ])



   
<section class="popular-category bg-gray mt-minus pt-60 pb-60 pb-md-30 pb-sm-30">
  <div class="container">
      
      <div class="row">
        <div class="product-tab-wrapper">
            <div class="row">
                @foreach ($products as $pr)
                    
                
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="product-item mb-50">
                        <div class="product-thumb">
                            <a href="/product/{{ $pr->slug }}/{{ $local }}">
                                @if ($pr->images->count())
                                    
                              
                                <img src="/storage/{{ $pr->images[0]->full }}" alt="">
                                @endif
                            </a>
                            <div class="quick-view-link">
                                <a href="/product/{{ $pr->slug }}/{{ $local }}" >
                                    <span data-bs-toggle="tooltip" title="View"><i class="ion-ios-eye-outline"></i></span>
                                </a>
                            </div>
                        </div>
                        <div class="product-content text-center">
                           
                            <div class="product-name">
                                <h4 class="h5">
                                    <a href="/product/{{ $pr->slug }}/{{ $local }}">{{ $pr->LocalName }}</a>
                                </h4>
                            </div>
                            <div class="price-box">
                                <span class="regular-price">L.E {{ $pr->price }}</span>
                                <span class="old-price"><del></del></span>
                            </div>
                            
                        </div>
                    </div>
                </div>
                @endforeach
                                                  
            </div>
        </div>
      
       
<a href="/contact/{{ $local }}" class="btn btn__bg btn__sqr mt-16">  {{ $heading['specialquote'] }}  </a>
      
      </div>
  </div>
</section>
    <style>
      .category-single-item ul {
        margin: auto ;
        padding: revert
      }
      .category-single-item ul li  {
        list-style: disc ;
      }
    </style>
@stop