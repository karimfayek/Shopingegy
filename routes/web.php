<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\Cms ;
Route::get('/', 'Site\HomeController@showar')->name('home.show');
Route::get('/en', 'Site\HomeController@showen')->name('home.show');
Route::get('/ar', 'Site\HomeController@showar')->name('home.show');
Route::get('/lang/{lang}', 'Site\HomeController@lang');

Route::get('/contact/{lang?}', 'Site\HomeController@contact')->name('contact.show');
Route::get('/category/{slug}/{lang?}', 'Site\CategoryController@show')->name('category.show');
Route::get('/category2/{slug}/{lang?}', 'Site\CategoryController@show2')->name('category.show2');
Route::get('/products/{lang?}', 'Site\HomeController@Products')->name('products.show');
Route::get('/shop/{lang?}', 'Site\HomeController@Shop')->name('products.show');
Route::get('/product/{slug}/{lang?}', 'Site\ProductController@show')->name('product.show');
Route::get('/page/{slug}/{lang?}', 'Site\HomeController@page')->name('page.show');

Route::get('/brands', 'Site\HomeController@brands');
Route::get('/brand/{slug}', 'Site\HomeController@brand');
Route::post('/contactm', 'Site\HomeController@contactm');

Route::post('/placeorder', 'Site\HomeController@placeorder');

Route::get('/search/{lang?}', 'Site\HomeController@search');
Route::post('/newsletter/subscribe','Site\HomeController@newsletter');
Route::post('/product/add/cart', 'Site\ProductController@addToCart')->name('product.add.cart');
Route::get('/product/add/cart/react', 'Site\ProductController@addToCartReact')->name('product.add.cart.react');
Route::get('/product/add/cart/react/qty', 'Site\ProductController@addToCartReactQty')->name('product.add.cart.react.qty');
Route::get('/product/remove/cart/react', 'Site\ProductController@removeFromCartReact')->name('product.remove.cart.react');
Route::get('/cart', 'Site\CartController@getCart')->name('checkout.cart');
Route::get('/wishlist/fetch', 'Site\CartController@getWL')->name('checkout.wl');
Route::get('/site/cart/{lang?}', 'Site\CartController@getSiteCart')->name('checkout.cart.site');
Route::get('/cart/item/{id}/remove', 'Site\CartController@removeItem')->name('checkout.cart.remove');
Route::get('/cart/clear', 'Site\CartController@clearCart')->name('checkout.cart.clear');
Route::get('/checkout/guest', 'Site\CheckoutController@getCheckoutGuest')->name('checkout.guest');

Route::get('/getstates', 'Site\CheckoutController@getStates')->name('checkout.getstates');
Route::get('/setshipping/{city}', 'Site\CheckoutController@setShipping');
Route::post('/store-order', 'Site\CheckoutController@storeOrder')->name('store-order');
//Route::get('/specs', 'Site\HomeController@specs')->name('store-specs');

Route::get('/payment/{orderno}', 'Site\CheckoutController@payment')->name('payment');
Route::post('/checkout/order', 'Site\CheckoutController@placeOrder')->name('checkout.place.order');

Route::get('/user/get', 'Site\AccountController@getUser')->name('user.get'); 

// middleware' => ['auth']
Route::group(['middleware' => ['auth']], function () {
   
    Route::get('/profile/{lang?}', 'Site\HomeController@Profile')->name('profile.show'); 
    Route::post('/profile/update', 'Site\AccountController@ProfileUpdate')->name('profile.update'); 

    Route::get('/checkout/{lang?}', 'Site\CheckoutController@getCheckout')->name('checkout.show');
    Route::get('checkout/payment/complete', 'Site\CheckoutController@complete')->name('checkout.payment.complete');

    Route::get('account/orders', 'Site\AccountController@getOrders')->name('account.orders');

    Route::get('/order-details/{no}/{lang?}', 'Site\AccountController@orderDetails')->name('order.details');

    Route::post('/review/add','Site\ReviewController@add')->name('review.add.post');
    Route::get('/review/add/{id}/{lang?}','Site\ReviewController@addGet')->name('review.add');

    Route::group(['prefix' => 'wishlist'],function()
    {
        Route::get('/{lang?}','Site\WishListController@index')->name('wishlist.index');
        Route::get('/mobile/show','Site\WishListController@mobile')->name('wishlist.mobile');
        Route::get('/add/item','Site\WishListController@add')->name('wishlist.add');
        Route::get('/details/show','Site\WishListController@details')->name('wishlist.details');
        Route::get('/delete/item/{id}','Site\WishListController@delete')->name('wishlist.delete');
        Route::get('/addtocart/delete/item/{id}','Site\WishListController@deletewithaddtocart')->name('wishlist.delete.addtocart');
    });
});


//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

Auth::routes();
require 'admin.php';

view()->composer(['*'], function ($view) {
	
     $local = \Session::get('local');
	 $top_menu = Cms::where('menu', 1)->where('published', 1)->orderBy('order_no' ,'asc')->get();
	 $footer = Cms::where('footer', 1)->where('published', 1)->orderBy('order_no' , 'asc')->get();
	 $whys = Cms::where('adv', 1)->where('published', 1)->orderBy('order_no' , 'asc')->get();
	 
    $cart_content = Cart::getContent();	
    $cartcount 	 = 	Cart::getTotalQuantity(); 
    $cart_total = Cart::getTotal();
    $cart_sub_total = Cart::getSubTotal();	
    $catparents = \App\Models\Category::where('parent_id', 1)->where('menu', 1)->orderBy('order_no' ,'asc')->get();
    $brands = \App\Models\Brand::all();
    $translations = \App\Models\Translation::all()->pluck('LocalName', 'header');
    if ($local == "ar"){
        
        $sitename = config('settings.site_title');
         $heading = [
            'local' => 'ar' ,
             'home' => 'الرئيسية' ,
             'about' => 'عنا' , 
             'appname' => ' شوبينجيجي ' , 
             'productstrans' => 'المنتجات' ,
             'products' => 'المنتجات' ,
             'producttrans' => 'المنتج' ,
             'pricetrans' => 'السعر' ,
             'pricefromtrans' => 'من' ,
             'pricetotrans' => 'الى' ,
             'quantitytrans' => 'الكمية' ,
             'RecomProducts' => 'منتجات مميزة ' ,
             'nltext' => ' لتلقي التحديثات والعروض الخاصة والخصومات الحصرية.' ,
			 'Download-Catalouge' => 'تحميل الكاتالوج' , 
			 'articles' => ' المقالات' , 
             'contact' => 'اتصل بنا' ,             
             'viewproducts' => 'عرض المنتجات' ,
             'viewProduct' => 'عرض المنتج ' ,
             'readmore' => 'إقرأ المزيد' ,
             'subscribe' => 'إشترك' ,
             'links' => 'روابط' ,
             'nlsub' => 'الاشتراك فى النشرة الاخبارية' ,
             'email' => 'البريد الالكترونى' ,
             'emailtrans' => 'البريد الالكترونى' ,
             'message' => ' رسالتك' ,
             'social' => 'سوشيال' ,
             'copyright' => 'جميع الحقوق محفوظة' ,
             'search' => ' بحث' ,
             'viewmore' => 'عرض المزيد' ,
             'news' => 'الاخبار والاحداث' ,
             'mobile' => 'موبايل' ,
             'phone' => 'تليفون' ,
             'phonetrans' => 'تليفون' ,
             'name' => 'الاسم' ,
             'quote' => 'عرض سعر' ,
             'years' => '<i>سنة  <br>خبرة</i>' ,
             'send' => 'ارسل' ,
             'call' => 'اتصل' ,
             'getintouch' => 'تواصل' ,
             'address' => 'العنوان' ,
             'addresstrans' => 'العنوان' ,
             'specialist' => 'تخصصنا' ,
             'why' => 'لماذا تختارنا  ' ,
             'contactinfo' => 'معلومات الاتصال ' ,
             'blog' => 'المدونة' ,
             'featured' => 'متميز' ,
             'new' => 'حديث' ,
             'bestseller' => 'الافضل مبيعا' ,
             'popcats' => ' تصنيفات المنتجات ' ,
             'testi' => 'اراء العملاء' ,
             'shopnow' => 'تسوق الان' ,
             'cart' => 'سلة المشتريات' ,
             'cartempty' => 'العربة فارغة' ,
             'clearcart' => 'تفريغ السلة ' ,
             'applycoupon' => ' تطبيق ' ,
             'couponcode'=> ' كود الكوبون ' ,
             'calcship' => 'سوف يتم احتساب قيمه الشحن اثناء اتمام الشراء' ,
             'login' => 'تسجيل الدخول' ,
             'register' => 'انشاء حساب' ,
             'checkout' => 'اكمال الشراء' ,
             'onlineshop' => 'تسوق' ,
             'quote' => 'اطلب عرض سعر' ,
             'specialquote' => 'احصل على عرض أسعار خاص' ,
             'myaccount' => 'حسابي ' ,
             'total' => 'المجموع' ,
             'totaltrans' => 'المجموع' ,
             'subtotal' => ' المجموع الفرعى' ,
             'subtotaltrans' => ' المجموع الفرعى' ,
             'viewcart' => 'عرض السلة ' ,
             'password' => 'كلمه المرور' ,
             'passwordtrans' => 'كلمه المرور' ,
             'remember' => 'تذكرنى ' ,
             'forgotpassword' => 'نسيت كلمه السر ' ,
             'profile' => ' حسابي' ,
             'shipping' => 'الشحن' ,
             'procedecheckout' => 'اكمل الشراء' ,
             'paymentmethod' => 'طريقة الدفع ' ,
             'cod' => '	دفع عند الاستلام' ,
             'calcincheckout' => 'يحسب عند الدفع  ' ,
            'needhelp' => 'تحتاج مساعدة ؟ ' ,
            'category' => 'التصنيف' ,
            'description' => 'الوصف' ,
            'relatedprs' => 'منتجات ذات صلة ' ,
            'suggested' => 'مقترح' ,
            'categories' => 'التصنيفات' ,
            'addtocarttrans' => 'اضف الى السله' ,
            'showing' => 'عرض' ,
            'of' => 'من' ,
            'to' => 'الى' ,
            'buyitnow' => 'اشترية الان' ,
            'shopbydept' => 'تتسوق بالفئة' ,
            'firstname' => 'الاسم الاول' ,
            'lastname' => 'الاسم الاخير' ,
            'city' => 'المحافظة' ,
            'citytrans' => 'المحافظة' ,
            'companyname' => 'اسم الشركه' ,
            'placeorder' => 'تنفيذ الطلب' ,
            'ordernotes' => 'ملحوظات خاصة بالطلب' ,
            'whishlist' => 'قائمة الامنيات' ,
            'noproducts' => 'لا يوجد منتجات فى السله' ,
            'gotoshop' => 'تسوق' ,
            'noproductsyet' => 'لا يوجد منتجات حاليا فى هذة الفئة' ,
            'customerreview' => 'تقييم من العملاء' ,
            'view' => 'عرض' ,
            'orderdetails' => 'تفاصيل الطلب' ,
            'addtowl' => 'أضف لقائمه الامنيات' ,
            'addedtowl' => 'مضاف إلى قائمة الامنيات' ,
            'sortby' => 'ترتيب حسب' ,
            'priceasc' => 'السعر من الاقل للاعلى' ,
            'pricedesc' => 'السعر من الاعلى للاقل' ,
            'saleproducts' => 'خصومات',
            'bestsellerproducts' => 'الأفضل مبيعا',
            'reviews' => 'التقييمات' ,
            'specs' => 'المواصفات' ,


         ];
		  $address = config('settings.address_ar') ; 
		  $workdayes = config('settings.work_dayes2') ;
     }else{
        
        $sitename = config('settings.site_name');
         $heading = [
            'local' => 'en' ,
             'home' => 'Home' , 
             'about' => 'About us' ,  
             'appname' => 'PioChem' , 
			 'Download-Catalouge' => 'Download Catalouge' , 
			 'articles' => 'Articles' , 
             'productstrans' => 'Products' ,
             'products' => 'Products' ,
             'producttrans' => 'Product' ,
             'quantitytrans' => 'Quantity' ,
             'pricetrans' => 'Price' ,
             'pricefromtrans' => 'From' ,
             'pricetotrans' => 'To' ,
             'RecomProducts' => 'Recomended Products' ,
             'nltext' => 'Receive weekly updates, special offers, and exclusive discounts.' ,
             'contact' => 'Contact us' ,
             'viewproducts' => 'View Products' ,
             'readmore' => 'Read More' ,
             'subscribe' => 'Subscribe' ,
             'links' => 'Useful links' ,
             'nlsub' => 'Subscribe Newslatter' ,
             'email' => 'Email Address' ,
             'emailtrans' => 'Email Address' ,
             'message' => ' Your Message' ,
             'social' => 'Get Social ' ,
             'copyright' => 'All rights reserved' ,
             'search' => 'Search Here' ,
             'viewmore' => 'View More' ,
             'viewProduct' => 'View Product' ,
             'news' => 'News and events' ,
             'mobile' => 'Mobile' ,
             'phone' => 'Phone' ,
             'phonetrans' => 'Phone' ,
             'name' => 'Name' ,
             'quote' => 'GET QUOTE' ,
             'years' => '<i>Years of <br>Experience</i>' ,
             'send' => 'Send' ,
             'call' => 'Call' ,
             'getintouch' => 'Get in Touch' ,
             'address' => 'Address' ,
             'addresstrans' => 'Address' ,
			 'behinds' => 'Previous work' ,
             'specialist' => 'Our Specialists' ,
             'why' => 'Why Choose Us' ,
             'contactinfo' => 'Contact Info' ,
             'blog' => 'Blogs' ,
             'featured' => 'Featured' ,
             'new' => 'New' ,
             'bestseller' => 'Best Selling' ,
             'popcats' => 'Product Categories' ,
             'testi' => 'What People Say' ,
             'shopnow' => 'Shop Now' ,
             'cart' => 'Cart' ,
             'login' => 'Login' ,
             'register' => 'Register' ,
             'checkout' => 'Checkout'  ,             
             'cartempty' => 'Your Cart Is Currently Empty.' ,             
             'clearcart' => ' Clear Cart ' ,
             'applycoupon' => 'Apply Coupon' ,
             'couponcode'=> 'Coupon Code ' ,             
             'calcship' => 'Shipping options will be updated during checkout.' ,
             'onlineshop' => 'Shop' ,
             'quote' => 'Get a quote' ,
             'specialquote' => 'Get a Special quote' ,
             'myaccount' => 'My Account' ,
             'total' => 'Total' ,
             'subtotal' => 'Sub Total' ,
             'totaltrans' => 'Total' ,
             'subtotaltrans' => 'Sub Total' ,
             'viewcart' => 'View Cart' ,
             'password' => 'Password' ,
             'passwordtrans' => 'Password' ,
             'remember' => 'Remember me' ,
             'forgotpassword' => 'Lost Password ?' ,
             'profile' => 'Profile' ,
             'shipping' => 'Shipping' ,
             'procedecheckout' => 'Proceed To Checkout' ,
             'paymentmethod' => 'Payment Method' ,
             'cod' => '	Cash On delivery' ,
             'calcincheckout' => 'Calculated on Checkout' ,
             'needhelp' => 'Need Help ?' ,
             'category' => 'Category' ,
             'description' => 'Discription' ,
             'relatedprs' => 'Related Products' ,
             'suggested' => 'Suggested' ,
             'categories' => 'Categories' ,
             'addtocarttrans' => 'Add to cart' ,
             'showing' => 'Showing' ,
             'of' => 'of' ,
             'to' => 'to' ,
             'buyitnow' => 'Buy it now' ,
             'shopbydept' => 'Shop by Department' ,
             'firstname' => 'First Name' ,
             'lastname' => 'Last Name' ,
             'city' => 'City' ,
             'citytrans' => 'City' ,
             'companyname' => 'Company Name' ,
             'placeorder' => 'Place Order' ,
             'ordernotes' => 'Order Notes' ,
             'whishlist' => ' Wish list' ,
             'noproducts' => 'No products in the cart.' ,
             'gotoshop' => 'GO TO SHOP' ,
             'noproductsyet' => 'No products here yet.' ,
             'customerreview' => 'customer review.' ,
             'view' => 'View' ,
             'orderdetails' => 'Order Details',
             'addtowl' => 'Add to Wish list' ,
             'addedtowl' => 'Added to Wish list' ,
             'sortby' => 'Sort by' ,
             'priceasc' => 'price: low to high' ,
             'pricedesc' => 'price: high to low' ,
             'saleproducts' => 'on sale',
             'bestsellerproducts' => 'Best Seller',
             'reviews' => 'Reviews' ,
             'specs' => 'Specifications' ,
            

         ];
		  $address = config('settings.address') ; 
		  $workdayes = config('settings.work_dayes') ;
     };
    $data=[
        'cart_content' => $cart_content,
        'cartcount' => $cartcount,
        'cart_total' => $cart_total,
        'cart_sub_total' => $cart_sub_total,
        'catparents' => $catparents,
        'brands' => $brands,
        'top_menu' => $top_menu,
        'footer' => $footer,
        'whys' => $whys, 
        'local' => $local,
        'heading' => $heading,
        'address' => $address,
        'sitename' => $sitename,
        'local' => $local,
        'translations' => $translations
    ];
$view->with($data);

});
