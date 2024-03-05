@extends('site.appar')
@section('title', 'Checkout')
@section('content')
   <div class="sale-area">
        <div class="">
            <div class="row justify-content-center text-center">
                <div class="col-md-12">
                    <div class="sales-content-02" style="background: url('') no-repeat center center/cover;background-attachment: fixed;">
                        <h2>طلب منتج</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="section-content bg padding-y">
        <div class="container">
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
            <form action="/placeorder" method="POST" role="form">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <header class="card-header">
                                <h4 class="card-title mt-2">معلومات التوصيل</h4>
                            </header>
                            <article class="card-body">
                                <div class="form-row">
                                    <div class="col form-group">
                                        <label>الاسم بالكامل</label>
                                        <input type="text" class="form-control"  name="name" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>العنوان</label>
                                    <input type="text" class="form-control"  name="address" required="required">
                                </div>
								<div class="form-group ">
									<label>رقم التليفون</label>
									<input type="text" class="form-control" name="phone" required="required">
								</div>
                                <div class="form-group">
                                    <label>البريد الالكترونى</label>
                                    <input type="email" class="form-control" name="email"  >
                                    <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                                </div>
                                <div class="form-group">
                                    <label>ملحوظات للطلب</label>
                                    <textarea class="form-control" name="message" rows="6"></textarea>
                                </div>
                            </article>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <header class="card-header">
                                        <h4 class="card-title mt-2">Your Order</h4>
                                    </header>
                                    <article class="card-body">
                                        <dl class="dlist-align">
                                            <dt>Total cost: </dt>
                                            <dd class="text-right h5 b"> {{ config('settings.currency_symbol') }}{{ \Cart::getSubTotal() }} </dd>
                                        </dl>
                                    </article>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4">
                                <button type="submit" class="subscribe btn btn-success btn-lg btn-block">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
			@else
			<h3 class="m-4 team-area">Cart Empty</h3>
			@endif
        </div>
    </section>
@stop
