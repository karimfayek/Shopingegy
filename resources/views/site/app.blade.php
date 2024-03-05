<!DOCTYPE HTML>
<html lang="{{ $local }}" >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="shortcut icon" href="{{ asset('storage/'.config('settings.site_favicon')) }}" type="image/x-icon">  
    <title>@yield('title') - {{ config('settings.site_name') }}</title>
    <meta name="title" content="{{config('settings.seo_meta_title')}}">
	<meta name="description" content="{!! strip_tags(config('settings.seo_meta_description')) !!}">
	<meta name="keywords" content="Marshal, bedroom, sofa , dining room ">
<meta name="developer" content="Karim Malak">
	<meta name="robots" content="index, follow">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="{{ $local == 'en' ? 'English' : 'Arabic' }}" >
	<meta name="revisit-after" content="2 days">

	<!-- Open Graph / Facebook -->
	<meta property="og:type" content="website">
	<meta property="og:url" content="{{url('/')}}">
	<meta property="og:title" content=" {{ config('settings.site_name') }}">
	<meta property="og:description" content="{!! strip_tags(config('settings.seo_meta_description')) !!}">
	<meta property="og:image" content="">

	<!-- Twitter -->
	<meta property="twitter:card" content="summary_large_image">
	<meta property="twitter:url" content="{{url('/')}}">
	<meta property="twitter:title" content="{{ config('settings.site_name') }}">
	<meta property="twitter:description" content="{!! strip_tags(config('settings.seo_meta_description')) !!}">
	<meta property="twitter:image" content="">
	<link rel="icon" href="/images/ico.png" type="image/x-icon">
	<script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "Organization",
          "url": "{{url('/')}}",
          "name": "{{ config('settings.site_name') }}",
          "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "{{config('settings.mobile')}}",
            "contactType": "Customer service"
          }
        }
        </script>
        
	<!-- Styles -->
      @stack('styles')     
    @include('site.partials.styles')
    <style>
        .item-info .content {
    background: #0000002e;
    padding: 17px;
}
.block-sliders .item-content .item-info .subtitle-slider {
    color: #fff;
}

.item-info .content .title-slider {
    color: #fff;
}
.block-sliders .item-content .item-info .description-slider {
    color: #fff;
}
.block-sliders .item-content .item-info .title-slider, [class~=block-sliders][class~=layout-3] [class~=item-content] [class~=item-info] [class~=title-slider] {
    font-weight: 400;
}
    </style>
</head>
<body class="home">
    <div id="page" class="hfeed page-wrapper">
    <!-- header -->
    @include('site.partials.header')
	
	<!-- content -->
    
<div id="site-main" class="site-main">
    <div id="main-content" class="main-content">
        <div id="primary" class="content-area">

	      @yield('content')
            
        </div><!-- #primary -->
    </div><!-- #main-content -->
</div><!-- #site main -->   


	<!-- footer -->
    @include('site.partials.footer')
</div><!-- page-wrapper -->

	<!-- scripts -->
	@include('site.partials.scripts')
   
 
</body>
</html>
