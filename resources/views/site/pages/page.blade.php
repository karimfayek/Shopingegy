@extends('site.app')
@section('title',  $page->local_name)
@section('content')
@include('site.partials.breadcrumb', ['name' => $page->local_name])

<div id="content" class="site-content" role="main">
    <div class="page-about-us">
      
        <section class="section section-padding m-b-70">
            <div class="section-container">
                <!-- Block Banners -->
                <div class="block block-banners banners-effect">
                    <div class="block-widget-wrap">
                        <h3 class="box-title textRight">
                            {{$page->local_name}}
                         </h3>
                        <div class="block-content rtl">
                            {!! $page->LocalDescription !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @if ($page->slug == "about" || $page->slug == "about-us")
        <section class="section section-padding m-b-70">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="box-title textRight">
                        {{$mission->local_name}}
                     </h3>
                    <p class="box-description rtl">
                        {!! $mission->LocalDescription !!}
                    </p>
                </div>
                <div class="col-md-6">
                    <h3 class="box-title textRight">
                        {{$vision->local_name}}
                     </h3>
                    <p class="box-description rtl">
                        {!! $vision->LocalDescription !!}
                    </p>
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
            
        @endif


        

        
    </div>	
</div>
 <!-- about content start  -->
  
    <!-- about content end  -->

@stop
@push('scripts')


@endpush