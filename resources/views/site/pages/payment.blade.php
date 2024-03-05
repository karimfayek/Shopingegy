@extends('site.app')

<script>
  function responseCallBack(e){ 
  if(e.data.message== "success"){
      console.log("Success payment", e.data )
  }else if(e.data.message == "failure"){
      console.log("Failure payment", e.data )
  }else{
      console.log("Other Actions", e.data )
  }
}
     if (window.addEventListener) {
       console.log("if");
       addEventListener("message", responseCallBack, false)
   } else {
    console.log("else");     
       attachEvent("onmessage", responseCallBack)
   }
</script>

@section('content')
      <hr>
	  @if($cartcount >0)
<section class="section-lg bg-default text-center">

              <p class="text-center">Total : {{$cart_total}}  L.E</p>
     
    <script id="kashier-iFrame"

            src="<?php echo $order['baseUrl'] ?>/kashier-checkout.js"

            data-amount="{{$cart_total}}"

            data-description="some description"

            data-hash="<?php echo $hash ?>"

            data-currency="<?php echo $order['currency'] ?>"

            data-orderId="<?php echo $order['merchantOrderId'] ?>"

            data-merchantId="<?php echo $order['mid'] ?>"

            data-merchantRedirect="<?php echo $callbackUrl ?>"

            data-store = "Qassat"

            data-mode='live'

            data-type = "external"

            data-display="en"  > 
    </script>
</section>
      


@else
<div class="container section-lg">
  <div class="row row-50 text-center">
    <div class="col-md-12 ">
		<div class="alert alert-danger" role="alert">Cart Empty</div>
	</div>
	<div class="col-12 text-center">
	  <div class="group-xs">
		<a href ="{{url('/')}}" class="button button-white" >Back To Home </a>
	  </div>
	</div>
	<div class="col-sm-12">
	  <hr>
	</div>
  </div>
</div>
<style>
.page{background:#fff}
</style>

@endif
      <!-- Page Footer-->
@endsection