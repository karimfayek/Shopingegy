<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <ul class="app-menu">
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">Dashboard</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.orders.index' ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">
                <i class="app-menu__icon fa fa-bar-chart"></i>
                <span class="app-menu__label">Orders</span>
            </a>
        </li>
        <li class="nav-item has-treeview {{ Route::currentRouteName() == 'admin.categories.index' ||  Route::currentRouteName() == 'admin.attributes.index'  ||  Route::currentRouteName() == 'admin.products.index' |  Route::currentRouteName() == 'admin.reviews.index'  ||  Route::currentRouteName() == 'admin.products.index'  ||  Route::currentRouteName() == 'admin.brands.index' ? 'menu-open' : '' }}">            
            <a class="app-menu__item " href="#">
                <i class="app-menu__icon fa fa-list"></i>
                <span class="app-menu__label">Catalog</span><i class="right fa fa-angle-left "></i>
            </a>
            <ul> 
                    <li>
                        <a class="app-menu__item {{ Route::currentRouteName() == 'admin.categories.index' ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                            <i class="app-menu__icon fa fa-tags"></i>
                            <span class="app-menu__label">Categories</span>
                        </a>
                    </li>
                <li>
                    <a class="app-menu__item {{ Route::currentRouteName() == 'admin.attributes.index' ? 'active' : '' }}" href="{{ route('admin.attributes.index') }}">
                        <i class="app-menu__icon fa fa-th"></i>
                        <span class="app-menu__label">Attributes</span>
                    </a>
                </li>
                <li>
                    <a class="app-menu__item {{ Route::currentRouteName() == 'admin.products.index' ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                            <i class="app-menu__icon fa fa-shopping-bag"></i>
                            <span class="app-menu__label">Products</span>
                    </a>
                </li>             
              
                <li>
                    <a class="app-menu__item {{ Route::currentRouteName() == 'admin.reviews.index' ? 'active' : '' }}" href="{{ route('admin.reviews.index') }}">
                        <i class="app-menu__icon fa fa-star"></i>
                        <span class="app-menu__label">Product Reviews</span>
                    </a>
                </li>   
                <li>
                    <a class="app-menu__item {{ Route::currentRouteName() == 'admin.brands.index' ? 'active' : '' }}" href="{{ route('admin.brands.index') }}">
                        <i class="app-menu__icon fa fa-briefcase"></i>
                        <span class="app-menu__label">Brands</span>
                    </a>
                </li>     
                                     
            </ul>
        </li>
       
        
   
       
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.states.index' ? 'active' : '' }}" href="{{ route('admin.states.index') }}">
                <i class="app-menu__icon fa fa-truck"></i>
                <span class="app-menu__label">States</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.banners.index' ? 'active' : '' }}" href="{{ route('admin.banners.index') }}">
                <i class="app-menu__icon fa fa-image"></i>
                <span class="app-menu__label">Banners</span>
            </a>
        </li>
		
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.cmss.index' ? 'active' : '' }}" href="{{ route('admin.cmss.index') }}">
                <i class="app-menu__icon fa fa-file"></i>
                <span class="app-menu__label">CMS</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.settings' ? 'active' : '' }}" href="{{ route('admin.settings') }}">
                <i class="app-menu__icon fa fa-cogs"></i>
                <span class="app-menu__label">Settings</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.sellers.index' ? 'active' : '' }}" href="{{ route('admin.sellers.index') }}">
                <i class="app-menu__icon fa fa-user"></i>
                <span class="app-menu__label">Sellers</span>
            </a>
        </li>
        {{-- Messages --}}
        <li class="nav-item has-treeview
        {{ Route::currentRouteName() == 'admin.newsletters.index' || Route::currentRouteName() == 'admin.contacts.index'
        ? 'menu-open' : '' }}">            
            <a class="app-menu__item " href="#">
               <i class="app-menu__icon fa fa-envelope"></i>
               <span class="app-menu__label">messages</span><i class="right fa fa-angle-left "></i>
           </a>
           <ul>
                 <li>
                   <a class="app-menu__item {{ Route::currentRouteName() == 'admin.newsletters.index' ? 'active' : '' }}" href="{{ route('admin.newsletters.index') }}">
                       <i class="app-menu__icon fa fa-newspaper-o"></i>
                       <span class="app-menu__label">News Letter</span>
                   </a>
               </li>	
                <li>
                   <a class="app-menu__item {{ Route::currentRouteName() == 'admin.contacts.index' ? 'active' : '' }}" href="{{ route('admin.contacts.index') }}">
                       <i class="app-menu__icon fa fa-phone"></i>
                       <span class="app-menu__label">Contact Page</span>
                   </a>
               </li> 

               {{-- 
               <li>
                <a class="app-menu__item {{ Route::currentRouteName() == 'admin.careers.index' ? 'active' : '' }}" href="{{ route('admin.careers.index') }}">
                    <i class="app-menu__icon fa fa-handshake-o"></i>
                    <span class="app-menu__label">Careers </span>
                </a>
            </li> 
             <li>
                <a class="app-menu__item {{ Route::currentRouteName() == 'admin.catalogs.index' ? 'active' : '' }}" href="{{ route('admin.catalogs.index') }}">
                    <i class="app-menu__icon fa fa-file"></i>
                    <span class="app-menu__label">Catalog Downloads </span>
                </a>
            </li>
             --}}
           </ul>
       </li>
       {{-- End Messages --}}
       <li>
        <a class="app-menu__item {{ Route::currentRouteName() == 'admin.translation.index' ? 'active' : '' }}" href="{{ route('admin.translation.index') }}">
            <i class="app-menu__icon fa fa-language"></i>
            <span class="app-menu__label">Heading Translations</span>
        </a>
    </li>
		<li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'password.form' ? 'active' : '' }}" href="{{ route('password.form') }}">
                <i class="app-menu__icon fa fa-key"></i>
                <span class="app-menu__label">Change Password</span>
            </a>
        </li>
    </ul>
</aside>
