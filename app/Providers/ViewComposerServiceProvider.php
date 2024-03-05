<?php

namespace App\Providers;

use Cart;
use App\Models\Category;
use App\Models\Cms;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('site.partials.nav', function ($view) {
            $view->with('categories', Category::orderBy('order_no')->get()->nest());
        });
		 View::composer('site.partials.nav', function ($view) {
            $view->with('pages', Cms::all());
        });
		View::composer('site.partials.scripts', function ($view) {
            $view->with('categories', Category::orderBy('order_no')->get()->nest());
        });
		 View::composer('site.pages.products', function ($view) {
            $view->with('categories', Category::orderBy('order_no')->get()->nest());
        });
		 View::composer('site.partials.footer', function ($view) {
            $view->with('categories', Category::orderBy('order_no')->get()->nest());
        });
		 View::composer('site.partials.ar.footer', function ($view) {
            $view->with('categories', Category::orderBy('order_no')->get()->nest());
        });
        View::composer('site.partials.header', function ($view) {
            $view->with('cartCount', Cart::getContent()->count());
        });
        View::composer('site.pages.checkout', function ($view) {
            $view->with('cartCount', Cart::getContent()->count());
        });
        View::composer('site.pages.ar.checkout', function ($view) {
            $view->with('cartCount', Cart::getContent()->count());
        });
		View::composer('site.partials.ar.header', function ($view) {
            $view->with('cartCount', Cart::getContent()->count());
        });
		View::composer('site.pages.homepage', function ($view) {
             $view->with('categories', Category::orderBy('order_no')->get()->nest());
        });
		View::composer('site.pages.ar.homepage', function ($view) {
             $view->with('categories', Category::orderBy('order_no')->get()->nest());
        });
    }
}
