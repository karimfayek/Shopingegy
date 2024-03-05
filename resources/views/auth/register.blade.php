
@extends('site.app')
@section('title', $heading['register'])
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .form-row{
        justify-content: flex-end
    }
    .form-row label{
        direction : rtl
    }
    .invalid-feedback{
        display: block !important
    }
</style>
@endpush
@section('content')

@include('site.partials.breadcrumb', ['name' => $heading['register']])
<section class="section section-padding contact-background m-b-0">
    <div class="section-container small">
        @if($errors)
        @foreach ($errors as $error )
           <li>{{ $error }}</li> 
        @endforeach
        @endif
        <div class="shop-checkout">
            <form name="checkout" method="post" class="checkout" action="{{ route('register') }}" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="customer-details">
                            <div class="billing-fields">
                                
                                <div class="billing-fields-wrapper row">
                                    <p class="form-row form-row-first validate-required col-6">
                                        <label>{{ $heading['firstname'] }} <span class="required" title="required">*</span></label>
                                        <span class="input-wrapper">
                                            <input type="text" class="input-text" name="first_name" value="{{ old('first_name') }}">
                                        </span>
                                        @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </p>
                                    <p class="form-row form-row-last validate-required col-6">
                                        <label>{{ $heading['lastname'] }} <span class="required" title="required">*</span></label>
                                        <span class="input-wrapper"><input type="text" class="input-text" name="last_name" value="{{ old('last_name') }}"></span>
                                        @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </p>
                                    
                                    <p class="form-row form-row-wide validate-required col-12">
                                        <label>{{ $heading['city'] }}<span class="required" title="required">*</span></label>
                                        <span class="input-wrapper">
                                            <select name="city" class="country-select custom-select">
                                                <option value> Choose...</option>
                                                @foreach ($states as $state)
                                                <option value="{{ $state->id }}" @if( old('city') == $state->id  ) selected @endif>{{ $state->LocalName }}</option>
                                                 @endforeach
                                            </select>
                                        </span>
                                        @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </p>
                                    <p class="form-row address-field validate-required form-row-wide col-12">
                                        <label>{{ $heading['address'] }} <span class="required" title="required">*</span></label>
                                        <span class="input-wrapper">
                                            <input type="text" class="input-text" name="address" placeholder="House number and street name" value="{{ old('address') }}">
                                        </span>
                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </p>
                                 
                                   
                                    <p class="form-row form-row-wide validate-required validate-phone col-6">
                                        <label>{{ $heading['phone'] }} <span class="required" title="required">*</span></label>
                                        <span class="input-wrapper">
                                            <input type="tel" class="input-text" name="phone" value="{{ old('phone') }}">
                                        </span>
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </p>
                                    <p class="form-row form-row-wide validate-required validate-email col-6">
                                        <label>{{ $heading['email'] }} <span class="required" title="required">*</span></label>
                                        <span class="input-wrapper">
                                            <input type="email" class="input-text" name="email" value="{{ old('email') }}" autocomplete="off">
                                        </span>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </p>
                                    <p class="form-row validate-required col-6">
                                        <label>{{ $heading['password'] }} <span class="required" title="required">*</span></label>
                                        <span class="input-wrapper password-input">
                                            <input type="password" class="input-text @error('password') is-invalid @enderror" name="password" value="" autocomplete="off">
                                            <span class="show-password-input"></span>
                                        </span>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </p>
                                    <p class="form-row validate-required col-6">
                                        <label>{{ $heading['password'] }} <span class="required" title="required">*</span></label>
                                        <span class="input-wrapper password-input">
                                            <input type="password" class="input-text  @error('password_confirmation') is-invalid @enderror" name="password_confirmation" value="" autocomplete="off">
                                            <span class="show-password-input"></span>
                                        </span>
                                    </p>
                                </div>
                            </div>
                           
                        </div>
                        
                        
                    </div>
                
                </div>
                
                <div class="form-group mt-4 mb-3">
                    <button type="submit" class="bg-dark btn btn-block button p-3 text-light"> {{ $heading['register'] }} </button>
                </div>
                
           
        <div class="border-top card-body text-center">Have an account? <a href="{{ route('login') }}">{{ $heading['login'] }}</a></div>
            </form>
        </div>
        <!-- Block Contact Form -->
        
    </div>
</section>
    <section class="section section-lg bg-transparent novi-background">
        <div class="container">
            
                </div>
            </div>
        </div>
    </section>
@stop
@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
   <script>
    jQuery(document).ready(function($) {
    $('.custom-select').select2();
});
    </script> 
@endpush
