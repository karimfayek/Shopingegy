<?php

namespace App\Http\Controllers\Site;

use Illuminate\Support\Facades\DB;

use Session;
use Mail;
use Cart;

use App\Models\OrderItem;
use App\Mail\SendCartEmail;
use App\Mail\SendEmail;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Cms;


use App\Models\Message;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    

	public function show()
    {
        $blogs =   Cms::where('blog', 1)->where('published', 1)->orderBy('order_no' , 'asc')->get();
        $homeprs = Product::where('featured', 1)->where('status', 1)->limit(10)->get();
        $saleprs = Product::where('sale_price',  '>' , 0)->where('status', 1)->get();
        $laprs =   Product::where('featured', 1)->where('status', 1)->limit(10)->get();
        $thirtyDaysAgo = now()->subDays(30);
		$newprs =  Product::where('created_at', '>', $thirtyDaysAgo)->get();
        $certs =   Cms::where('cert', 1)->where('published', 1)->orderBy('order_no' , 'asc')->get();
        $whys =    Cms::where('adv', 1)->where('published', 1)->orderBy('order_no' , 'asc')->get();
        $banners = Banner::where('status', 1)->limit(10)->get();
        $mission = Cms::where('mission', 1)->where('published', 1)->first(); 
        $about =   Cms::where('slug', 'about')->where('published', 1)->first();    
        $vision =  Cms::where('vision', 1)->where('published', 1)->first();
        // Display top 10 best sellers
        $bestSellers = DB::table('order_items')
        ->select('product_id', DB::raw('SUM(quantity) as total_quantity'))
        ->groupBy('product_id')
        ->orderBy('total_quantity', 'desc')
        ->take(10) 
        ->get(); 
        $productIds = $bestSellers->pluck('product_id');    
        $bestprs = Product::whereIn('id', $productIds)->get();

        $parentcats =   Category::where('parent_id', 1)->where('menu', 1)->orderBy('order_no' , 'asc')->get();

        // local
        session()->put('local', 'en');

        return view('site.pages.homepage', compact('parentcats' ,'homeprs','banners' , 'about' ,'laprs', 'whys','newprs','bestprs', 'blogs', 'mission' , 'vision'));
    }
    public function showen()
    {
        $blogs =   Cms::where('blog', 1)->where('published', 1)->orderBy('order_no' , 'asc')->get();
        $homeprs = Product::where('featured', 1)->where('status', 1)->limit(10)->get();
        $saleprs = Product::where('sale_price',  '>' , 0)->where('status', 1)->get();
        $laprs =   Product::where('featured', 1)->where('status', 1)->limit(10)->get();
        $thirtyDaysAgo = now()->subDays(30);
		$newprs =  Product::where('created_at', '>', $thirtyDaysAgo)->get();
        $certs =   Cms::where('cert', 1)->where('published', 1)->orderBy('order_no' , 'asc')->get();
        $whys =    Cms::where('adv', 1)->where('published', 1)->orderBy('order_no' , 'asc')->get();
        $banners = Banner::where('status', 1)->limit(10)->get();
        $mission = Cms::where('mission', 1)->where('published', 1)->first(); 
        $about =   Cms::where('slug', 'about')->where('published', 1)->first();    
        $vision =  Cms::where('vision', 1)->where('published', 1)->first();
        // Display top 10 best sellers
        $bestSellers = DB::table('order_items')
        ->select('product_id', DB::raw('SUM(quantity) as total_quantity'))
        ->groupBy('product_id')
        ->orderBy('total_quantity', 'desc')
        ->take(10) 
        ->get(); 
        $productIds = $bestSellers->pluck('product_id');    
        $bestprs = Product::whereIn('id', $productIds)->get();

        $parentcats =   Category::where('parent_id', 1)->where('menu', 1)->orderBy('order_no' , 'asc')->get();

        // local
        session()->put('local', 'en');

        return view('site.pages.homepage', compact('parentcats' ,'homeprs','banners' , 'about' ,'laprs', 'whys','newprs','bestprs', 'blogs', 'mission' , 'vision'));
    }

    public function showar()
    {
        $blogs = Cms::where('blog', 1)->where('published', 1)->orderBy('order_no' , 'asc')->get();
        $homeprs = Product::where('featured', 1)->where('status', 1)->limit(10)->get();
        $saleprs =  Product::where('sale_price',  '>' , 0)->where('status', 1)->get();
        $laprs =  Product::where('featured', 1)->where('status', 1)->limit(10)->get();
        $thirtyDaysAgo = now()->subDays(30);
		$newprs =  Product::where('created_at', '>', $thirtyDaysAgo)->get();
        $certs = Cms::where('cert', 1)->where('published', 1)->orderBy('order_no' , 'asc')->get();
        $whys = Cms::where('adv', 1)->where('published', 1)->orderBy('order_no' , 'asc')->get();
        $banners = Banner::where('status', 1)->limit(10)->get();
        $bestSellers = DB::table('order_items')
        ->select('product_id', DB::raw('SUM(quantity) as total_quantity'))
        ->groupBy('product_id')
        ->orderBy('total_quantity', 'desc')
        ->take(10) // Display top 10 best sellers
        ->get();
        
        
        $mission = Cms::where('mission', 1)->where('published', 1)->first();        
        $vision = Cms::where('vision', 1)->where('published', 1)->first();
        $about = Cms::where('slug', 'about')->where('published', 1)->first(); 
        $productIds = $bestSellers->pluck('product_id');    
        $bestprs = Product::whereIn('id', $productIds)->get();
    
    $parentcats =   Category::where('parent_id', 1)->where('menu', 1)->orderBy('order_no' , 'asc')->get();
        session()->put('local', 'ar');
        return view('site.pages.homepage', compact('parentcats' ,'homeprs','banners' , 'about' ,'laprs', 'whys','newprs','bestprs', 'blogs', 'mission' , 'vision'));
    }
    public function lang($lang)
    {
        session()->put($lang);
        return back() ; 
    }  

    public function Heading()
    {
        $local = \Session::get('local');
        if ($local == "ar"){
        
            $sitename = config('settings.site_title');
             $heading = [                
             'total' => 'المجموع' ,
             'subtotal' => ' المجموع الفرعى' ,
             'viewcart' => 'عرض السلة ' ,
             ];
        }
        else {
            $heading = [                
             'total' => 'Total' ,
             'subtotal' => 'Sub Total' ,
             'viewcart' => 'View Cart' ,
            ];
        }
        return response()->json(array(
			'heading' => $heading,
		));
    }

	public function Products($lang= null)
    {
        if($lang == 'ar'){
            session()->put('local', 'ar');
        }else{
            session()->put('local', 'en');        
        }
        return view('site.pages.products');
    }

    public function Shop($lang= null)
    {
        $products = \App\Models\Product::where('status' , 1)->get();
        if($lang == 'ar'){
            session()->put('local', 'ar');
        }else{
            session()->put('local', 'en');        
        }
        return view('site.pages.shop' , compact('products'));
    }

	public function contact($lang=null)
    {
        if($lang == 'ar'){
            session()->put('local', 'ar');
        }else{
            session()->put('local', 'en');        
        }
        return view('site.pages.contact');
    }

    public function newsletter(Request $request)
    {
		     $this->validate($request, [
            'email'      =>  'required|email',
	]);
   
    $subscribed = Message::where('type' , 'newsletter')->where('email' , $request->email)->first();

        if (  !$subscribed  ) 
        {
            $message = new Message;
            $message->type ='newsletter';
            $message->email = $request->email;            
            $message->save();
            if($request->lang == 'ar'){
            return 'شكرا , تم الاشتراك فى النشرة الاخبارية ';
            }else{
                return 'Thanks , You are successfuly subscribed ';
            }
        }
        if($request->lang == 'ar'){
            return 'انت مشترك بالفعل';
            }else{
                return 'You are already Subscribed ';
            }
      
            
    }

    public function brands()
    {
        $brands = \App\Models\Brand::all();

        return view('site.pages.brands',compact('brands'));
    }

    public function brand($slug)
    {
        $brand = \App\Models\Brand::where('slug' , $slug)->firstOrFail();

        return view('site.pages.brand',compact('brand'));
    }
    
    public function Profile($lang=null)
    {
        $user = \Auth::user();
        $states = \App\Models\State::all();
        if($lang == 'ar'){
            $heads = [
                'dashboard' => 'مرحبا' , 
                'orders' => 'الطلبات' , 
                'address' => 'العناوين' , 
                'accountdetails' => 'تفاصيل الحساب ' , 
                'logout' => 'تسجيل الخروج' , 
            ];
            session()->put('local', 'ar');
        }else{
            $heads = [
                'dashboard' => 'Dashboard' , 
                'orders' => 'Orders' , 
                'address' => 'Address' , 
                'accountdetails' => 'Account Details' , 
                'logout' => 'Logout' , 
            ];
            session()->put('local', 'en');        
        }
        return view('site.pages.account.profile',compact('user', 'heads' , 'states'));
    }

		public function contactm(Request $request)
    {
		//dd($request->all());
        $this->validate($request,[
            "email"=> 'email',
			"message"=> 'required',
			"phone"=> 'required',
            'name'=> 'min:3',
        // 'g-recaptcha-response' => 'required|captcha',
        ]);
		
			$name= $request->name;
			$email= $request->email;
			$phone= $request->phone;
			$message= $request->message;
			$sitmail= config('settings.inquery_mail');
            $message = new Message;
            $message->type ='contact';
            $message->email = $request->email; 
            
            $message->name = $request->name; 
            $message->phone = $request->phone; 
            $message->message = $request->message;            
            $message->save();
			Mail::to($sitmail)->send( new SendEmail($name,$email,$phone,$request->message));

		  Session::flash('success');
         // return response()->json('message sent ');
		  return back()->with('success', 'message sent ');
    }

    
	public function ProfileUdate(Request $request)
    {
        $user = \Auth::user();
        $user->first_name = $request->first_name ;
        $user->last_name = $request->last_name ;
        $user->address = $request->address ;

        $user->save() ; 
        return back()->with('success' , 'Updated');
    }
		public function placeorder(Request $request)
    {
		//dd($request->all());
        $this->validate($request,[
			"phone"=> 'required',
            'name'=> 'min:3',
			"address"=> 'required',
			"city"=> 'required',
            //'g-recaptcha-response' => 'required|captcha',
        ]);
        if(\Auth::check()){
            $userId = \Auth::user()->id ;            
        }else{
            $userId = 1 ;   
        }
		$order = Order::create([
            'order_number'      =>  'ORD-'.strtoupper(uniqid()),
            'user_id'           => $userId,
            'status'            =>  'pending',
            'grand_total'       =>  Cart::getSubTotal(),
            'item_count'        =>  Cart::getTotalQuantity(),
            'payment_status'    =>  0,
            'payment_method'    =>  null,
            'first_name'        =>  $request->name,
            'last_name'         =>  $request->name,
            'address'           =>  $request->address,
            'city'              =>  'cairo',
            'country'           =>  'egypt',
            'post_code'         =>  '11231',
            'phone_number'      =>  $request->phone,
            'notes'             =>  $request->notes
        ]);

        if ($order) {

            $items = Cart::getContent();

            foreach ($items as $item)
            {
                // A better way will be to bring the product id with the cart items
                // you can explore the package documentation to send product id with the cart
                $product = Product::where('name', $item->name)->first();

                $orderItem = new OrderItem([
                    'product_id'    =>  $product->id,
                    'quantity'      =>  $item->quantity,
                    'price'         =>  $item->getPriceSum()
                ]);

                $order->items()->save($orderItem);
            }
        }
        $data= $request->except('_token','g-recaptcha-response');
        $cart=\Cart::getContent();
		$sitmail = config('settings.inquery_mail');
       Mail::to($sitmail)->send( new SendCartEmail($data,$cart));
       $clearcart = \Cart::clear();	 
	   $order_no =  Order::latest('id')->first();
      return back()->with('success', 'Thanks Order recived , We will contact you , your Order Number Is: '.$order_no->order_number );
    }
	public function search(Request $request , $lang =null)
    {
		$q=$request->q;
        if ($q != " "){
            $products = Product::where('name', 'LIKE', '%'. $q . '%')
            ->orWhere('name2', 'LIKE', '%'. $q . '%')
            ->orWhere('description', 'LIKE', '%'. $q . '%')
            ->orWhere('description2', 'LIKE', '%'. $q . '%')
            ->orWhere('sku', 'LIKE', '%'. $q . '%')
            ->orWhere('price', 'LIKE', '%'. $q . '%')
            ->get();
            
                $cats = Category::where('name', 'LIKE', '%'. $q . '%')
                ->orWhere('name2', 'LIKE', '%'. $q . '%')
                ->orWhere('description', 'LIKE', '%'. $q . '%')
                ->orWhere('description2', 'LIKE', '%'. $q . '%')
                ->get();
                if($lang == 'ar'){
                    session()->put('local', 'ar');
                }else{
                    session()->put('local', 'en');        
                }
                if ($request->expectsJson()) {
                    return response()->json(array(
                        'cats' => $cats,
                        'products' => $products,
                    ));
                }
        
                return view('site.pages.search-result',compact('products', 'cats'));
            

            }
	}

	
		public function page($slug , $lang=null)
    {
		$page = Cms::where('slug' , $slug)->first();
        
        $mission = Cms::where('mission', 1)->where('published', 1)->first();        
        $vision = Cms::where('vision', 1)->where('published', 1)->first();
        if($lang == 'ar'){
            session()->put('local', 'ar');
        }else{
            session()->put('local', 'en');        
        }
			return view('site.pages.page',compact('page' , 'mission' , 'vision'));
    }
}
