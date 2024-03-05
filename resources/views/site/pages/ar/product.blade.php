@extends('site.appar')
@section('title', $product->name)
@section('content')
    <div class="sale-area">
        <div class="">
            <div class="row justify-content-center text-center">
                <div class="col-md-12">
                    <div class="sales-content-02" style="background: url('/assets/img/catbanner2.jpg') no-repeat center center/cover;background-attachment: fixed;">
                        <h2>{{ $product->name2 }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="row">
                <div class="col-sm-12">
                    @if (Session::has('message'))
                        <p class="alert alert-success">{{ Session::get('message') }}</p>
                    @endif
                </div>
</div>
<div class="collection-area margin-top-60" id="site">
        <div class="container">
            <div class="d-flex flex-row-reverse row">
                <div class="col-lg-9 col-md-12">
                    <div class="d-flex flex-row-reverse row">
					<div class="col-lg-5 col-md-6">
                            <div class="slider-tabfor margin-top-20">
							@if ($product->images->count() > 0)
									 @foreach($product->images as $image)
                                <div class="single-item">
                                    <img src="{{ asset('storage/'.$image->full) }}" alt="">
                                </div>
								
									@endforeach									
									@endif
                            </div>
							@if ($product->images->count() > 0)
                            <div class="slider-tabnav">
								 @foreach($product->images as $image)
                                <div class="single-item">
                                    <div class="img">
                                        <img src="{{ asset('storage/'.$image->full) }}" alt="">
                                    </div>
                                </div>
							@endforeach	
                            </div>
							@endif
                        </div>
                        <div class="col-lg-7 col-md-6">
                            <div class="content-part margin-top-20" style="
    direction: rtl;
    text-align: right;
">
                                <h3 class="product-title">{{ $product->name2 }}</h3>
								 @if ($product->sale_price > 0)
                                <p class="old-price" >{{ config('settings.currency_symbol') }}{{ $product->price }}</p>
                                <p class="price" id="productPrice" val="{{ $product->sale_price }}">{{ config('settings.currency_symbol') }}{{ $product->sale_price }}</p>
								@else									
                                <p class="price" id="productPrice" val="{{ $product->price }}">{{ config('settings.currency_symbol') }}{{ $product->price }}</p>
							@endif
                                <p class="specifications">كود: <b>{{ $product->sku }}</b></p>
                                <p class="specifications">وزن: <b>{{ $product->weight }}</b></p>
                                <p class="specifications">الماركة: <b>DasKind</b></p>
                                <p class="specifications">التوافر: <b class="color-green">متاح</b></p>
                                <div class="d-flex">
								@foreach($attributes as $attribute)
									@php
											$attributeCheck = in_array($attribute->id, $product->attributes->pluck('attribute_id')->toArray());									
									@endphp
									@if ($attributeCheck)
										<div class="form-group">
										<label>{{ $attribute->name }}:</label>
										<select class="form-control cart-select option @if($attribute->is_required == true ) required @endif " >
											 <option data-price="0"   disabled selected value> Select a {{ $attribute->name }}</option>
											@foreach($product->attributes as $attributeValue)
												@if ($attributeValue->attribute_id == $attribute->id)
													<option
														data-price="{{ $attributeValue->price }}"
														value="{{ $attributeValue->value }}"> {{ ucwords($attributeValue->value . ' +'. $attributeValue->price) }}
													</option>
												@endif
											@endforeach
										</select>
										</div>										
									@endif
								@endforeach
                                </div>
                                <div class="btn-wrapper d-flex">
								 <form action="{{ route('product.add.cart') }}" method="POST" role="form" id="addToCart" class="d-flex">@csrf
                                    <div class="input-group">
                                        <div class="input-group-prepend align-self-center">
                                            <a class="btn btn-sm" id="minus-btn"><i class="fa fa-minus"></i></a>
                                        </div>
										<input type="number" class="form-control text-right form-control-sm"  min="1" value="1" max="{{ $product->quantity }}" name="qty" id="qty_input" >
										<input type="hidden" name="productId" value="{{ $product->id }}">
										<input type="hidden" name="price" id="finalPrice" value="{{ $product->sale_price != '' ? $product->sale_price : $product->price }}">
                                        
                                        <div class="input-group-prepend align-self-center">
                                            <a class="btn btn-sm" id="plus-btn"><i class="fa fa-plus"></i></a>
                                        </div>
                                    </div>
                                    <div class="add-to-cart">
									 <button type="submit" class="icon-add-to-cat" style="background: transparent;  border: 0;  color: #fff;">اضف الى السلة</button>
                                    </div>
									</form>
                                </div>
                                <div class="d-flex">
                                    <span class="specifications">مشاركة :</span>
                                  <ul class="social-list">
                                        <li><a href="http://www.facebook.com/sharer.php?u={{url('/')}}/product/{{$product->slug}}/ar"><i class="fa fa-facebook-f"></i></a></li>
                                        <li><a href="https://twitter.com/intent/tweet?url={{url('/')}}/product/{{$product->slug}}/ar"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="https://pinterest.com/pin/create/button/?url={{url('/')}}/product/{{$product->slug}}/ar"><i class="fa fa-pinterest"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product-tab" style="
    direction: rtl;
    text-align: right;
">
                                <ul class="nav nav-pills">
                                  <li><a data-toggle="pill" href="#home" class="active">الوصف</a></li>
                                </ul>
                                
                                <div class="tab-content">
                                  <div id="home" class="tab-pane fade in show active">
                                    {!! $product->description2 !!}
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="widget delivery-widget margin-top-20" style="
    direction: rtl;
    text-align: right;
">
                        <div class="single-delivery-item">
                            <div class="d-flex">
                                <i class="icon-delivery-car"></i>
                                <h4>التوصيل</h4>
                            </div>
                            <span>توصيل مجانى للطلبات اعلى من 500 جنية</span>
                        </div>
                        <div class="single-delivery-item">
                            <div class="d-flex">
                                <i class="icon-phone-support"></i>
                                <h4>دعم 24 ساعة</h4>
                            </div>
                            <span>اتصل بنا 24 ساعه فى اليوم , 7 ايام فى الاسبوع</span>
                        </div>
                        <div class="single-delivery-item">
                            <div class="d-flex">
                                <i class="icon-money-back"></i>
                                <h4>مرتجع</h4>
                            </div>
                            <span>استرجع ببساطة خلال 30 يوم</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@push('scripts')
    <script>
	

        $(document).ready(function () {
			
            $('#addToCart').submit(function (e) {
				var isAllBlank = true;
				$(".required").each(function() {
					if($(this).val() != null) {
						isAllBlank = false;
							return true;
							
					}
					else{
						e.preventDefault();
						alert('Please select an option');
						return false;
					}
				});
            });
			
			var pprice = "{{ $product->sale_price != '' ? $product->sale_price : $product->price }}";
            $('.option').change(function () {				
                $('#productPrice').html(pprice);
                let extraPrice = $(this).find(':selected').data('price');
                let price = parseFloat($('#productPrice').html());
                let finalPrice = (Number(extraPrice) + price).toFixed(2);
                $('#finalPrice').val(finalPrice);
                $('#productPrice').html(finalPrice);
				 pprice = finalPrice;
            });
        });
    </script>
@endpush
