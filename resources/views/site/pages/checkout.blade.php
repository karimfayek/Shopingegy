@extends('site.app')
@section('title', $heading['checkout'])
@push('styles')
<style>
    .shop-cart-empty .return-to-shop .button:before {
    content: "\23";
    font-size: 18px;
    font-family: ElegantIcons;
    margin: 0 5px 0 0;
    position: relative;
    top: 3px;
}
</style>

@endpush
@section('content')
@include('site.partials.breadcrumb', ['name' => $heading['checkout']])


<div id="content" class="site-content" role="main">
    <div class="section-padding">
        <div class="section-container p-l-r">
            <div class="row">
                <div class="col-sm-12">
                    @if (Session::has('error'))
                        <p class="alert alert-danger">{{ Session::get('error') }}</p>
                    @endif
					@if (Session::has('success'))
                        <p class="alert alert-success">{{ Session::get('success') }}</p>
                    @endif
                </div>
            </div>

            @if($cartCount > 0)
          <div class="shop-checkout rtl textRight" id="checkout"></div>
			@else
			<div className="shop-cart-empty" >
                <div className="notices-wrapper">
                  <p className="cart-empty" style="border-top: 3px solid #000;
                  text-transform: capitalize;
                  padding: 12px 22px;
                  margin: 0 0 24px;
                  position: relative;
                  background-color: #f7f6f7;
                  color: #515151;
                  list-style: none outside;
                  width: auto;
                  word-wrap: break-word;
                  width: 100%;">Cart is currently empty.</p>
                </div>
                <div className="return-to-shop">
                  <a className="button" href="/products" style="line-height: 34px;
                  background: #000;
                  color: #fff;
                  padding: 0 20px;
                  display: inline-block;
                  text-transform: uppercase;
                  font-size: 12px;
                  font-weight: 700;
                  height: 40px;">
                    Return to shop
                  </a>
                </div>
              </div>

             
			@endif
            
        </div>
    </div>
</div>
   
@stop
