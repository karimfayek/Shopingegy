<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Rules\ValidPhoneNumber;
class AccountController extends Controller
{
    public function getOrders()
    {
        $orders = auth()->user()->orders;

        return view('site.pages.account.orders', compact('orders'));
    }

    public function getUser()
    {
        if(\Auth::check()){
            $user = auth()->user() ; 
            $user['wishlists'] =  auth()->user()->wishlists; 
            return response()->json([
                'user' => $user ,
                'auth' => true ,
            ]);
        }else{
            return response()->json([
                'auth' => false ,
            ]);  
        }
        $orders = auth()->user()->orders;

        return view('site.pages.account.orders', compact('orders'));
    }
	  public function ProfileUpdate(Request $request)
    {
		$request['phone'] = '+2'.$request['phone'] ;
		  $request->validate([
        'first_name' => 'required|string|max:255|min:3',
        'last_name' => 'required|string|max:255|min:3',
        'email' => 'required|string|email|max:255|unique:users,email,' . \Auth::id(),
        'phone' => ['required', new ValidPhoneNumber],
        'city' => 'required|numeric',
        'address' => 'required|string|max:255|min:20',
        'current_password' => 'required_with:new_password|string',
        'new_password' => 'nullable|string|min:8|confirmed',
		]);
		  \Auth::user()->update([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'address' => $request->address,
        'city' => $request->city,
        'email' => $request->email,
        'phone' => $request->phone,
    ]);
       // Update password if new password is provided
    if ($request->filled('new_password')) {
        // Verify current password
        if (!Hash::check($request->current_password, \Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'The provided current password is incorrect.']);
        }

        // Update password
        \Auth::user()->update([
            'password' => Hash::make($request->new_password),
        ]);
    }

    return redirect()->back()->with('success', 'Profile updated successfully.');

    }
	
	
    public function orderDetails($no , $lang=null)
    {
        $order = \App\Models\Order::where('order_number', $no)->where('user_id' , \Auth::id())->first();
        //dd($order) ;
        $orders = auth()->user()->orders;
        if($lang == 'ar'){
            session()->put('local', 'ar');
        }else{
            session()->put('local', 'en');        
        }
        return view('site.pages.account.order', compact('order'));
    }
}
