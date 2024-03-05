@if(\Session::get('local') == 'en')
@include('auth.passwords.email-ar')
@else

@extends('site.app')

@section('content')

@include('site.partials.breadcrumb', ['name' => 'Reset Password'])
  
  <div class="hero-content  text-center"><h1 class="text-uppercase mt-4">Reset password</h1>
    <div><div class="col-xl-8 offset-xl-2"></div></div></div>
<section class="section  bg-transparent novi-background">
    <div class="row justify-content-center">
        <div class="col-md-8 m-5">
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

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
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@endif