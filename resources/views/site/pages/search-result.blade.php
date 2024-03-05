

@extends('site.app')
@section('title', 'search results')
@section('content')

@include('site.partials.breadcrumb', ['name' =>'search Results' ])

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
    <div class="collection-area mt-100 mb-100">
        <div class="container">
            <div class="row flex-row-reverse">
                <div class="col-12">
                    <div class="tab-content">
                        <div class="tab-pane fade in show active" id="one">
                            <div class="row">
							@if(isset($products))
							@if(!$products->isEmpty() &&  isset($products))
								@foreach($products as $product)
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="product-style-03 margin-top-40">
											@if ($product->images->count())
														<a href="{{ route('product.show', $product->slug) }}/{{ $local }}">
												<div class="thumb">
												   <img src="{{ asset('storage/'.$product->images->first()->full) }}" alt="">										   
												</div></a>
											@else											
												<div class="thumb">
													<img src="https://via.placeholder.com/740" alt="">
												</div>
											@endif
                                        <div class="content text-center">
										
                                           
                                            <h6 class="title mt-10"><a href="{{ route('product.show', $product->slug) }}/{{ $local }}">{{ $product->name }}</a></h6>
                                            <div class="content-price d-flex align-self-center justify-content-center">
												 @if ($product->sale_price != 0)
													 <del class="old-price">{{ config('settings.currency_symbol').$product->sale_price }}</del>
												<span class="new-price"> {{ config('settings.currency_symbol').$product->price }}</span>                                  
												@else
													<span class="new-price"> {{ config('settings.currency_symbol').$product->price }}</span>
												@endif
											</div>
                                        </div>
                                    </div>
                                </div>
							@endforeach
                            @endif	
                            @endif	
                            @if(!$cats->isEmpty() &&  isset($cats))
                            @foreach($cats as $cat)
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="product-style-03 margin-top-40">
                                       
                                                    <a href="/products/{{ $local }}">
                                            <div class="thumb">
                                               <img src="{{ asset('storage/'.$cat->image) }}" alt="">										   
                                            </div></a>
                                        
                                    <div class="content text-center">
                                    
                                       
                                        <h6 class="title mt-10"><a href="/products/{{ $local }}">{{ $cat->name }}</a></h6>
                                       
                                    </div>
                                </div>
                            </div>
                        @endforeach
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