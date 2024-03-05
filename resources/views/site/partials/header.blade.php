
<header id="site-header" class="site-header header-v1">
    <div class="header-mobile" id="mobile-header">
        <div class="section-padding">
            <div class="section-container">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-3 col-3 header-left" id="mobile-menu">
                       
                        
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6 header-center">
                        <div class="site-logo">
                            <a href="/{{ $local }}">
                                <img width="400" height="79" src="/storage/{{ config('settings.site_logo') }}" alt="{{ config('settings.site_name') }}" />
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-3 col-3 header-right">
                      <div class="ruper-topcart dropdown" id="mobile-cart">
                        
                      </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="header-mobile-fixed">
    <!-- Search -->
    <div class="shop-page">
      <a href="/products/{{ $local }}"><i class="wpb-icon-shop"></i></a>
    </div>

    <!-- Login -->
    <div class="my-account">
      <div class="login-header">
        <a href="/profile/{{ $local }}"><i class="wpb-icon-user"></i></a>
      </div>
    </div>

    <!-- Search -->
    <div class="search-box">
      <div class="search-toggle"><i class="wpb-icon-magnifying-glass"></i></div>
    </div>

    <!-- Wishlist -->
    <div class="wishlist-box">
      <a href="/wishlist/{{ $local }}"><i class="wpb-icon-heart"></i></a>
    </div>

        </div>
    </div>

    <div class="header-desktop">
        <div class="header-wrapper">
            <div class="section-padding">
                <div class="section-container p-l-r">
                    <div class="row">
                        <div class="col-xl-3 col-lg-2 col-md-12 col-sm-12 col-12 header-left">
                            <div class="site-logo">
                                <a href="/{{ $local }}">
                                    <img width="400" height="79" src="/storage/{{ config('settings.site_logo') }}" alt="{{ config('settings.site_name') }}" />
                                </a>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 text-center header-center">
                            <div class="site-navigation">
                                
                                @include('site.partials.nav')
                               
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12 header-right">
                          @auth()
                          <div class="header-page-link" id="navbar-cart" data-authenticated = 'yes'>
                        
                          </div>
                          @else
                          <div class="header-page-link" id="navbar-cart" data-authenticated = 'no'>
                              
                           </div>
                           @endauth
                            
                           
                            
                            <!-- Search -->
                            
                           
                         
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>


                            <!-- main menu navbar start -->
                          
						
                               
                          