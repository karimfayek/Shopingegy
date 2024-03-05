

@extends('site.appar')
@section('title', $category->name)
@section('content')

    <div class="sale-area">
        <div class="">
            <div class="row justify-content-center text-center">
                <div class="col-md-12">
                    <div class="sales-content-02" style="background: url('{{ asset('storage/'.$category->image) }}') no-repeat center center/cover;background-attachment: fixed;">
                        <h2>{{ $category->name2 }}</h2>
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
			@if($category->children->count() > 0)
				<div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12 margin-top-20">
                   
                    <div class="widget categories-widget">
                        <div class="accordion-style-2" id="accordionExample1">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <p class="mb-0">
                                        <a href="#" role="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="">تصنيفات فرعية </a>
                                    </p>
                                </div>
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample1" style="">
                                    <div class="card-body">
									
											@foreach($category->children as $item)
                                            <div class="custom-control custom-checkbox mb-3">
											<a href="/category2/{{$item->slug}}/ar">
                                              {{$item->name2}}
											  </a>
                                            </div>
											@endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
				@endif
                <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="tab-content">
                        <div class="tab-pane fade in show active" id="one">
                            <div class="d-flex flex-row-reverse row">
								@forelse($pagproducts as $product)
                                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="product-style-03 margin-top-40">
											@if ($product->images->count() > 0)
														<a href="{{ route('product.showar', $product->slug) }}">
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
                                            <h6 class="title"><a href="{{ route('product.showar', $product->slug) }}">{{ $product->name2 }}</a></h6>
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
								@empty
								 <p>No Products found in {{ $category->name2 }}.</p>
							@endforelse
									
                            </div>
                        </div>
						
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-between pagination">
                                <h6>Showing {{$pagproducts->firstItem()}} to {{$pagproducts->lastItem()}} of {{$pagproducts->total()}} products </h6>
                                <ul>
								 {{ $pagproducts->links() }}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
				
            </div>
        </div>
    </div>
    <!-- collection area end  -->


@stop