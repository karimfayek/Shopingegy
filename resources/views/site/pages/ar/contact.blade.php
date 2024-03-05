@extends('site.appar')
@section('title', 'about')
@section('content')

    <div class="sale-area">
        <div class="">
            <div class="row justify-content-center text-center">
                <div class="col-md-12">
                    <div class="sales-content-02" style="background: url('/assets/img/catbanner2.jpg') no-repeat center center/cover;background-attachment: fixed;">
                        <h2>اتصل بنا</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
	    @if (\Session::has('success'))
    <div class="alert alert-success alert-dismissible text-center" role="alert">
        <button class="close" type="button" data-dismiss="alert">×</button>
        <strong>Success!</strong> {{ \Session::get('success') }}
    </div>
 @endif
 <!-- about content start  -->
     <div class="mapouter">
        <div class="gmap_canvas">
            {!! config('settings.map') !!}
        </div>
    </div>
    

    <!-- contact area start  -->
    <div class="contact-info margin-top-80">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h3>اتصل بنا لأى استفسارات</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="single-contact-box">
                        <div class="icon">
                            <i class="icon-call-header"></i>
                        </div>
                        <a> {{ config('settings.phones') }}</a><br>
                        <span>التليفون</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-contact-box">
                        <div class="icon">
                            <i class="fa fa-envelope-open"></i>
                        </div>
                        <a href="mailto: {{ config('settings.default_email_address') }}"> {{ config('settings.default_email_address') }}</a><br>
                        <span>البريد الالكترونى</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-contact-box">
                        <div class="icon">
                            <i class="fa fa-map-marker"></i>
                        </div>
                        <span>
                          {!! config('settings.address') !!} <br> العنوان
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contact area end  -->

    <!-- contact form start  -->
    <div class="contact-form text-center padding-top-80 padding-bottom-80">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="/contactm"> @csrf
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <input type="text" class="form-control" id="name" placeholder="Name*" name="name" required>
                          </div>
                          <div class="form-group col-md-6">
                            <input type="number" class="form-control" id="phone" placeholder="Phone*" name="phone" required>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-12">
                            <input type="email" class="form-control" id="email" placeholder="Email*" name="email" >
                          </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                              <textarea name="message" id="message" rows="8" placeholder="Message" name="message" required></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-contact">ارسل رسالة</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- contact form end  -->
@stop
