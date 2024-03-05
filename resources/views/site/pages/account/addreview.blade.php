@extends('site.app')
@section('title', 'Orders')
@section('content')
@if ($local == 'ar')
<style>
   .form-select {
    display: block;
    padding: 0.6rem 2.25rem 0.6rem 0.75rem;
    -moz-padding-start: calc(.75rem - 3px);
    font-size: .9rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    background-color: #fff;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 16px 12px;
    border: 1px solid #ced4da;
    border-radius: 0;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}
.shop-details .product-tabs .product-reviews .comment-list li .comment-container .comment-text{
  padding-left: auto;
  padding-right: 15px;
}
</style>
  
@endif
<style>
  .rating-stars {
     position: relative;
     cursor: pointer;
     vertical-align: middle;
     display: inline-block;
     overflow: hidden;
     white-space: nowrap;
 }
 .empty-stars {
     color: #aaa;
 }
 .star {
     display: inline-block;
     margin: 0 2px;
     text-align: center;
 }
 .empty-stars .krajee-icon-star {
     background-image: url(data:image/svg+xml;charset=utf-8,%3Csvg%20version%3D%221.1%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20width%3D%2232%22%20height%3D%2232%22%20viewBox%3D%220%200%2032%2032%22%3E%3Cpath%20fill%3D%22%23ffffff%22%20stroke%3D%22%23777777%22%20d%3D%22M20.6%2011l-4.6-10.5-4.6%2010.5h-10.8l7.8%207.9-3%2012.1%2010.6-6%2010.6%206-3-12.1%207.8-7.9z%22%3E%3C%2Fpath%3E%3C%2Fsvg%3E);
 }
 .krajee-icon {
     width: 2.5rem;
     height: 2.5rem;
     display: inline-block;
     width: 2rem;
     height: 2rem;
     -webkit-background-size: cover;
     -moz-background-size: cover;
     -o-background-size: cover;
     background-size: cover;
 }
 .filled-stars {
     transition: width 0.25s ease;
     position: absolute;
     left: 0;
     top: 0;
     margin: auto;
     color: #fde16d;
     white-space: nowrap;
     overflow: hidden;
     -webkit-text-stroke: 1px #777;
     text-shadow: 1px 1px #999;
     
 }
 .filled-stars .krajee-icon-star {
     background-image: url(data:image/svg+xml;charset=utf-8,%3Csvg%20version%3D%221.1%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20width%3D%2232%22%20height%3D%2232%22%20viewBox%3D%220%200%2032%2032%22%3E%3Cpath%20fill%3D%22%23fde16d%22%20stroke%3D%22%23777777%22%20d%3D%22M20.6%2011l-4.6-10.5-4.6%2010.5h-10.8l7.8%207.9-3%2012.1%2010.6-6%2010.6%206-3-12.1%207.8-7.9z%22%3E%3C%2Fpath%3E%3C%2Fsvg%3E);
 }
 </style>

@include('site.partials.breadcrumb', ['name' =>  $translations['addreview']  , 'account' => 'yes'] )
<div id="content" class="site-content" role="main">
  <div class="section-padding">
    @if($errors->count())
    <div class="alert alert-danger p-3">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
      </ul>
    </div>
    @endif
    @if(\Session::has('reviewaddedd'))
    <div class="alert alert-success p-3">
        <p>{{ $translations['reviewthanks'] }}</p>
     
      </ul>
    </div>
    @endif
   
    <div class="section-container p-l-r">
      <div class="page-my-account rtl textRight">
        <div class="col-12">
          <div class="card mb-4">
            <!-- Shipping information -->
            <div class="card-body">
          <div class="shop-details">
            <div class="product-tabs" style="
            border: 0;
        ">
              <div id="reviews" class="product-reviews">
                @if($reviews->count())
                <div id="comments">
                  <h2 class="reviews-title">{{ $reviews->count() }} {{ $translations['review'] }} {{ $translations['for'] }} <span>{{ $product->LocalName }}</span></h2>
                  <ol class="comment-list">
                    @foreach ($reviews  as $review)
                    <li class="review">
                     {{-- <ahref="#"class="btnbtn-smbtn-primary"><iclass="fafa-edit"></i></a> --}}
                      <div class="content-comment-container">
                        <div class="comment-container">
                          <img src="/media/user.jpg" class="avatar" height="60" width="60" alt="">
                          <div class="comment-text">
                            <div class="rating small">
                              <div class="rating-stars" tabindex="0"><span class="empty-stars"><span class="star" title="One Star"><span class="krajee-icon krajee-icon-star"></span></span><span class="star" title="Two Stars"><span class="krajee-icon krajee-icon-star"></span></span><span class="star" title="Three Stars"><span class="krajee-icon krajee-icon-star"></span></span><span class="star" title="Four Stars"><span class="krajee-icon krajee-icon-star"></span></span><span class="star" title="Five Stars"><span class="krajee-icon krajee-icon-star"></span></span></span><span class="filled-stars" style="width:  calc({{ $review->rate }} * 20%)"><span class="star" title="One Star"><span class="krajee-icon krajee-icon-star"></span></span><span class="star" title="Two Stars"><span class="krajee-icon krajee-icon-star"></span></span><span class="star" title="Three Stars"><span class="krajee-icon krajee-icon-star"></span></span><span class="star" title="Four Stars"><span class="krajee-icon krajee-icon-star"></span></span><span class="star" title="Five Stars"><span class="krajee-icon krajee-icon-star"></span></span></span></div>
                            </div>
                            <div class="review-author">{{$review->name }}</div>
                            <div class="review-time">{{ $review->created_at }}</div>
                          </div>
                        </div>
                        <div class="description">
                          <p>{{ $review->review }}</p>
                        </div>	
                      </div>
                    </li>
                    @endforeach
                    
                  </ol>
                </div>
                @endif
                <div id="review-form">
                  <div id="respond" class="comment-respond">
                    <span id="reply-title" class="comment-reply-title">{{$translations['addreview']}}</span>
                    <div class="row">
                      <div class="col-12">
                        <img src="/storage/products/thumbnail/{{ $product->FirstImage }}" alt="" width="100" class="img-fluid">
                        <p>{{ $product->LocalName }}</p>
                      </div>
                      
                    </div>
                    <form action="/review/add" method="post" id="comment-form" class="comment-form">
                      @csrf
                      
                      <input type="hidden" name="product_id" value="{{ $product->id }}">
                      <div class="comment-form-rating">
                        <label for="rating">{{ $translations['yourrating'] }}</label>
                          <select name="rating" class="focus-shadow-0 form-select" id="rating"><option value="5">★★★★★ (5/5)</option><option value="4">★★★★☆ (4/5)</option><option value="3">★★★☆☆ (3/5)</option><option value="2">★★☆☆☆ (2/5)</option><option value="1">★☆☆☆☆ (1/5)</option></select>
                    
                      </div>
                      <p class="comment-form-comment">
                        <textarea id="comment" name="comment" placeholder="{{ $translations['yourreview'] }}*" cols="45" rows="8" aria-required="true" required=""></textarea>
                      </p>
                      <div class="content-info-reviews">
                        <p class="comment-form-author">
                          <input id="author" name="name" placeholder="{{ $translations['name'] }} *" type="text" size="30" aria-required="true" required="" value="{{ \Auth::user()->FullName }}">
                        </p>
                        <p class="form-submit">
                          <input name="submit" type="submit" id="submit" class="submit" value="{{ $translations['save'] }}"> 
                        </p>	
                      </div>
                    </form>
                    
                  </div>
                </div>
                <div class="clear"></div>
              </div>
        
            
        </div>
      </div>
        </div>
        
      </div>
        </div>
      </div>
    </div>
  </div>
</div><!-- #content -->

  
  <form id="logout-form" action="/logout" method="POST" style="display: none;">
    @csrf                                    </form>
@stop

@push('scripts')

<style>
  .badge-danger{
    background: red
  }
  .badge-warning{
    background: orange
  }
  .badge-success{
    background: green
  }
  [dir=rtl] .nav-item a svg {
    margin-right: 0;
    margin-left: 0.75rem;
}
.nav-item a svg {
    margin-right: 0.75rem;
    height: 1rem;
    width: 1rem;
    fill: #9ca3af;
}

.nav-item a svg {
    fill: #ff443a!important;
}
.nav-item a svg {
    -webkit-transform: rotate(180deg);
    transform: rotate(180deg);
}
</style>
  <script>
    jQuery( document ).ready(function( $ ) {



      $('.nav-link').on('click', function(e){
        e.preventDefault(); // Prevent default behavior of the link
        var targetTabId = $(this).attr('href'); // Get the target tab id from the href attribute
        $('.tab-pane').removeClass('active show'); // Hide all tab panes
        $(targetTabId).addClass('active show'); // Show the selected tab pane
      });

});
  </script>
@endpush