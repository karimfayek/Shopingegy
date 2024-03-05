<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\CategoryContract;
use App\Contracts\AttributeContract;
use Illuminate\Support\Facades\DB;
class CategoryController extends Controller
{
    protected $categoryRepository;
	protected $attributeRepository;

    public function __construct(CategoryContract $categoryRepository, AttributeContract $attributeRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->attributeRepository = $attributeRepository;
    }

    public function show(Request $request , $slug , $lang= null)
    {
        $category =  \App\Models\Category::where('slug' , $slug)->with('children')->with('children.products')->with('children.parent')->firstOrFail();
        $brands= \App\Models\Brand::all();
        $attributes = $this->attributeRepository->listAttributes();
        $parentCatProductsCount = null ;
		if ($category->parent_id === 1) {
            // If it's a parent category, get all its children categories
            $childCategories = $category->children()->pluck('id')->toArray();
    
            // Include the parent category ID as well
            $categoryIds = array_merge($childCategories, [$category->id]);
    
            $catprs = DB::table('product_categories')
                ->whereIn('category_id', $categoryIds)
                ->join('products', 'product_categories.product_id', '=', 'products.id')
                ->select('products.*')                
                ->get();
               // dd($pagproducts);
               $catprsArr = $catprs->pluck('id')->toArray();
               //dd($catprsArr);
               $pagproducts =\App\Models\Product::whereIn('id', $catprsArr)->paginate(16);
              // dd($products);
               foreach( $pagproducts as $pr){
                //dd(collect($pagproducts));
                $pr['first_image'] =\App\Models\Product::find($pr->id)->first_image ;
                $pr['last_image'] = $pr->last_image ;
               }
              
              // $pagproducts = $products->paginate(16);
        } else {
            // If it's not a parent category, simply get its products
           // dd($category->parent->products);
           
        $parent = $category->parent->slug ; 
        $Parentcategory =$this->categoryRepository->findBySlug($parent);
        $childs = $Parentcategory->children;
       $parentCatProductsCount = 0 ;
       foreach($childs as $child){
        $parentCatProductsCount += $child->products->count() ; 
       
       }
 //dd($parentCatProductsCount);
            $pagproducts = $category->products()->with('images')->paginate(16);
        }
        $minPrice = $category->products()->min('price');
		$maxPrice =  $category->products()->max('price');
		
		$min = (int)$minPrice;
		$max =  (int)$maxPrice;
        if ($request->expectsJson()) {
        return response()->json(array(
			'brands' => $brands,
			'products' => $pagproducts,
			'minPrice' => $min,
			'maxPrice' => $max,
			'category' => $category,
			'parentCatProductsCount' => $parentCatProductsCount,
		));
    }
      
            if($lang == 'ar' ){
                session()->put('local', 'ar');
            }else{
                session()->put('local', 'en');        
            }
      

        return view('site.pages.category', compact('category','attributes','pagproducts' , 'brands', 'parentCatProductsCount'));
    }
	public function showar($slug)
    {
        $category = $this->categoryRepository->findBySlug($slug);
        $attributes = $this->attributeRepository->listAttributes();
		$pagproducts = $category->products()->paginate(12);

        return view('site.pages.ar.category2', compact('category','attributes','pagproducts'));
    }
}
