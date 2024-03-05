<h3>You Have an Order </h3>

  @foreach ($e_data as $key=>$value) 
	   @if ( !empty ( $value ) ) 
		   <h4>{{$key}}</h4> <p>{{$value}}</p>
		@endif
	@endforeach
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
<table class="table table-hover shopping-cart-wrap">
                                <thead class="text-muted">
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col" width="120">Quantity</th>
                                    <th scope="col" width="120">Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(\Cart::getContent() as $item)
                                    <tr>
                                        <td>
                                            <figure class="media">
                                                <figcaption class="media-body">
                                                    <h6 class="title text-truncate">{{ Str::words($item->name,20) }}</h6>
                                                    @foreach($item->attributes as $key  => $value)
                                                        <dl class="dlist-inline small">
                                                            <dt>{{ ucwords($key) }}: </dt>
                                                            <dd>{{ ucwords($value) }}</dd>
                                                        </dl>
                                                    @endforeach
                                                </figcaption>
                                            </figure>
                                        </td>
                                        <td>
                                            <var class="price">{{ $item->quantity }}</var>
                                        </td>
                                        <td>
                                            <div class="price-wrap">
                                                <var class="price">{{ config('settings.currency_symbol'). $item->price }}</var>
                                                <small class="text-muted">each</small>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>