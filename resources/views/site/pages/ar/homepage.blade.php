@extends('site.appar')
@section('title', 'Homepage')
@section('content')
        <!-- banner start -->
   <div class="banner-style-01">                
        <div class="banner-slider">
		
		@foreach($banners as $banner)
            <div>
                <div class="height__100vh d-flex align-items-center" style="background: url('{{ asset('uploads/'.$banner->full) }}') no-repeat center center/cover">
                    <div class="container-fluid px-5">
                        <div class="banner-content">
						
                            <h2 class="title color-white" data-animation-in="fadeInRight">{{$banner->namear}}</h2>
                            <div class="margin-top-50 pl-1">
                                <div class="btn-wrapper" data-animation-in="fadeInDown">
                                    <a class="btn btn-white" href="/{{$banner->url}}/ar">عرض</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endforeach
        </div>
    </div>
    <!-- banner end -->
		
    <!-- collection banner start  -->
    <div class="collection-banner margin-bottom-80">
        <div class="container">
            <div class="row collection-slider-03">
			
		@foreach($categories as $cat)
		@foreach($cat->items as $category)
		@if($loop->iteration % 2 == 0)
                <div class="col-lg-12">
                    <div class="collection-style-04 margin-top-30">
					<a href="{{ route('category.show2', $category->slug) }}">
                        <div class="thumb">
                            <img src="{{ asset('storage/'.$category->image) }}" alt="">
                        </div>
						</a>
                        <div class="content">
                            <h3>{{ $category->name2 }}<br> </h3>
                            <div class="btn-wrapper">
                                <a href="{{ route('category.showar', $category->slug) }}" class="btn btn-collection2">تسوق الآن</a>
                            </div>
                        </div>
                    </div>
                </div>
				@else
                <div class="col-lg-12">
                    <div class="collection-style-04 margin-top-30">
                        <div class="content">
                            <h3>{{ $category->name2 }}<br> </h3>
                            <div class="btn-wrapper">
                                <a href="{{ route('category.showar', $category->slug) }}" class="btn btn-collection2">تسوق الآن</a>
                            </div>
                        </div>
					<a href="{{ route('category.showar', $category->slug) }}">
                        <div class="thumb">
                            <img src="{{ asset('storage/'.$category->image) }}" alt="">
                        </div></a>
                    </div>
                </div>
				@endif
				
									@endforeach
								@endforeach
            </div>
        </div>
    </div>
    <!-- collection area end  -->
<style>
.product-style-01 .thumb  {
    position: relative;
    overflow: hidden;
}
.product-style-01 .thumb:after {
    position: absolute;
    content: '';
    width: 100%;
    height: 100%;
    left: 0;
    top: 0;
    background: #558a1c12;
}
.product-style-01 .thumb img {
    min-height: 191px;
    padding: 30px;
    -o-object-fit: cover;
    object-fit: cover;
    -webkit-transition: all 3.5s ease 0s;
    -o-transition: all 3.5s ease 0s;
    transition: all 3.5s ease 0s;
}
.product-style-01:hover .thumb img {
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
<hr>
    <!-- tranding area start  -->
    <div class="tranding-area margin-top-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h3>اخر المنتجات</h3>
                    </div>
                </div>
            </div>
			
			
            <div class="tab-content">
                <div class="tab-pane fade in show active" id="one">
                    <div class="row">
					@foreach($featured as $item)
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="product-style-01 margin-top-40">
							 <a href="{{ route('product.showar', $item->slug) }}">
                                <div class="thumb">
                                   <img src="{{ asset('storage/'.$item->images->first()['full']) }}" alt="">
									@if($item->sale_price > 0)
                                    <span class="sale">Sale {{(($item->price - $item->sale_price)*100) /$item->price }}%</span>
									@endif
									@if($item->quantity < 1 )
                                    <span class="out @if($item->sale_price > 0) margin-top-35 @endif">نفذت الكمية</span>
									@endif

                                </div></a>
                                <div class="content text-center">
                                    <div class="content-bottom mt-3">
                                        <span class="brand">BRAND:{{$item->brand->name}}</span>
                                        <h6 class="title"><a href="#">{{$item->name2}}</a></h6>
                                        <div class="content-price d-flex align-self-center justify-content-center">
										@if($item->sale_price > 0)
											<span class="old-price mr-2">L.E {{$item->price}}</span>
											<span class="new-price">L.E {{$item->sale_price}}</span>
										@else												
											<span class="new-price">L.E {{$item->price}}</span>
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
    <!-- tranding area end  -->
	<hr>

    <!-- sale area end  -->



    <!-- contact area start  -->
<div class="contact-area grey-bg margin-top-30">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="contact-content-02 text-center padding-top-70 padding-bottom-80">
                        <h2>Keep Connected</h2>
                        <h6>Get updates by subscribe our weekly newsletter</h6>
                         <form action="/contactm" method="POST" id="subscribe">@csrf
                            <div class="form-row align-items-center justify-content-center">
                              <div class="col-md-10 col-sm-12 col-12">
                                <div class="input-group">
                                  <input type="hidden" name="name" value = "">
                                  <input type="hidden" name="phone" value = "">
                                  <input type="hidden" name="message" value = "">
                                  <input type="text" class="form-control" id="inlineFormInputGroup"  name="email" placeholder="EMAIL ADDRESS">
                                  <div class="subscribe-text" style="    right: -64px;"> <a id="submit" ><i class="icon-arrow-point-to-right"></i></a></div>
                                </div>
                              </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contact area end  -->
@stop
@push('scripts')
<script>
document.getElementById("submit").onclick = function() {
    document.getElementById("subscribe").submit();
}
</script>
@endpush