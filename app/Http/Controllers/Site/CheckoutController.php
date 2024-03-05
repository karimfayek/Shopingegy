<?php

namespace App\Http\Controllers\Site;

use Cart;
use App\Models\Order;
use App\models\Category;
use Illuminate\Http\Request;
use App\Contracts\OrderContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

use Mail;

use App\Mail\SendEmail;

use App\Mail\SendCheckOutEmailCustomer;
use App\Mail\SendCheckOutEmailAdmin;

class CheckoutController extends Controller
{

    protected $orderRepository;

    public function __construct(OrderContract $orderRepository)
    {
        
        $this->orderRepository = $orderRepository;
    }

    public function getCheckout()
    {
        $states= \App\models\State::where('ship' , 1)->get();
        return view('site.pages.checkout' , compact('states'));
       
    }
    public function getStates()
    {
        $states= \App\models\State::where('ship' , 1)->get();
        $codFees= config('settings.cod_fees') ;
      
        $cond =  Cart::getCondition('Shippingto');
       if($cond){

        $shipprice = $cond->getValue();
       }else{
        
       $shipprice = 0;
       }
       if (auth()->check()) {
        $user =\Auth::user() ;
       
        $auth = true ; 
       }else{
        $auth = false ;
        $user = null ;
       }

       $responseData = [
        'states' => $states,
        'shipprice' => $shipprice,
        'auth' => $auth,
        'user' => $user,
        'codFees' => $codFees,
    ];
    
    return response()->json($responseData);
       
    }
    

    public function setShipping($city)
    {
        $state= \App\models\State::find($city);
        $price= $state->ship_price ;
        $cartCondition = new \Darryldecode\Cart\CartCondition([
            'name' => 'Shippingto',
            'type' => 'price',
            'target' => 'total', // this condition will be applied to cart's subtotal when getSubTotal() is called.
            'value' => $price,
            'attributes' => array()
        ]);
		 \Cart::condition($cartCondition);
        
        return response()->json($price);
       
    }
    
    public function getCheckoutGuest()
    {
        $states= \App\models\State::where('ship' , 1)->get();
       
        return view('site.pages.checkout' , compact('states'));
    }
	    
    public function storeOrder(Request $params)
    {
                 
    try {
        $this->validate($params, [
            'last_name'      =>  'required|max:191|min:3',
            'first_name'      =>  'required|max:191|min:3',
            'city'      =>  'required|max:191',
            'address'      =>  'required|max:191',
            'phone'      =>  'required|max:191',
           // 'g-recaptcha-response' => 'required|captcha',
    ]);

    } catch (ValidationException $e) {
        // Handle validation errors and return a JSON response
        return response()->json([
            'success' => false ,
            'message' => 'Validation failed',
            'errors' => $e->errors(),
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
    }

    $state = \App\Models\State::find($params['city']);
    $otherFees = $params['selectedPayment'] == 'credit-card' ? 0 : config('settings.cod_fees') ;
   
    if (auth()->check()) {
        $userid= auth()->user()->id ;
        
    }else{
        $userid= 1 ;  
        
    }
    Cart::clearCartConditions();
     $order = Order::create([
            'order_number'      =>  'ORD-'.strtoupper(uniqid()),
            'user_id'           =>  $userid ,
            'status'            =>  'pending',
            'sub_total'       =>  Cart::getTotal()  ,
            'grand_total'       =>  Cart::getTotal() + $state->ship_price + $otherFees ,
            'item_count'        =>  Cart::getTotalQuantity(),
            'payment_status'    =>  0,
            'ship_fees'           =>  $state->ship_price,
            'other_fees'           =>  $otherFees,
            'payment_method'    => $params['selectedPayment'],
            'first_name'        =>   $params['first_name'],
            'last_name'        =>   $params['last_name'],
            'post_code'        =>  '1131',
            'address'           =>  $params['address'],
            'country'           =>  48,
            'company'           =>  $params['company'],
            'city'           =>  $params['city'],
            'phone_number'      =>  $params['phone'],
            'viewed'      =>  0,
            'notes'             =>  $params['notes']
        ]);
         if ($order) {

            $items =  Cart::getContent();
          
            foreach ($items as $item)
            {
                // A better way will be to bring the product id with the cart items
                // you can explore the package documentation to send product id with the cart
                $product = \App\Models\Product::where('name', $item->name)->first();

                $orderItem = new \App\Models\OrderItem([
                    'product_id'    =>  $product->id,
                    'quantity'      =>  $item->quantity,
                    'price'         =>  $item->price * $item->quantity,
                ]);

                $order->items()->save($orderItem);
            }
        }
        if($params['selectedPayment'] == 'credit-card'){
            Cart::clear();
            Cart::clearCartConditions();
            return response()->json(['order' => $order ,  'success' => true]);
           

        }else{

        
            if(!is_null($params['email'])){
                $userMail = $params['email'] ;
                Mail::to($userMail)->send( new SendCheckOutEmailCustomer($items,$order));
                        
            }
            $adminMail =  'support@egyptianit.com.eg' ;          
            Mail::to($adminMail)->send( new SendCheckOutEmailAdmin($items , $order));
            foreach($order->items as $item){
                $product = \App\Models\Product::where('id' , $item->product_id)->first();
                $product->quantity = $product->quantity - $item->quantity ;
                $product->save();
            }
            Cart::clear();
            Cart::clearCartConditions();
            return response()->json(['order' => $order ,  'success' => true]);
        }
        
		//return redirect()->route('payment', [$order->id]);
    
  
    }
    public function payment($orderno)
    {
        
		$cats = Category::where('menu','1')->get();
       $ordert = Order::find($orderno);
       $cart = Cart::getContent();	       
		$cartcount= Cart::getTotalQuantity();
        $cart_total = $ordert->grand_total ; 
       $order = array(
        'mid' => 'MID-6887-897',
        'currency'=> 'EGP',
        'ammount' => $cart_total,
        'merchantOrderId'=> time(),
        'secret'=>"0fb08712-698d-4275-be56-55da5ee707f8",
        'iframeSecret'=>"0fb08712-698d-4275-be56-55da5ee707f8",
        'HPPSecret'=> "b6056746-af1f-4555-bfc7-d97aef5d5cb9",
        'baseUrl'=>"https://checkout.kashier.io",
        
        //  'secret'=>"a3dbe527-1a99-4c28-b380-145fc0ffad9a",
        //'iframeSecret'=>"a3dbe527-1a99-4c28-b380-145fc0ffad9a",
        //'HPPSecret'=> "dfe7e102-106a-4fe2-8cb6-bacd22a774b8",
        //  'baseUrl'=>"https://test-iframe.kashier.io",
        );


$hash = $this->generateKashierOrderHash($order);

$order['secret']= $order['HPPSecret'];
$hppHash = $this->generateKashierOrderHash($order);

$callbackUrl = urlencode('http://diy.eit-host.com/iframecallback/'. $ordert['id']);
		return view('site.pages.payment',[
		'data'=>$cart,'cartcount'=>$cartcount,'cats'=>$cats,'cart_total'=>$cart_total,
		'hppHash' => $hppHash ,
		'order' => $order ,
		'callbackUrl' => $callbackUrl,
		'hash'=> $hash,
        'currency' => "EGP",
		]);
        
    }
    function generateKashierOrderHash($order){

$mid = $order['mid']; 

$amount = $order['ammount']; 

$currency = $order['currency']; 

$orderId = $order['merchantOrderId'];

$secret = $order['secret'];

$path = "/?payment=".$mid.".".$orderId.".".$amount.".".$currency;
return hash_hmac( 'sha256' , $path , $secret ,false);
}

    public function iframecallback(Request $request, $id){
        
    $queryString = "";
    $secret = "0fb08712-698d-4275-be56-55da5ee707f8";
    
    foreach ($_GET as $key => $value) { 
        if($key == "signature" || $key== "mode"){
            continue;
        }
        $queryString = $queryString."&".$key."=".$value;
       
    }
    $queryString = ltrim($queryString, $queryString[0]); 
     
    $signature = hash_hmac( 'sha256' , $queryString , $secret ,false);
    
    if($signature == $_GET["signature"]){
        
    $order = Order::find($id);
    $order->paymob_order_id = $_GET["transactionId"];
    //dd($_GET);
    $order->payment_status = 1 ;
    $order->save() ; 
    foreach($order->items as $item){
        $product = \App\Models\Product::where('id' , $item->product_id)->first();
        $product->quantity = $product->quantity - $item->quantity ;
        $product->save();
    }
    
        
    Cart::clear();
    Cart::clearCartConditions();
        if(!is_null($order->email)){
        	$userMail = $order->email ;
        	Mail::to($userMail)->send( new SendCheckOutEmailCustomer($cart,$order));
                    
        }
		$adminMail =  'support@egyptianit.com.eg' ;
		$cart =  Cart::getContent() ;	
		Mail::to($adminMail)->send( new SendCheckOutEmailAdmin($cart , $order));
		
        return redirect('/succsess'. $order->id);
    }else{
        echo "Failed";
    }
    }
  	public function success($id)
    {
        $order = Order::find($id);
		$cartcount=Cart::getTotalQuantity();
        	return view('site.pages.success',compact('order','cartcount'));
    }

 

  
}
