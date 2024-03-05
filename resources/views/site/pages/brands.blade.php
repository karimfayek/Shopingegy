

@extends('site.app')
@section('title', 'Brands')

@section('content')
 
<section class="section section-sm bg-transparent novi-background" data-preset='{"title":"Breadcrumb","category":"breadcrumb","reload":false,"id":"breadcrumb-6"}'>
    <div class="container">
            <!-- Breadcrumb-->
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a class="breadcrumb-link" href="/">Home</a></li>
              <li class="breadcrumb-item"><a class="breadcrumb-link" href="#">Brands</a></li>
            </ul>
    </div>
  </section>
  <!-- Grid view-->
  
     <h1 class="text-center">Brands</h1>
     
    <section class="section section-sm bg-transparent novi-background">
 <div class="row row-offset-xl row-30 row-md-40">
     @foreach($brands as $brand)
        <div class="col-xs-4 col-md-3" data-animate='{"class":"fadeInUp"}'>
                <!-- Thumbnail louis-->
                <figure class="thumbnail thumbnail-louis novi-background"><img class="thumbnail-louis-image" src="/storage/{{$brand->logo}}" alt="{{$brand->name}}" width="180" height="49"/>
                  <figcaption class="thumbnail-louis-caption novi-background">
                    <div class="group-20 d-flex justify-content-between">
                      <div class="thumbnail-louis-title">{{$brand->name}}</div><a class="link" href="/brand/{{$brand->slug}}">View Products<span class="link-icon int-arrow-right novi-icon"></span></a>
                    </div>
                  </figcaption>
                </figure>
        </div>
        @endforeach
      </div>
    </section>
@stop