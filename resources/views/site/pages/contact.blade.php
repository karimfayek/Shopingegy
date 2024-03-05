@extends('site.app')
@section('title', $heading['contact'])
@section('content')

@include('site.partials.breadcrumb', ['name' =>$heading['contact'] ])
  
		   
 <!-- about content start  -->
 <div id="content" class="site-content" role="main">
    @if (\Session::has('success'))
    <div class="alert alert-success alert-dismissible text-center" role="alert">
        <button class="close" type="button" data-dismiss="alert">×</button>
        <strong>Success!</strong> {{ \Session::get('success') }}
    </div>
 @endif
    <div class="page-contact">
        <section class="section section-padding">
            <div class="section-container small">
                <!-- Block Contact Map -->
                <div class="block block-contact-map">
                    <div class="block-widget-wrap">
                        {!! config('settings.map') !!}
                    </div>
                </div>
            </div>
        </section>	

        <section class="section section-padding m-b-70">
            <div class="section-container">
                <!-- Block Contact Info -->
                <div class="block block-contact-info">
                    <div class="block-widget-wrap">
                        <div class="info-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="svg-icon2 plant" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><path xmlns="http://www.w3.org/2000/svg" d="m320.174 28.058a8.291 8.291 0 0 0 -7.563-4.906h-113.222a8.293 8.293 0 0 0 -7.564 4.907l-66.425 148.875a8.283 8.283 0 0 0 7.564 11.655h77.336v67.765a20.094 20.094 0 1 0 12 0v-67.765h27.7v288.259h-48.441a6 6 0 0 0 0 12h108.882a6 6 0 0 0 0-12h-48.441v-288.259h117.04a8.284 8.284 0 0 0 7.564-11.657zm-103.874 255.567a8.094 8.094 0 1 1 8.094-8.093 8.1 8.1 0 0 1 -8.094 8.093zm-77.61-107.036 63.11-141.437h108.4l63.11 141.437z" fill="" data-original="" style=""></path></g></svg>
                        </div>
                        <div class="info-title">
                            <h2>{{ $heading['needhelp'] }}</h2>
                        </div>
                        <div class="info-items">
                            <div class="row">
                                <div class="col-md-4 sm-m-b-30">
                                    <div class="info-item">
                                        <div class="item-tilte">
                                            <h2>{{ $heading['phone'] }}</h2>
                                        </div>
                                        <div class="item-content">
                                            {!! config('settings.phones') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 sm-m-b-30">
                                    <div class="info-item">
                                        <div class="item-tilte">
                                            <h2>{{ $heading['address'] }}</h2>
                                        </div>
                                        <div class="item-content">
                                            <p> {!!$address !!} </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="info-item">
                                        <div class="item-tilte">
                                            <h2>{{ $heading['email'] }}</h2>
                                        </div>
                                        <div class="item-content small-width">
                                            {!! config('settings.default_email_address') !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section section-padding contact-background m-b-0">
            <div class="section-container small">
                <!-- Block Contact Form -->
                <div class="block block-contact-form">
                    <div class="block-widget-wrap">
                        <div class="block-title">
                            <h2>{{ $heading['getintouch'] }}</h2>
                        </div>
                        <div class="block-content">
                            <form action="/contactm" method="post" class="contact-form" >
                                @csrf
                                <div class="contact-us-form">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <label class="required">{{ $heading['name'] }}</label><br>
                                            <span class="form-control-wrap">
                                                <input type="text" name="name" value="" size="40" class="form-control" aria-required="true" required>
                                            </span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <label class="required">{{ $heading['email'] }}</label><br>
                                            <span class="form-control-wrap">
                                                <input type="email" name="email" value="" size="40" class="form-control" aria-required="true" required>
                                            </span>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <label class="required">{{ $heading['phone'] }}</label><br>
                                            <span class="form-control-wrap">
                                                <input type="text" name="phone" value="" size="40" class="form-control" aria-required="true" required>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label class="required">{{ $heading['message'] }}</label><br>
                                            <span class="form-control-wrap">
                                                <textarea name="message" cols="40" rows="10" class="form-control" aria-required="true" required></textarea>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-button">
                                          <input type="submit" value="{{ $heading['send'] }}" class="button">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

    

    
    <!-- contact form end  -->
@stop
