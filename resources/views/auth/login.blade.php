@extends('site.app')
@section('title', 'Login')
@section('content')
<style>
    .input-text.is-invalid {
        border-color: red;
    }
    .invalid-feedback{
        display: block;
    }
    .page-login-register .row{
        justify-content: center;
    }
</style>
<div id="content" class="site-content" role="main">
    <div class="section-padding">
        <div class="section-container p-l-r">
            <div class="page-login-register">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 sm-m-b-50">
                        <div class="box-form-login" style="padding-top: 18%; border: none;  ">
                            <h2>{{ $heading['login'] }}</h2>
                            <div class="box-content">
                                <div class="form-login">
                                    <form method="post" class="login"  action="{{ route('login') }}">
                                        @csrf
                                        <div class="username">
                                            <label>{{ $heading['email'] }} <span class="required">*</span></label>
                                            <input type="text" class="input-text @error('email') is-invalid @enderror" name="email" id="username"  value="{{ old('email') }}">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="password">
                                            <label for="password">{{ $heading['password'] }} <span class="required">*</span></label>
                                            <input class="input-text @error('password') is-invalid @enderror" type="password" name="password" >
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="rememberme-lost">
                                            <div class="remember-me">
                                                <input name="remember" type="checkbox"  name="remember" id="remember" checked>
                                                <label class="inline">Remember me</label>
                                            </div>
                                            <div class="lost-password">
                                                <a   href="{{ route('password.request') }}">Lost your password?</a>
                                            </div>
                                        </div>
                                        <div class="button-login">
                                            <input type="submit" class="button" name="login" value="Login"> 
                                        </div>
                                    </form>
                                </div>
                                <div class="border-top card-body text-center mt-4">
                                    <div class="accent-box-text  group-15">
                                       
                                        <div>Haven’t an account? 
                                                <u class="font-italic font-weight-bold legend">
                                                    <a class="link-inherit" href="{{ route('register') }}">Sign up here.</a>
                                                </u>
                                        </div>
                                      
                                    </div>
                                  
                                 
                                </div>
                            </div>
                        </div>
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
</div>
    
    
@stop
