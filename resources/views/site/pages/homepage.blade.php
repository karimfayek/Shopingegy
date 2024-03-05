@extends('site.app')
@section('title', 'Homepage')
@push('styles')
    <style>
        .section.p-t-70 {
    padding-top: 5%;
}
[class~=m-b-70] {
    margin-bottom: 5%;
}
body {
    min-height: 100vh;
}
body section {
    min-height: 300px;
    width: 100%
}
.header-right{
    min-width: 290px;
    min-height: 30px;
}
.site-navigation{
    min-width: 23%;
    min-height: 20px;
}
    </style>
@endpush
@section('content')
<div id ="brand"></div>
            <div id="content" class="site-content" role="main">
                <section class="section">
                    <!-- Block Sliders -->
                    <div class="block block-sliders">
                        <div class="slick-sliders" id="homeBanners">
                            
                           
                        </div>
                    </div>
                </section>

                   <!--  Categories -->

                <section class="section section-padding  p-t-70 m-b-70">
                    <div class="section-container">
                        <!-- Block Product Categories -->
                        <div class="block block-product-cats slider">
                            <div class="block-widget-wrap">
                                <div class="block-title"><h2>{{ $heading['shopbydept'] }}</h2></div>
                                <div class="block-content">
                                    <div class="product-cats-list slick-wrap">
                                        <div class="slick-sliders content-category" id="home-cats">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Categories -->
                
 
    <div  id="Rprs">

    </div>

     

<section class="section background-2 no-space m-b-70">
    <div class="row">
        
        <div class="col-lg-6 mt-5">
            <!-- Block Newsletter -->
            <div class="block block-newsletter position-center">
                <div class="newsletter-wrap">
                    <div class="sub-title">{{ $heading['nlsub'] }}</div>
                    <div class="title">{{ $heading['nltext'] }}</div>
                    <div  id="subscription-form-1" class="newsletter-content newsletter-form">
                        <span class="your-email">
                            <input id="email-1" type="email" name="email" value="" size="40" aria-required="true" placeholder="{{ $heading['email'] }}">
                        </span>
                        <span class="clearfix">
                            <input type="submit" class="btn-submit" data-form-id="subscription-form-1"  value="{{ $heading['subscribe'] }}">
                        </span>
                    </div>
                    <div class="mailchimp-success" id="success-message-1" style="
                    margin-top: 8px;
                    border: 1px solid green;
                    padding: 10px;
                    font-weight: bold;
                    letter-spacing: 1px;
                    display:none
                "></div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section section-padding m-b-70">
    <div class="section-container">
        <!-- Block Feature -->
        <div class="block block-feature">
            <div class="block-widget-wrap">
                <div class="row lg-m-lr">
                    @foreach($whys as $why)
                    <div class="col-lg-3 col-md-6 col-sm-6 md-b-15 lg-p-lr">
                        <div class="box">
                            <div class="box-icon">
                                <span class="{{ $why->icon }}">
                                    
                                </span>
                            </div>
                            <div class="box-title-wrap">
                                <h3 class="box-title">
                                   {{$why->local_name}}
                                </h3>
                                <p class="box-description rtl">
                                    {{ strip_tags($why->LocalDescription) }}
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
</div><!-- #content -->
        

      
   
@stop
@push('scripts')


    
@endpush