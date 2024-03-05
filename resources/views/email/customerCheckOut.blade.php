
<div>
<div style="background:#eceff1;color:#000;font-family:arial"><div>
    <div style="border:1px solid #3cb54a;padding:25px">&nbsp;
<div style="max-width:770px;margin:0 auto;display:block;clear:both;overflow:hidden">
    <div style="width:100%">&nbsp;
<a href="#" style="overflow:hidden;float:left;display:inline-block" target="_blank" rel="noreferrer"><img style="   max-width: 100px;"
src="https://diytoolseg.com/images/logo-default-114x27.png" alt="DiyTools logo"></a>
 <span style="font-size:14px;text-align:right;float:right;margin-top:30px;display:inline-block;font-weight:bold">DiyTools Team</span>&nbsp;</div></div>
<div style="border:1px solid #97d89f;padding:35px;background:#fff;max-width:700px;margin:0 auto;display:block;clear:both;overflow:hidden">&nbsp;<h1 style="font-size:14px">
    Hello {{$e_order->name}},</h1>
<div style="background-color:#dff0d8;border:1px solid #d6e9c6;color:#3c763d;padding:10px;font-weight:bold;margin:0 auto 15px;font-size:12px">Thank you for ordering from <a href="https://DiyToolseg.com/" style="color:#3cb54a" target="_blank" rel="noreferrer">DiyToolseg.com</a>&nbsp;</div>
<h2 style="font-size:12px">This e-mail regarding your order details :</h2>
<ul style="list-style:none;font-size:12px;padding-left:0px;line-height:20px">
<li>Order Number : <strong>{{$e_order->order_number}}</strong>
</li>
<li>Payment Method : <strong>{{$e_order->payment_method}}</strong>
</li>
</ul>
<h3>Order Details</h3>
<table style="width:100%;border-collapse:collapse;border:1px solid #e3e3e3;margin-bottom:15px" cellpadding="10">
<thead><tr><th style="border:1px solid #e3e3e3;text-align:left" colspan="3">3 to 5 Working Days</th></tr></thead>
<tbody>
<tr style="vertical-align:middle">
<th style="border:1px solid #e3e3e3;font-size:14px">Image</th>
<th style="border:1px solid #e3e3e3;font-size:14px">Product Details</th>
<th style="border:1px solid #e3e3e3;font-size:14px">Unit Price</th>
</tr>
<tr style="vertical-align:middle;text-align:center">
    
          @foreach($e_order->items as $item)
<td style="border:1px solid #e3e3e3">
    @if($item->product->images->count())
    <a href="#"><img src="https://DiyToolseg.com/storage/{{$item->product->images[0]->full}}"  style="max-width:75px"></a>
    @else
    <a href="#"><img src="https://DiyToolseg.com/storage/product-placeholder.jpg"  style="max-width:75px"></a>
    @endif
</td>
<td style="border:1px solid #e3e3e3;font-size:12px;text-align:left">{{ $item->product->name }}<br>Qty : {{ $item->quantity }}</td>

<td style="border:1px solid #e3e3e3;color:#3cb54a;font-size:13px">{{number_format((float)$item->price ,2 ,'.', '')  }} EGP 
</td>
@endforeach
</tr>
</tbody>
</table>
<p style="font-size:14px;line-height:26px;text-align:right;border-bottom:1px solid #ccc;padding-bottom:15px;margin-bottom:15px">Cart Sub Total : 

@if($e_order->payment_method =="Cash On Delevery")
<strong>{{number_format((float)$e_order->grand_total  ,2 ,'.', '')}} EGP
@else

<strong>{{$e_order->grand_total }} EGP
@endif
</strong>
@if($e_order->payment_method =="Cash On Delevery")
<br>
Extra fees : <strong>75 EGP</strong>
@endif
<br><span style="font-weight:bold;color:#3cb54a;padding-top:10px;font-size:16px">Total cost : <strong>{{$e_order->grand_total}} EGP</strong></span></p>
<h3 style="font-size:12px">Best Regards,<br>DiyTools Team<br><a href="#" style="color:#3cb54a" target="_blank" rel="noreferrer">www.DiyToolseg.com</a>
</h3>&nbsp;</div>
<div style="text-align:center;margin:25px auto 0;font-size:12px">© 2021 DiyTools All rights Reserved.</div>&nbsp;</div></div></div>
<img width="1px" height="1px" alt="" src="">&nbsp;</div>




