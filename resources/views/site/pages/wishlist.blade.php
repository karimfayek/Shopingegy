@extends('site.app')
@section('title', $heading['whishlist'])
@section('content')
  
@include('site.partials.breadcrumb', ['name' => $heading['whishlist'] ])
  <!-- Grid view \Cart::getContent() -->
   
  <div id="content" class="site-content" role="main">
    <div class="section-padding">
      <div class="section-container p-l-r">
        <div class="shop-wishlist">	
          <table class="wishlist-items">                            
            <tbody>
              @forelse ($wl_content as $wl )
                
             
              <tr class="wishlist-item">
               
                <td class="wishlist-item-remove">
                  <a href="/wishlist/delete/item/{{ $wl->id }}">
                  <span></span>
                </a>
                </td>
             
                <td class="wishlist-item-image">
                <a href="/product/{{ $wl->product->slug }}/{{ $local }}">
                <img width="600" height="600" src="/storage/products/mobile_photos/{{ $wl->product->first_image }}" alt="">
                </a>
                </td>
                <td class="wishlist-item-info">
                <div class="wishlist-item-name">
                <a href="/product/{{ $wl->product->slug }}/{{ $local }}">{{ $wl->product->LocalName }}</a>
                </div>
                <div class="wishlist-item-price">
                <span>L.E {{ $wl->product->price }}</span>
                </div>
                <div class="wishlist-item-time"></div>
                </td>
                <td class="wishlist-item-actions">
                <div class="wishlist-item-stock">
                In stock                                    
                </div>
                <div class="wishlist-item-add">
                <div class="btn-add-to-cart" data-title="Add to cart">
                <a rel="nofollow" href="#" class="product-btn button">Add to cart</a>
                </div>
                </div>
                </td>
              </tr>
              @empty
              <div class="shop-cart-empty"><div class="notices-wrapper"><p class="cart-empty">Your wish list is currently empty.</p></div><div class="return-to-shop"><a class="button" href="/products/{{ $local }}">Return to shop</a></div></div>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
    
@stop
