<?php
use App\Models\Order;
use Illuminate\Support\Facades\DB;

Route::group(['prefix'  =>  'admin'], function () {

    Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\LoginController@login')->name('admin.login.post');

    Route::group(['middleware' => ['auth:admin']], function () {

        Route::get('/', function () {
            $salesData = Order::select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                DB::raw('SUM(grand_total) as total_sales')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total_sales', 'month');
    
        // Generate labels (months) from the keys
        $labels = $salesData->keys()->map(function ($month) {
            return date('M Y', strtotime($month . '-01'));
        });
    
        // Extract the values (total sales) from the values
        $salesValues = $salesData->values();
            return view('admin.dashboard.index', compact('labels', 'salesValues'));
        })->name('admin.dashboard');



        Route::get('/sellers/list', 'Admin\SettingController@sellers')->name('admin.sellers.index');
        Route::get('/sellers/{user_id}/approve', 'Admin\SettingController@approve')->name('admin.sellers.approve');
        Route::get('/sellers/{user_id}/deactivate', 'Admin\SettingController@deactivate')->name('admin.sellers.deactivate');
        Route::get('/sellers/{user_id}/activate', 'Admin\SettingController@activate')->name('admin.sellers.activate');
        Route::get('logout', 'Admin\LoginController@logout')->name('admin.logout');
        Route::get('changepass', 'Auth\UpdatePasswordController@index')->name('password.form');
        Route::post('change-password', 'Auth\UpdatePasswordController@update')->name('password.updates');
        
        Route::get('/settings', 'Admin\SettingController@index')->name('admin.settings');
        Route::post('/settings', 'Admin\SettingController@update')->name('admin.settings.update');

        Route::group(['prefix'  =>   'categories'], function() {

            Route::get('/', 'Admin\CategoryController@index')->name('admin.categories.index');
            Route::get('/create', 'Admin\CategoryController@create')->name('admin.categories.create');
            Route::post('/store', 'Admin\CategoryController@store')->name('admin.categories.store');
            Route::get('/{id}/edit', 'Admin\CategoryController@edit')->name('admin.categories.edit');
            Route::post('/update', 'Admin\CategoryController@update')->name('admin.categories.update');
            Route::get('/{id}/delete', 'Admin\CategoryController@delete')->name('admin.categories.delete');

        });

        Route::group(['prefix'  =>   'attributes'], function() {

            Route::get('/', 'Admin\AttributeController@index')->name('admin.attributes.index');
            Route::get('/create', 'Admin\AttributeController@create')->name('admin.attributes.create');
            Route::post('/store', 'Admin\AttributeController@store')->name('admin.attributes.store');
            Route::get('/{id}/edit', 'Admin\AttributeController@edit')->name('admin.attributes.edit');
            Route::post('/update', 'Admin\AttributeController@update')->name('admin.attributes.update');
            Route::get('/{id}/delete', 'Admin\AttributeController@delete')->name('admin.attributes.delete');

            Route::post('/get-values', 'Admin\AttributeValueController@getValues');
            Route::post('/add-values', 'Admin\AttributeValueController@addValues');
            Route::post('/update-values', 'Admin\AttributeValueController@updateValues');
            Route::post('/delete-values', 'Admin\AttributeValueController@deleteValues');
        });

        Route::group(['prefix'  =>   'brands'], function() {

            Route::get('/', 'Admin\BrandController@index')->name('admin.brands.index');
            Route::get('/create', 'Admin\BrandController@create')->name('admin.brands.create');
            Route::post('/store', 'Admin\BrandController@store')->name('admin.brands.store');
            Route::get('/{id}/edit', 'Admin\BrandController@edit')->name('admin.brands.edit');
            Route::post('/update', 'Admin\BrandController@update')->name('admin.brands.update');
            Route::get('/{id}/delete', 'Admin\BrandController@delete')->name('admin.brands.delete');

        });

        Route::group(['prefix' => 'products'], function () {

           Route::get('/', 'Admin\ProductController@index')->name('admin.products.index');
           Route::get('/create', 'Admin\ProductController@create')->name('admin.products.create');
           Route::post('/store', 'Admin\ProductController@store')->name('admin.products.store');
           Route::get('/edit/{id}', 'Admin\ProductController@edit')->name('admin.products.edit');
           Route::post('/update', 'Admin\ProductController@update')->name('admin.products.update');
            Route::get('/{id}/delete', 'Admin\ProductController@delete')->name('admin.products.delete');

           Route::post('images/upload', 'Admin\ProductImageController@upload')->name('admin.products.images.upload');
           Route::get('images/{id}/delete', 'Admin\ProductImageController@delete')->name('admin.products.images.delete');

           Route::get('attributes/load', 'Admin\ProductAttributeController@loadAttributes');
           Route::post('attributes', 'Admin\ProductAttributeController@productAttributes');
           Route::post('attributes/values', 'Admin\ProductAttributeController@loadValues');
           Route::post('attributes/add', 'Admin\ProductAttributeController@addAttribute');
           Route::post('attributes/delete', 'Admin\ProductAttributeController@deleteAttribute');

            Route::get('/quantity/{id}', 'Admin\ProductController@quantity');
            Route::get('/price/{id}', 'Admin\ProductController@price');
            Route::get('/sale_price/{id}', 'Admin\ProductController@saleprice');

        });
        Route::group(['prefix' => 'reviews'],function()
		{
			Route::get('/','Site\ReviewController@index')->name('admin.reviews.index');
			Route::get('/add','Site\ReviewController@adminadd')->name('admin.reviews.add');
			Route::post('/adminupdate','Site\ReviewController@adminupdate')->name('admin.reviews.adminupdate');
			 Route::get('/edit/{id}', 'Site\ReviewController@edit')->name('admin.reviews.edit');
	   Route::post('/update', 'Site\ReviewController@update')->name('admin.reviews.update');
			Route::get('/delete/{id}','Site\ReviewController@delete')->name('admin.reviews.delete');
		});

        Route::group(['prefix' => 'orders'], function () {
           Route::get('/', 'Admin\OrderController@index')->name('admin.orders.index');
           Route::get('/completed/{id}', 'Admin\OrderController@completed')->name('admin.orders.completed');
           Route::get('/{order}/show', 'Admin\OrderController@show')->name('admin.orders.show');
        });

        Route::group(['prefix'  =>   'states'], function()
        {

           Route::get('/', 'Admin\StateController@index')->name('admin.states.index');
           Route::get('/create', 'Admin\StateController@create')->name('admin.states.create');
           Route::post('/store', 'Admin\StateController@store')->name('admin.states.store');
           Route::get('/{id}/edit', 'Admin\StateController@edit')->name('admin.states.edit');
           Route::post('/update', 'Admin\StateController@update')->name('admin.states.update');
           Route::get('/{id}/delete', 'Admin\StateController@delete')->name('admin.states.delete');

       });
	  Route::group(['prefix' => 'banners'], function () {

	   Route::get('/', 'Admin\BannerController@index')->name('admin.banners.index');
	   Route::get('/create', 'Admin\BannerController@create')->name('admin.banners.create');
	   Route::post('/store', 'Admin\BannerController@store')->name('admin.banners.store');
	   Route::get('/edit/{id}', 'Admin\BannerController@edit')->name('admin.banners.edit');
	   Route::post('/update', 'Admin\BannerController@update')->name('admin.banners.update');
		Route::get('/{id}/delete', 'Admin\BannerController@delete')->name('admin.banners.delete');

	   Route::post('images/upload', 'Admin\BannerImageController@upload')->name('admin.banners.images.upload');
	   Route::get('images/{id}/delete', 'Admin\BannerImageController@delete')->name('admin.banners.images.delete');


        });
		 Route::group(['prefix' => 'cmss'], function () {

	   Route::get('/', 'Admin\CmsController@index')->name('admin.cmss.index');
	   Route::get('/create', 'Admin\CmsController@create')->name('admin.cmss.create');
	   Route::post('/store', 'Admin\CmsController@store')->name('admin.cmss.store');
	   Route::get('/edit/{id}', 'Admin\CmsController@edit')->name('admin.cmss.edit');
	   Route::post('/update', 'Admin\CmsController@update')->name('admin.cmss.update');
		Route::get('/{id}/delete', 'Admin\CmsController@delete')->name('admin.cmss.delete');


        });
        Route::group(['prefix' => 'messages'], function () {

            Route::get('/contacts', 'Admin\MessageController@contacts')->name('admin.contacts.index');
            Route::get('/careers', 'Admin\MessageController@careers')->name('admin.careers.index');
            Route::get('/newsletter', 'Admin\MessageController@newsletters')->name('admin.newsletters.index');
            Route::get('/catalogs', 'Admin\MessageController@catalogs')->name('admin.catalogs.index');
        Route::get('/{id}/delete', 'Admin\MessageController@delete')->name('admin.messages.delete');
    
    
        });
        Route::group(['prefix' => 'translations'], function () {

            Route::get('/', 'Admin\TranslationController@index')->name('admin.translation.index');
            Route::get('/create', 'Admin\TranslationController@create')->name('admin.translation.create');
            Route::post('/store', 'Admin\TranslationController@store')->name('admin.translation.store');
             Route::get('/edit/{id}', 'Admin\TranslationController@edit')->name('admin.translation.edit');
            Route::post('/update', 'Admin\TranslationController@update')->name('admin.translation.update');
             Route::get('/{id}/delete', 'Admin\TranslationController@delete')->name('admin.translation.delete');
    
    
        });
    });
});
