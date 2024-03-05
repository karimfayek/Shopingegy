<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessTokenFactory;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
class CheckoutController extends Controller
{

    public function InitiatePayment(Request $request)
    {
       // dd($request->all());
        $request->validate([
            'token' => 'required', // Ensure 'token' is present in the request
            
        ]);
         // Make API requests to 2Checkout for payment processing
         $apiEndpoint = 'http://sandbox.2checkout.com/rest/6.0/checkout/payment';
         $privateKey = 'CEC2B7BC-D0ED-46CA-924B-307F21A34BC1' ;
         $headers = [
             'Content-Type' => 'application/json',
             'Accept' => 'application/json',
             'Authorization' => 'Basic ' . base64_encode($privateKey . ':'),
         ];
 
         // Prepare data for the API request
         $requestData = [
             'Currency' => 'EGP', 
             'Payment' => [
                 'Type' => 'EES\_TOKEN\_ONLY', // Use EES (Direct API) for token-based payments
                 'Currency' => 'EGP', 
                 'Recurring' => 'N', 
                 'Items' => [
                     [
                         'Price' => 19.99, // Replace with the actual price
                         'Quantity' => 1,
                         'Currency' => 'EGP', 
                         'SKU' => 'your\_product\_sku', // Replace with your product SKU
                         'Description' => 'Product Description', // Replace with your product description
                     ],
                     // Add more items as needed
                 ],
             ],
             'BillingAddr' => [
                 // Include billing address details
             ],
             "demo" =>true , 
             "verifySSL" =>  false , 
             'Token' => $request->input('token'), // Use the token obtained from the frontend
         ];
 
         try {
             // Make the API request using Guzzle or any HTTP client of your choice
             $client = new \GuzzleHttp\Client([
                'verify' => 'c:\cacert.pem', // Replace with the actual path to cacert.pem
            ]);
             $response = $client->post($apiEndpoint, [
                 'headers' => $headers,
                 'json' => $requestData,
             ]);
 
             // Handle the API response, e.g., check for success, update order status, etc.
 
             // For simplicity, we'll assume success and return a response to the frontend
             return response()->json(['success' => true]);
         } catch (\Exception $e) {
             // Handle API request failure
             return response()->json(['error' => $e->getMessage()], 500);
         }


    }
    
}