 <!-- footer area start -->
    <footer class="footer-area footer-style-2 padding-top-80 margin-top-80">
        <div class="footer-top padding-bottom-50">
            <div class="container">
                <div class="row">
				
                    <div class="col-lg-3 col-md-6">
                        <div class="widget widget_nav_menu">
                            <h4 class="widget-title">Location</h4>
							{!! config('settings.map') !!}
                            
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="widget widget_nav_menu">
                            <h4 class="widget-title">الفئات</h4>
                            <ul>
							@foreach($categories as $cat)
							@foreach($cat->items as $category)
                                <li><a href="{{ route('category.showar', $category->slug) }}"id="{{ $category->slug }}">{{ $category->name2 }}</a></li>
                            @endforeach
							 @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="widget contact-widget">
                            <h4 class="widget-title">كن على تواصل</h4>
                            <ul class="contact_info_list">
                                <li class="single-info-item">
                                    <div class="icon">
                                        <i class="icon-home-foother"></i>
                                    </div>
                                    <div class="details">
                                        <span>{!! config('settings.address') !!}</span>
                                    </div>
                                </li>
                                <li class="single-info-item">
                                    <div class="icon">
                                        <i class="icon-email-subscribe"></i>
                                    </div>
                                    <div class="details">
                                        {{ config('settings.default_email_address') }}
                                    </div>
                                </li>
                                <li class="single-info-item">
                                    <div class="icon">
                                        <i class="icon-call-footer"></i>
                                    </div>
                                    <div class="details">
                                        <a>{{ config('settings.phones') }}</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="widget widget_about">
                            <a href="/">
                                <img src="/assets/img/logofooter.jpg" alt="">
                            </a>
                            <p>{!! config('settings.footer_copyright_text') !!}</p>
                            <ul>
                                <li><a href=" {{ config('settings.social_facebook') }}"><i class="icon-facebook"></i></a></li>
                                <li><a href=" {{ config('settings.social_twitter') }}"><i class="icon-twitter"></i></a></li>
                                <li><a href=" {{ config('settings.social_instagram') }}"><i class="icon-instagram"></i></a></li>
                                <li><a href=" {{ config('settings.social_linkedin') }}"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 align-self-center">
                        <p>© DasKind 2021. Powered with <i class="fa fa-heart"></i> by <a href="https://egyptianit.com.eg">EGY-IT</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer area end -->

    <!-- back to top area start -->
    <div class="back-to-top">
        <span class="back-top"><i class="fa fa-angle-up"></i></span>
    </div>
    <!-- back to top area end -->
