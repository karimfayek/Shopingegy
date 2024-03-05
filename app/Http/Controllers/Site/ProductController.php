<?php

namespace App\Http\Controllers\Site;

use Cart;
use Illuminate\Http\Request;
use App\Contracts\ProductContract;
use App\Http\Controllers\Controller;
use App\Contracts\AttributeContract;

class ProductController extends Controller
{
    protected $productRepository;

    protected $attributeRepository;

    public function __construct(ProductContract $productRepository, AttributeContract $attributeRepository)
    {
        $this->productRepository = $productRepository;
        $this->attributeRepository = $attributeRepository;
    }

    public function show($slug  , $lang=null)
    {
        $product = $this->productRepository->findProductBySlug($slug);
     
        $local = session()->get('local');
        if(isset($product->seller->full_name)){
            if(!$product->seller->active){
                dd('an error occured while displaying this product , please contact support');
            }
        }
        $attributes = $this->attributeRepository->listAttributes();
        $related = \App\Models\Product::whereHas('categories', function($query) use($product) 
        { 
            $query->where('name', $product->categories[0]['name']); 
        })->whereNotIn('id', [$product->id])->get();
        if($local == "ar" && $lang == "en"){
            session()->put('local', 'en');
        
        }elseif($local == "en" && $lang == "ar"){
            session()->put('local', 'ar');
           
        }
        return view('site.pages.product', compact('product', 'attributes', 'related'));
    }
	public function showar($slug)
    {
        $product = $this->productRepository->findProductBySlug($slug);
        $attributes = $this->attributeRepository->listAttributes();

        return view('site.pages.ar.product', compact('product', 'attributes'));
    }

    public function addToCart(Request $request)
    {
        $product = $this->productRepository->findProductById($request->input('productId'));
        $options = $request->except('_token', 'productId', 'price', 'qty');

        Cart::add(uniqid(), $product->name, $request->input('price'), $request->input('qty'), $options);

        return redirect()->back()->with('message', 'Item added to cart successfully.');
    }

    public function addToCartReact(Request $request)
    {
        try {
            $product = $this->productRepository->findProductById($request->productId);
            if($product->quantity < 1){
                $error= '<p> Out of Stock </p>' ;
                return response()->json($error);
            }
            
            $options = $request->except('_token', 'productId', 'price', 'qty');
            $options['image'] = $product->FirstImage ;
            $options['slug']= $product->slug ;
            $add =  Cart::add($product->id, $product->name, $product->price ,1 , $options )->associate($product);
            $cart_content = Cart::getContent();
            $pr = Cart::get($product->id);
            //echo($pr->associatedModel->slug);
            if($pr->quantity > $product->quantity){
               Cart::update($product->id, array(
                   'quantity' => array(
                       'relative' => false,
                       'value' => $product->quantity
                   ),
                 )); 
                 
                 $added = 'max Quantity is:'  . $product->quantity ;
                 return response()->json(['error' => 'Max QTY is ' . $product->quantity ], 200);
            }

        } catch (\Exception $e) {
            // Exception handling code


            return response()->json(['error' => $e], 500);
        }
        
         
        $totalQty = Cart::getTotalQuantity();  
        
        $subTotal = Cart::getSubTotal();
        $total = Cart::getTotal();
        if($add){
        
        return response()->json([
            'cart_content' => $cart_content ,
            'totalQty' => $totalQty,
            'subTotal' => $subTotal,
            'total' => $total,
        ]);
        }
        
       
       
        return redirect()->back()->with('message', 'Item added to cart successfully.');
    }
    public function addToCartReactQty(Request $request)
    {
        try {
            $product = $this->productRepository->findProductById($request->productId);
            $qty = $request->prQty ; 
            if($product->quantity < 1){
                $error= '<p> Out of Stock </p>' ;
                return response()->json($error);
            }
           
            $options = $request->except('_token', 'productId', 'price', 'qty');
            $options['image'] = $product->FirstImage ;
            
            $options['slug']= $product->slug ;
            $add =  Cart::add($product->id, $product->name, $product->price ,$qty , $options )->associate($product);
            
            $cart_content = Cart::getContent();
            $pr = Cart::get($product->id);
            //echo($pr->associatedModel->slug);
            if($pr->quantity > $product->quantity){
               Cart::update($product->id, array(
                   'quantity' => array(
                       'relative' => false,
                       'value' => $product->quantity
                   ),
                 )); 
                 
                 $added = 'max Quantity is:'  . $product->quantity ;
                 return response()->json(['error' => 'Max QTY is ' . $product->quantity ], 500);
            }

        } catch (\Exception $e) {
            // Exception handling code


            return response()->json(['error' => 'An error occurred while creating the user'], 500);
        }
        
         
        $totalQty = Cart::getTotalQuantity();  
        
        $subTotal = Cart::getSubTotal();
        $total = Cart::getTotal();
        if($add){
        
        return response()->json([
            'cart_content' => $cart_content ,
            'totalQty' => $totalQty,
            'subTotal' => $subTotal,
            'total' => $total,
        ]);
        }
        
       
       
        return redirect()->back()->with('message', 'Item added to cart successfully.');
    }
    
    public function removeFromCartReact(Request $request)
    {
        try {
           $remove=  Cart::remove($request->productId);
            $cart_content = Cart::getContent();
            
        $totalQty = Cart::getTotalQuantity(); 
        if($remove){
            return response()->json([
                'cart_content' => $cart_content ,
                'totalQty' => $totalQty
            ]);
        }

        } catch (\Exception $e) {
            // Catch the exception and handle it
            // You can log the error, return an error response, or take any necessary action
            return response()->json(['error' => 'an error eccoured'], 500);
        }
        
       
       
        return redirect()->back()->with('message', 'Item added to cart successfully.');
    }
}
