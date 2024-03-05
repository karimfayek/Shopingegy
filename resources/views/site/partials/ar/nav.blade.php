<div class="stoon-navbar absolute-nav" style="
    direction: rtl;
">
        <div class="header-top dark-header-top d-none d-sm-block">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-6">
                        <div class="contact">
                            <a><i class="icon-call-header"></i> {{ config('settings.phones') }}</a>
                            <a href="mailto:{{ config('settings.default_email_address') }}"><i class="icon-email-subscribe"></i> {{ config('settings.default_email_address') }}</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-6">
                        <div class="right-nav text-right">
                            <ul>
                                <li>
                                    <div class="select-menu">
                                        <select class="menu-select"  onChange="SelectRedirect();">
                                            <option value="ar"><a href="/ar">Arabic</a></option>
                                            <option value="en"><a href="/en">English</a></option>
                                        </select>
                                        <i class="fa fa-chevron-down" style="margin-right: -8px;"></i>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-area navbar-expand-lg nav-style-01">
            <div class="container-fluid nav-container">
                <div class="row">
                    <div class="col-lg-3 col-4 order-1 align-self-center">
                        <div class="logo">
                            <a href="/ar"><img src="{{ asset('storage/'.config('settings.site_logo')) }}" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-6 order-3 order-lg-2">
                        <div class="collapse navbar-collapse" id="shop-menu">
                            <ul class="navbar-nav menu-open">
                                <li class="nav-item">
                                    <a href="/ar">الرئيسية </a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="#">المنتجات <i class="fa fa-angle-down"></i></a>
                                    <ul class="sub-menu">
                                        @foreach($categories as $cat)
									@foreach($cat->items as $category)
										@if ($category->items->count() > 0)
                                        <li><a href="{{ route('category.showar', $category->slug) }}"id="{{ $category->slug }}">{{ $category->name2 }}</a>
											
										</li>
										@else
										<li class="nav-item">
											<a class="nav-link" href="{{ route('category.showar', $category->slug) }}">{{ $category->name2 }}</a>
										</li>
										@endif
									@endforeach
								@endforeach
                                    </ul>
                                </li>
                                <li><a href="/about/ar">عنا</a></li>
                                <li><a href="/contact/ar">اتصل بنا</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-8 justify-content-end d-flex order-2 order-lg-3">
                        <div class="nav-right-part nav-right-part-02">
                            <ul>
                                <li style="margin-right: 0px;
    margin-left: 15px;">
                                    <a href="#" id="search"><i class="icon-search"></i></a>
                                </li>
                                <li class="has-dropdown">
                                    <a href="/cart/ar"><i class="icon-add-to-cat"></i><span class="badge badge-pink">{{ $cartCount }}</span></a>
                                   
                                </li>
                            </ul>
                        </div>
                        <div class="responsive-mobile-menu">
                            <div class="menu toggle-btn d-block d-lg-none" data-toggle="collapse" data-target="#shop-menu" aria-expanded="false" role="button">
                                <div class="icon-left"></div>
                                <div class="icon-right"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <!-- navbar end -->

