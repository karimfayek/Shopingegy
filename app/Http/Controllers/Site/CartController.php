<?php

namespace App\Http\Controllers\Site;

use Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function getCart()
    {
        $cart_content = Cart::getContent();
        $totalQty = Cart::getTotalQuantity();
        $subTotal = Cart::getSubTotal();
        $total = Cart::getTotal();
        
        return response()->json([
            'cart_content' => $cart_content ,
            'totalQty' => $totalQty,
            'subTotal' => $subTotal,
            'total' => $total,
        ]);
        return view('site.pages.cart');
    }
    public function getWL()
    {
        
        $user = \Auth::user() ;
        if($user){
        $totalWL = $user->wishlists->count();}else{
            $totalWL = 0 ;
        }
        
        return response()->json([
            'totalWL' => $totalWL,
        ]);
        return view('site.pages.cart');
    }
    public function getSiteCart($lang=null)
    {
        $cart_content = Cart::getContent();
        $totalQty = Cart::getTotalQuantity();
        $subTotal = Cart::getSubTotal();
        $total = Cart::getTotal();
        
        if($lang == 'ar' ){
            session()->put('local', 'ar');
        }else{
            session()->put('local', 'en');        
        }
  
        return view('site.pages.cart');
    }
	 public function getCartar()
    {
        return view('site.pages.ar.cart');
    }

    public function removeItem($id)
    {
        Cart::remove($id);

        if (Cart::isEmpty()) {
            return redirect('/');
        }
        return redirect()->back()->with('message', 'Item removed from cart successfully.');
    }

    public function clearCart()
    {
        Cart::clear();

        return redirect('/');
    }
}
