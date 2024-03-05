<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

use App\Models\Product;
class WishListController extends Controller
{
    public function index($lang=null)
    {
				
            
            $user = \Auth::user() ;
            $wl_content = $user->wishlists ;
            
            if($lang == 'ar'){
            session()->put('local', 'ar');
            }else{
                session()->put('local', 'en');        
            }
            return view('site.pages.wishlist', compact('wl_content'));
        
    }



    public function add()
    {
        $id = request('productId');
		$product = Product::find($id);
        $user = \Auth::user() ;
        $added = \App\Models\Wishlist::where('product_id' , $product->id)->first() ;
        if(! $added){
        $wishlist = new \App\Models\Wishlist;
        $wishlist->user_id =$user->id;
        $wishlist->product_id = $product->id;            
        $wishlist->save();
    }
    
		
	
		$wishcount = $user->wishlists->count();
		 return response(array(
                'success' => true,
                'wishcount' => $wishcount ,
                
            ),200,[]);
	 

	 

       
    }

    public function delete($id)
    {
        $wishlist =  \App\Models\Wishlist::find($id)->delete();
      
				 
			


        return back()->with('success' , "Removed from Wish List");
    }
	 public function deletewithaddtocart($id)
    {
		
        $wish_list = app('wishlist');
        $wish_list->remove($id);
				 
			


        return ('deleted');
    }

    public function details()
    {
        $wish_list = app('wishlist');

        return response(array(
            'success' => true,
            'data' => array(
                'total_quantity' => $wish_list->getTotalQuantity(),
                'sub_total' => $wish_list->getSubTotal(),
                'total' => $wish_list->getTotal(),
            ),
            'message' => "Get wishlist details success."
        ),200,[]);
    }
}
