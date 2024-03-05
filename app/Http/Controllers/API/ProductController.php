<?php

namespace App\Http\Controllers\API;


use App\Product;
use App\Spages;
use App\Models\Brand;
use App\Models\Category;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
class ProductController extends Controller
{
    

   

    public function show( $id , $lang= null)
    {
		
        $product = Product::where('id' ,$id)->first();
		$images = $product->images; 
		$stripeDesc =  strip_tags($product->descreption) ;
		$product['descreption'] = trim(preg_replace('/&nbsp;/', ' ', $stripeDesc));
		$stripeTech =  strip_tags($product->techdetails) ;
		$product['techdetails'] = trim(preg_replace('/&nbsp;/', ' ', $stripeTech));

      	return response()->json(array(
			'product' => $product,
			'images' => $images,
		));
	}
	
	 public function brands( $id , $lang= null)
    {
			$brands= Brand::all();

      	return response()->json(array(
			'brands' => $brands,
		));
	}
	public function HomeCats()
    {
		
		$cats = \App\Models\Category::where('featured', 1)->orderBy('order_no' ,'asc')->get();
	
		foreach($cats as $cat){
			$cat['LocalName'] = $cat->LocalName ;
		}
      	return response()->json(array(
			'cats' => $cats,
		));
	} 
	
	public function AllCats()
    {
		
		$categories =  \App\Models\Category::where('parent_id' , '1')->with('children')->get();
		foreach($categories as $cat){
			$cat['LocalName'] = $cat->LocalName ;
		}
		return response()->json(array(
			'categories' => $categories,
		));
	}
	public function homeBanners()
    {
		
		$banners =  \App\Models\Banner::where('status' , '1')->get();
		foreach($banners as $banner){
			$banner['local_name'] = $banner->local_name ;
			$banner['LocalDescription'] = $banner->LocalDescription ;

		}
		return response()->json(array(
			'banners' => $banners,
		));
	}

	public function Product($id)
    {
		
		
		$product =  \App\Models\Product::find($id);
		return response()->json(array(
			'product' => $product
		));
	} 
	
	public function Brand($slug)
    {
		
		$brand =  \App\Models\Brand::where('slug' , $slug)->firstOrFail();
		$cats =  \App\Models\Category::where('menu' , 1)->get();
		$brands= \App\Models\Brand::all();
		$products = $brand->products()->get();
		foreach($products as $product){
			if($product->images->count() > 0){

				$product['image'] = $product->images->first()['full'];
			}else{
				$product['image'] = 'product-placeholder.jpg' ;
			}
			$product['description'] = strip_tags( str_limit($product->description , 300));
		}
		$minPrice = $brand->products()->min('price');
		$maxPrice =  $brand->products()->max('price');
		$min = (int)$minPrice;
		$max =  (int)$maxPrice;

      	return response()->json(array(
			'brands' => $brands,
			'products' => $products,
			'minPrice' => $min,
			'maxPrice' => $max,
			'brand' => $brand,
			'cats' => $cats,
		));
	} 
	public function filterProducts(Request $request)
	{
		$selectedBrands = $request->input('selectedBrands', []);
		$selectedCategories = $request->input('cats');
		$category = \App\Models\Category::where('slug', $request->input('categorySlug'))->firstOrFail();
		
		// Retrieve the products for the category
		$products = $category->products();
	
		$minPrice = null;
		$maxPrice = null;
		if (!empty($selectedCategories)) {
			$products = \App\Models\Product::whereHas('categories', function ($query) use ($selectedCategories) {
				$query->whereIn('categories.id', $selectedCategories);
			});
			//dd($selectedCategories);
		$minPrice = (int)$products->min('price');
		$maxPrice = (int)$products->max('price');
		}
	
		// Apply brand filter if any brands are selected
		if (!empty($selectedBrands)) {
			$products->whereIn('brand_id', $selectedBrands);
		}
		
		if (isset($request["prices"])) {
			$products->whereBetween('price', $request["prices"]); 
		}
	
		// Load the brand relationship
		$products->with('brand')->with('images');

		// Fetch the filtered products
		$filteredProducts = $products->get();
	//dd($filteredProducts);
		// Add the image URL to each product
		foreach ($filteredProducts as $product) {
			//dd($product);
			$product['image'] = optional($product->images->first())['full'];
			$product['description'] = strip_tags( str_limit($product->description , 300));
		}
	
		// Return the filtered products as JSON response
		return response()->json([
			'filteredProducts' => $filteredProducts ,
			'minPrice' => $minPrice ,
			'maxPrice' => $maxPrice ,
		]);
	}	
	public function filterProductsBrand(Request $request)
	{
		$selectedCategories = $request->input('cats');
		$brand = \App\Models\Brand::where('slug', $request->input('categorySlug'))->firstOrFail();
		
		// Retrieve the products for the Brand
		$products = $brand->products();
	
		$minPrice = null;
		$maxPrice = null;
		if (!empty($selectedCategories)) {
			$products->whereHas('categories', function ($query) use ($selectedCategories) {
				$query->whereIn('categories.id', $selectedCategories);
			});
			//dd($selectedCategories);
		$minPrice = (int)$products->min('price');
		$maxPrice = (int)$products->max('price');
		}
	
		// Apply brand filter if any brands are selected
		
		
		if (isset($request["prices"])) {
			$products->whereBetween('price', $request["prices"]); 
		}
	
		// Load the brand relationship
		$products->with('brand')->with('images');

		// Fetch the filtered products
		$filteredProducts = $products->get();
	//dd($filteredProducts);
		// Add the image URL to each product
		foreach ($filteredProducts as $product) {
			//dd($product);
			$product['image'] = optional($product->images->first())['full'];
			$product['description'] = strip_tags( str_limit($product->description , 300));
		}
	
		// Return the filtered products as JSON response
		return response()->json([
			'filteredProducts' => $filteredProducts ,
			'minPrice' => $minPrice ,
			'maxPrice' => $maxPrice ,
		]);
	}

// Recomended Products
	public function Rprs()
    {
		
		$rprs = \App\Models\Product::where('featured', 1)
		->where('status', 1)
		->where('price', '>' , 0)
		->with('images')
		->limit(20)
		->get();
		
		foreach ($rprs as $product) {
			//dd($product);
			$product['last_image'] = $product->last_image;
			$product['first_image'] =  $product->first_image;
			$product['LocalName'] =  $product->LocalName;
		}
      	return response()->json(array(
			'rprs' => $rprs,
		));
	}


//Sale Products
	public function Sprs()
    {
		
		$sprs = \App\Models\Product::where('sale_price', '>' ,  'price')
		->where('status', 1)
		->with('images')
		->limit(20)
		->get();
		

      	return response()->json(array(
			'sprs' => $sprs,
		));
	}
	
	public function Bsprs()
    {
		
		$bestSellers = DB::table('order_items')
        ->select('product_id', DB::raw('SUM(quantity) as total_quantity'))
        ->groupBy('product_id')
        ->orderBy('total_quantity', 'desc')
        ->take(10) 
        ->get(); 
        $productIds = $bestSellers->pluck('product_id'); 
		  
        $bestprs = \App\Models\Product::whereIn('id', $productIds)->get();
		
		//dd($bestprs); 

      	return response()->json(array(
			'bsprs' => $bestprs,
		));
	}

	
	 public function childsCat( $id )
    {
		
		$cat= Category::find($id);
		$childrens = $cat->child ;

      	return response()->json(array(
			'childrens' => $childrens,
		));
	}
	
			
	 public function catProductsOld(Request $request)
    {
		
		$cat= Category::find($request->id);
		$prs = $cat->products ;

      	return response()->json(array(
			'prs' => $prs,
			'catParentId' => $cat->theparnt->id,
			'currentCatTitle' => $cat->title,
		));
	}
	//vue home products
	public function home()
    {
        
		$homeprs= Product::where('athome','1')->limit(10)->get();
		$laprs= Product::where('best','1')->limit(9)->get();
		$saleprs= Product::where('sale_price', '>' , '0')->get();
		$brands= Brand::all();
		$catparents= Category::where('parnt', '999')->get();
		
		return response()->json(array(
		    
		'homeprs' => $homeprs,
		'laprs' => $laprs,
		'saleprs' => $saleprs,
		'brands' => $brands,
		'cats' => $catparents,
		
		));
	}


    public function addToCartSingleItem(Request $request ,$lang = null)
    {
      // dd($request->all());
	  $product = Product::find($request['productId']);
	 // $options = collect($request)->except(['_token', 'productId', 'price', 'quantity','action'])->toArray();	
	  $price = $product->price ;	
	 // $local = session()->get('local');
	Cart::add($product->id, $product->name, $price ,$request['quantity'] , [] )->associate($product);
	 $added = 'Product added to cart';

	  return compact('added');
		
  }
 

    public function getCart($lang=null)
    {
        $cart_content = Cart::getContent();
      		return response()->json(array(
			'cart' => $cart_content,
		));
    }
}
