<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Product;
use App\Models\Translation;
use App\Http\Requests\StoreProductFormRequest;

class ReviewController extends Controller
{
	
   public function add(Request $request)
	 {
		 //dd($request->all());
            $validated = $request->validate([
        'rating' => 'required|integer',
        'comment' => 'required|max:1000',
        'name' => 'required|max:20',
    ]);
            $review = new Review;
            $review->user_id = \Auth::user()->id;
			$review->product_id = $request->product_id;
			$review->rate = $request->rating;
			$review->review = $request->comment;
			$review->name = $request->name;
			$review->status = 0;
            $review->save();
			 \Session::flash('reviewaddedd');
		  return back();
	}

	public function addGet(Request $request , $id , $lang=null)
	{
		   $product = \App\Models\Product::find($id);
		  $reviews = \App\Models\Review::where('user_id', auth()->id())->where('product_id' , $id)->get();
		   //dd($translations);
		   if($lang == 'ar'){
            session()->put('local', 'ar');
        }else{
            session()->put('local', 'en');        
        }
			return view('site.pages.account.addreview', compact('product', 'reviews'));
  	 }
	   public function adminadd()
	 {
		 $products = Product::all();
            return view('admin.reviews.add', compact('products'));
	}
		   public function adminupdate(Request $request)
	 {
		 //d($request->all());
            $validated = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email',
        'rate' => 'required|integer',
        'comment' => 'required|max:1000',
    ]);
            $review = new Review;
            $review->user_id = 0;
			$review->product_id = $request->product_id;
			$review->name = $request->name;
			$review->email = $request->email;
			$review->rate = $request->rate;
			$review->review = $request->comment;
			$review->status = 1;
            $review->save();
			 \Session::flash('reviewaddedd');
		 return redirect()->to('/admin/reviews');
	}
	
	  public function index()
    {
        $reviews = Review::all();

        return view('admin.reviews.index', compact('reviews'));
    }
	public function edit($id)
    {
		$review = Review::find($id);

		return view('admin.reviews.edit', compact('review'));
    }
	 public function update(Request $request)
    {
		//dd($request->all());
		$review = Review::find($request->review_id);
        $status = $request->has('status') ? 1 : 0;
			$review->name = $request->name;
			$review->email = $request->email;
			$review->rate = $request->rate;
			$review->review = $request->comment;
			$review->status = $status;
            $review->save();
			$reviews_pr =  $review->product_id ;
			$reviews_product = Product::find($reviews_pr);
			$reviews_count = Review::where('product_id' , $reviews_pr)->where('status', 1)->count();
			$reviews_sum = Review::where('product_id' , $reviews_pr)->where('status', 1)->sum('rate');
			if($reviews_count > 0){
				$final_review = $reviews_sum / $reviews_count ;
			}else{
				
			$final_review = 0 ;
			}
			$reviews_product->rating = $final_review ;
			$reviews_product->save();
			if (!$review) {
            return $this->responseRedirectBack('Error occurred while updating Review.', 'error', true, true);
        }
        return redirect()->to('/admin/reviews');
    }
	
	 public function delete($id)
    {

        $review = Review::find($id);
        $review->delete($review);
        return back();

    }
}
