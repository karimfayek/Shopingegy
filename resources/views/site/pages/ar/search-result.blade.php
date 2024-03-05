

@extends('site.appar')
@section('title', 'search results')
@section('content')
<style>
.sales-content-02:before {
    content: '';
    position: absolute;
    width: 140%;
    height: 120%;
    left: -20%;
    top: -20%;
    right: -20%;
    bottom: -20%;
    background-image: linear-gradient( 
127deg
 ,#508324 33%,#a10030 91%);
    opacity: 0.5;
}
</style>
    <div class="sale-area">
        <div class="">
            <div class="row justify-content-center text-center">
                <div class="col-md-12">
                    <div class="sales-content-02" style="background: url('') no-repeat center center/cover;background-attachment: fixed;">
                        <h2>نتائج البحث</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
<style>
.product-style-03 .thumb  {
    position: relative;
    overflow: hidden;
}
.product-style-03 .thumb:after {
    position: absolute;
    content: '';
    width: 100%;
    height: 100%;
    left: 0;
    top: 0;
    background: #558a1c12;
}
.product-style-03 .thumb img {
    min-height: 191px;
    padding: 30px;
    -o-object-fit: cover;
    object-fit: cover;
    -webkit-transition: all 3.5s ease 0s;
    -o-transition: all 3.5s ease 0s;
    transition: all 3.5s ease 0s;
}
.product-style-03:hover .thumb img {
    -webkit-transform: scale(1.1);
    -ms-transform: scale(1.1);
    transform: scale(1.1);
}
.margin-bottom-80 {
    margin-bottom: 123px;
}

.widget_about ul li {
    list-style: none;
    width: 36px;
    height: 36px;
background: #558a1c;}

</style>	
<!-- collection area start  -->
    <div class="collection-area margin-top-60">
        <div class="container">
            <div class="row flex-row-reverse">
                <div class="col-12">
                    <div class="tab-content">
                        <div class="tab-pane fade in show active" id="one">
                            <div class="row">
							@if(isset($item))
							@if(!$item->isEmpty())
								@foreach($item as $product)
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="product-style-03 margin-top-40">
											@if ($product->images->count() > 0)
														<a href="{{ route('product.show', $product->slug) }}">
												<div class="thumb">
												   <img src="{{ asset('storage/'.$product->images->first()->full) }}" alt="">										   
												</div></a>
											@else											
												<div class="thumb">
													<img src="https://via.placeholder.com/740" alt="">
												</div>
											@endif
                                        <div class="content text-center">
										
                                            <span class="brand">Brand: DasKind</span>
                                            <h6 class="title"><a href="{{ route('product.show', $product->slug) }}">{{ $product->name2 }}</a></h6>
                                            <div class="content-price d-flex align-self-center justify-content-center">
												 @if ($product->sale_price != 0)
													 <span class="old-price">{{ config('settings.currency_symbol').$product->price }}</span>
												<span class="new-price"> {{ config('settings.currency_symbol').$product->sale_price }}</span>                                  
												@else
													<span class="new-price"> {{ config('settings.currency_symbol').$product->price }}</span>
												@endif
											</div>
                                        </div>
                                    </div>
                                </div>
							@endforeach
							
								@else
								 <p>لا يوجد نتائج ل  {{ $q }}.</p>
								@endif	
								@else
								 <p>لا يوجد نتائج ل  {{ $q }}.</p>
								@endif
                            </div>
                        </div>
						
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- collection area end  -->

@stop