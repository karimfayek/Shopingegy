@extends('site.app')
@section('title', $product->localName)
@push('styles') 
@if ($local == 'ar')
<style>
.shop-details .product-tabs .product-reviews .comment-list li .comment-container .comment-text{
  padding-left: auto;
  padding-right: 15px;
}
.shop-details .variations .label {
    margin-right: auto;
    margin-left: 15px;
}
.shop-details .variations .label:after{
    display: inline !important;
}
</style>
    
@endif
<style>
 .rating-stars {
    position: relative;
    cursor: pointer;
    vertical-align: middle;
    display: inline-block;
    overflow: hidden;
    white-space: nowrap;
}
.empty-stars {
    color: #aaa;
}
.star {
    display: inline-block;
    margin: 0 2px;
    text-align: center;
}
.empty-stars .krajee-icon-star {
    background-image: url(data:image/svg+xml;charset=utf-8,%3Csvg%20version%3D%221.1%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20width%3D%2232%22%20height%3D%2232%22%20viewBox%3D%220%200%2032%2032%22%3E%3Cpath%20fill%3D%22%23ffffff%22%20stroke%3D%22%23777777%22%20d%3D%22M20.6%2011l-4.6-10.5-4.6%2010.5h-10.8l7.8%207.9-3%2012.1%2010.6-6%2010.6%206-3-12.1%207.8-7.9z%22%3E%3C%2Fpath%3E%3C%2Fsvg%3E);
}
.krajee-icon {
    width: 2.5rem;
    height: 2.5rem;
    display: inline-block;
    width: 2rem;
    height: 2rem;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}
.filled-stars {
    transition: width 0.25s ease;
    position: absolute;
    left: 0;
    top: 0;
    margin: auto;
    color: #fde16d;
    white-space: nowrap;
    overflow: hidden;
    -webkit-text-stroke: 1px #777;
    text-shadow: 1px 1px #999;
    
}
.filled-stars .krajee-icon-star {
    background-image: url(data:image/svg+xml;charset=utf-8,%3Csvg%20version%3D%221.1%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20width%3D%2232%22%20height%3D%2232%22%20viewBox%3D%220%200%2032%2032%22%3E%3Cpath%20fill%3D%22%23fde16d%22%20stroke%3D%22%23777777%22%20d%3D%22M20.6%2011l-4.6-10.5-4.6%2010.5h-10.8l7.8%207.9-3%2012.1%2010.6-6%2010.6%206-3-12.1%207.8-7.9z%22%3E%3C%2Fpath%3E%3C%2Fsvg%3E);
}
</style>
    
@endpush
@section('content')
@include('site.partials.breadcrumb', ['name' => $product->local_name , 'cat' => 'yes'])

<div id="content" class="site-content" role="main">
    <div class="shop-details zoom" data-product_layout_thumb="scroll" data-zoom_scroll="true" data-zoom_contain_lens="true" data-zoomtype="inner" data-lenssize="200" data-lensshape="square" data-lensborder="" data-bordersize="2" data-bordercolour="#f9b61e" data-popup="false">	
        <div class="product-top-info">
            <div class="section-padding">
                <div class="section-container p-l-r">
                    <div class="row">
                        <div class="product-images col-lg-7 col-md-12 col-12">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="content-thumbnail-scroll">
                                        <div class="image-thumbnail slick-carousel slick-vertical slider-nav" data-asnavfor=".image-additional" data-centermode="true" data-focusonselect="true" data-columns4="5" data-columns3="4" data-columns2="4" data-columns1="4" data-columns="4" data-nav="true" data-vertical="&quot;true&quot;" data-verticalswiping="&quot;true&quot;">
                                            @foreach($product->images as $prpic)
                                            <div class="img-item slick-slide">
                                                <span class="img-thumbnail-scroll">
                                                    <img width="120" height="120" src="{{ asset('storage/products/thumbnail/'.$prpic->full) }}" alt="">
                                                </span>
                                            </div>
                                            @endforeach
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="scroll-image main-image">
                                        <div id="slider-for" class="image-additional slick-carousel slider-for" data-asnavfor=".image-thumbnail" data-fade="true" data-columns4="1" data-columns3="1" data-columns2="1" data-columns1="1" data-columns="1" data-nav="true">
                                            @foreach($product->images as $prpic)
                                            <div class="img-item slick-slide zoom">
                                                <img width="900" height="900"   data-zoom-image= "{{ asset('storage/products/original_photos/'.$prpic->full) }}" src="{{ asset('storage/products/original_photos/'.$prpic->full) }}" alt="" title="">
                                            </div>
                                            @endforeach
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
@php
    $reviews = $product->reviews;
$totalReviews = $reviews->count();
if ($totalReviews > 0) {
    $totalRating = $reviews->sum('rate');
    
    $averageRating = $totalRating / $totalReviews;
} else {
    $averageRating = 0;
}
@endphp
                        <div class="product-info col-lg-5 col-md-12 col-12 ">
                            <h1 class="title">{{ $product->local_name }}</h1>
                            @if ( $product->price > 0)
                            <span class="price">
                                @if($product->sale_price > $product->price)
                                <del aria-hidden="true"><span>L.E {{ $product->sale_price }}</span></del> 
                                @endif
                                <ins><span>L.E {{ $product->price }}</span></ins>
                            </span>
                            <div class="rating-stars" tabindex="0">
                                <a href="#reviews">
                                <span class="empty-stars"><span class="star" title="One Star"><span class="krajee-icon krajee-icon-star"></span></span><span class="star" title="Two Stars"><span class="krajee-icon krajee-icon-star"></span></span><span class="star" title="Three Stars"><span class="krajee-icon krajee-icon-star"></span></span><span class="star" title="Four Stars"><span class="krajee-icon krajee-icon-star"></span></span><span class="star" title="Five Stars"><span class="krajee-icon krajee-icon-star"></span></span></span><span class="filled-stars" style="width:  calc({{ $averageRating }} * 20%)"><span class="star" title="One Star"><span class="krajee-icon krajee-icon-star"></span></span><span class="star" title="Two Stars"><span class="krajee-icon krajee-icon-star"></span></span><span class="star" title="Three Stars"><span class="krajee-icon krajee-icon-star"></span></span><span class="star" title="Four Stars"><span class="krajee-icon krajee-icon-star"></span></span><span class="star" title="Five Stars"><span class="krajee-icon krajee-icon-star"></span></span></span>
                            </a>
                            </div>
                            <div class="rating rtl">
                                
                                  ({{  $totalReviews  }}<span> {{ $translations['review'] }}</span>)
                            </div>
                            @endif
                            {{--  
                            <div class="variations description rtl">
                               
                                <table cellspacing="0">
                                    <tbody>
                                        @foreach($attributes as $attribute)
                                        @php
                                                $attributeCheck = in_array($attribute->id, $product->attributes->pluck('attribute_id')->toArray());									
                                        @endphp
                                        @if ($attributeCheck)
                                        <tr>
                                            <td class="label">{{ $attribute->name }}</td>
                                            <td class="attributes">
                                                <ul class="{{ $attribute->code == 'color' ? 'colors' : 'text' }}">
                                                    @foreach($product->attributes as $attributeValue)
                                                    @if ($attributeValue->attribute_id == $attribute->id)
                                                    
                                                    <li><span>{{ $attributeValue->valuear}}</span></li>
                                                        
                                                    @endif
                                                @endforeach
                                                </ul>
                                            </td>
                                        </tr>
                                            									
                                        @endif
                                    @endforeach
                                       
                                    </tbody>
                                </table>
                            </div>
                          --}}
                            <div class="buttons" id="add-to-cart-product-page" data-pr={{ $product->id }} data-prPage={{ true }}>
                               
                            </div>
                            <div class="product-meta rtl">
                                <span class="sku-wrapper">SKU: <span class="sku">{{ $product->sku }}</span></span>
                                <span class="posted-in">{{ $heading['category'] }}: <a href="/category/{{ $product->categories[0]->slug }}/{{ $local }}" rel="tag">{{ $product->categories[0]->local_name }}</a></span>
                                
                            </div>
                           				
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-tabs">
            <div class="section-padding">
                <div class="section-container p-l-r">
                    <div class="product-tabs-wrap rtl">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link m active" data-toggle="tab" href="#description" role="tab">{{ $heading['description'] }}</a>
                            </li>  
                            <li class="nav-item">
                                <a class="nav-link m" data-toggle="tab" href="#additional-information" role="tab" aria-selected="true">{{ $heading['specs']  }}</a>
                            </li>                          
                           
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane m fade show active" id="description" role="tabpanel">
                                {!! $product->local_description !!}    
                            </div>
                            <div class="tab-pane m fade " id="additional-information" role="tabpanel">
                                <table class="product-attributes">
                                    <tbody>
                                        <tr class="attribute-item">
                                            <th class="attribute-label">Color</th>
                                            <td class="attribute-value">Black, Blue, Green</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($totalReviews > 0) 
        <div class="product-tabs" style="border: 0" id="reviews">
            <div class="section-padding">
                <div class="section-container p-l-r">
                    <div class="product-tabs-wrap">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#description" role="tab">{{ $heading['reviews'] }}</a>
                            </li>                            
                           
                        </ul>
                        <div class="rtl tab-content textRight">
                            <div class="tab-pane fade active show" id="reviews" role="tabpanel">
                                <div id="reviews" class="product-reviews">
                                    <div id="comments">
                                        <h2 class="reviews-title">{{ $totalReviews }} {{ $translations['review'] }} {{ $translations['for'] }}  <span>{{ $product->LocalName }}</span></h2>
                                        <ol class="comment-list">
                                            @foreach ($product->reviews as $review)
                                            <li class="review">
                                              <div class="content-comment-container">
                                                <div class="comment-container">
                                                  <img src="/media/user.jpg" class="avatar" height="60" width="60" alt="">
                                                  <div class="comment-text">
                                                    <div class="rating small">
                                                      <div class="rating-stars" tabindex="0"><span class="empty-stars"><span class="star" title="One Star"><span class="krajee-icon krajee-icon-star"></span></span><span class="star" title="Two Stars"><span class="krajee-icon krajee-icon-star"></span></span><span class="star" title="Three Stars"><span class="krajee-icon krajee-icon-star"></span></span><span class="star" title="Four Stars"><span class="krajee-icon krajee-icon-star"></span></span><span class="star" title="Five Stars"><span class="krajee-icon krajee-icon-star"></span></span></span><span class="filled-stars" style="width:  calc({{ $review->rate }} * 20%)"><span class="star" title="One Star"><span class="krajee-icon krajee-icon-star"></span></span><span class="star" title="Two Stars"><span class="krajee-icon krajee-icon-star"></span></span><span class="star" title="Three Stars"><span class="krajee-icon krajee-icon-star"></span></span><span class="star" title="Four Stars"><span class="krajee-icon krajee-icon-star"></span></span><span class="star" title="Five Stars"><span class="krajee-icon krajee-icon-star"></span></span></span></div>
                                                    </div>
                                                    <div class="review-author">{{$review->name }}</div>
                                                    <div class="review-time">{{ $review->created_at }}</div>
                                                  </div>
                                                </div>
                                                <div class="description">
                                                  <p>{{ $review->review }}</p>
                                                </div>	
                                              </div>
                                            </li>
                                            @endforeach
                                        </ol>
                                    </div>
                                  
                                    <div class="clear"></div>
                                </div>
                            </div>
                           
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
       @endif
        @if ($related->count())
        <div class="product-related">
            <div class="section-padding">
                <div class="section-container p-l-r">
                    <div class="block block-products slider">
                        <div class="block-title"><h2>{{ $heading['relatedprs'] }}</h2></div>
                        <div class="block-content">
                            <div class="content-product-list slick-wrap">
                                <div class="slick-sliders products-list grid" data-slidestoscroll="true" data-dots="false" data-nav="1" data-columns4="1" data-columns3="2" data-columns2="3" data-columns1="3" data-columns1440="4" data-columns="4">
                                    @foreach($related->slice(0,8) as $rel)
                                    <div class="item-product slick-slide">
                                        <div class="items">
                                            <div class="products-entry clearfix product-wapper">
                                                <div class="products-thumb">
                                                   
                                                    <div class="product-thumb-hover">
                                                        <a href="/product/{{ $rel->slug }}/{{ $local }}">
                                                            <img 
                                                            sizes="(max-width: 420px) 10w, (max-width: 768px) 60w, (max-width: 1024px) 420w, 600w"
                                                            srcset="
                                                                {{ asset('storage/products/tiny_photos/'.$rel->first_image) }} 10w,
                                                                {{ asset('storage/products/thumbnail/'.$rel->first_image) }} 60w,
                                                                {{ asset('storage/products/mobile_photos/'.$rel->first_image) }} 420w,
                                                                {{ asset('storage/products/medium_photos/'.$rel->first_image) }} 600w
                                                            "
                                                            src="{{ asset('storage/products/original_photos/'.$rel->first_image) }}"
                                                            class="post-image" 
                                                            alt="{{ $rel->LocalName }}"
                                                            width="600" 
                                                            height="600"
                                                        >
                                                        <img 
                                                            sizes="(max-width: 420px) 10w, (max-width: 768px) 60w, (max-width: 1024px) 420w, 600w"
                                                            srcset="
                                                                {{ asset('storage/products/tiny_photos/'.$rel->last_image) }} 10w,
                                                                {{ asset('storage/products/thumbnail/'.$rel->last_image) }} 60w,
                                                                {{ asset('storage/products/mobile_photos/'.$rel->last_image) }} 420w,
                                                                {{ asset('storage/products/medium_photos/'.$rel->last_image) }} 600w
                                                            "
                                                            src="{{ asset('storage/products/original_photos/'.$rel->last_image) }}"
                                                            class="hover-image back" 
                                                            alt="{{ $rel->LocalName }}"
                                                            width="600" 
                                                            height="600"
                                                        >
                                                     </a>
                                                    </div>		
                                                    
                                                </div>
                                                <div class="products-content">
                                                    <div class="contents text-center">
                                                        <h3 class="product-title"><a href="/product/{{ $rel->slug }}/{{ $local }}">{{ $rel->local_name }}</a></h3>
                                                        @if($rel->price > 0)
                                                        <span class="price">
                                                            @if($rel->sale_price > $rel->price)
                                                            <del aria-hidden="true"><span>L.E {{ $rel->sale_price }}</span></del> 
                                                            @endif
                                                            <ins><span>L.E {{ $rel->price }}</span></ins>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div><!-- #content -->



      
 
     @stop
@push('scripts')
 
<script src="/js/jquery-elevatezoom.js"></script>
<script src="/js/slick.min.js"></script>
<script>
jQuery(document).ready(function($){
   $('.slick-sliders').slick({
  dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 4,
  slidesToScroll: 4,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
 


$('.slider-for').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  asNavFor: '.slider-nav'
});
$('.slider-nav').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  asNavFor: '.slider-for',
  arrows: true,
  centerMode: true,
  focusOnSelect: true,
  vertical : true
});

$('#slider-for').on('beforeChange', function(event, slick, currentSlide, nextSlide){
   var img = $(slick.$slides[nextSlide]).find("img");
   $('.zoomWindowContainer,.zoomContainer').remove();
   $(img).elevateZoom({
    zoomType: 'inner',
    cursor: 'crosshair',
    zoomScroll: true,    
    lensSize: 200,
    zoomWindowFadeIn: 500,
zoomWindowFadeOut: 750,
showLens:true,
scrollZoom : true ,
containLensZoom:true,
});
}); 

$('#slider-for .slick-current img').elevateZoom(
    {
    zoomType: 'inner',
    cursor: 'crosshair',
    zoomScroll: true,    
    lensSize: 200,
    zoomWindowFadeIn: 500,
zoomWindowFadeOut: 750,
showLens:true,
scrollZoom : true ,
containLensZoom:true,

}
);

$('.nav-link.m').on('click', function(e){
        e.preventDefault(); // Prevent default behavior of the link
        $('.nav-link.m').removeClass('active show'); 
        $(this).addClass('active show')
        var targetTabId = $(this).attr('href'); // Get the target tab id from the href attribute
        $('.tab-pane.m').removeClass('active show'); // Hide all tab panes
        $(targetTabId).addClass('active show'); // Show the selected tab pane
      });
});
</script> 
@endpush
