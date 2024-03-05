<h3>You Have a new order from website

  </h3>
<h4>Order number</h4> <p>{{$e_order->order_number}}</p>
<h4>Date </h4><p>{{ $e_order->created_at->toFormattedDateString() }}</p>
<h4>Total</h4><p> {{$e_order->grand_total}}</p>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
 <h2>Customer Information</h2>
 <table>
    <tbody>
       <tr>
          <td>
            Full name	
          </td>
          <td>
             <span>{{  $e_order->name  }}</span>	
          </td>
       </tr>
       <tr>
          <td>
            Email
          </td>
          <td>
             <span>{{  $e_order->email  }}</span>	
          </td>
       </tr>
	   
	   
       <tr>
          <td>
           Address	
          </td>
          <td>
             <span>{{  $e_order->address }} <br>{{ $e_order->city }}, {{ $e_order->country }} {{ $e_order->post_code }}<br>{{ $e_order->phone_number }}<br></span>	
          </td>
       </tr>
	   
	   
    </tbody>
 </table>
 <h2>Order details</h2>
 <table>
    <thead>
       <tr>
          <th>Product</th>
          <th>Total</th>
          <th>Avilable Quantity </th>
       </tr>
    </thead>
    <tbody>
          @foreach($e_order->items as $item)
       <tr>
          <td>
             <a >{{ $item->product->name }}</a> <strong>&times;&nbsp;{{ $item->quantity }}</strong>	
          </td>
          <td>
             <span><bdi><span>L.E</span>{{  $item->price  }}</bdi></span>	
          </td>
          <td>
             <span>{{  $item->product->quantity  }}</span>	
          </td>
       </tr>
       @endforeach
    </tbody>
    <tfoot>
       <tr>
          <th scope="row">Payment method:</th>
          <td>{{ $e_order->payment_method }}</td>
       </tr>
       <tr>
          <th scope="row">Total:</th>
          <td><span><span>L.E</span>{{$e_order->grand_total}}</span></td>
       </tr>
    </tfoot>
 </table>

<div>
    <h4>Order Notes</h4>
    <p>{{$e_order->notes}} </p>

</div>
<a href="{{ url('/') }}//orders/show/{{$e_order->id}}"> View In Website Control Panel</a>
