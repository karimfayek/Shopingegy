

@extends('site.app')
@section('title', $category->name)
@push('styles')
@if ($pagproducts->count() <  1 )
<script title="OnlineWebFonts" src="/js/animations.js" type="text/javascript"></script>

@endif
@endpush
@section('content')
@include('site.partials.breadcrumb', ['name' => $category->local_name , 'cat' => 'yes'])


  


<div id="content" class="site-content" role="main">
    <div class="section-padding">
        <div class="section-container p-l-r">
            @if ($pagproducts->count() > 0)
            <div class="row"   id="cat-products" data-slug="{{ $category->slug }}">
                
            </div>
            @else

            <div style="
            margin: auto;
            text-align: center;
            font-weight: bold;
        ">
                
                <p>{{ $heading['noproductsyet'] }}</p>
                <div class="noPRs" style="
                width: 33%;
                margin: auto;
            "></div>
            </div>

            @endif
        </div>
    </div>
</div>

    @if ($local == "ar")
    <style>
        .products-entry .col-md-8 {
            text-align: right
        }
    </style>
        
    @endif
    <!-- collection area end  -->
@push('scripts')

@if ($pagproducts->count() <  1 )
<script>
    OnlineWebFonts_Com({
    'Id':'.noPRs',
    'Data':__Animations['352782'],
}).Play();
</script>
@endif
@endpush
@stop