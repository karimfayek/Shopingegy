@extends('site.app-ar')

@section('content')


    <div class="page-banner-section section" style="background-image: url(assets/images/hero/hero-1.jpg);direction: rtl;text-align: right;">
        <div class="container">
            <div class="row">
                <div class="page-banner-content col">

                    <h1>استرجاع الباسورد</h1>
                    <ul class="page-breadcrumb">
                        <li><a href="/ar">الرئيسية</a></li>
                        <li><a href="#">استرجاع الباسورد</a></li>
                    </ul>

                </div>
            </div>
        </div>
    </div><!-- Page Banner Section End -->
<div style="
    background: #fff;
">
    <div class="row justify-content-center">
        <div class="col-md-8 m-5">
            <div class="card">
                <div class="card-header">{{ __('استرجاع الباسورد') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('البريد الالكترونى') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('ارسل رابط استرجاع الباسورد') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
