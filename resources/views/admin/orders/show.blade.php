@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-bar-chart"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h2 class="page-header"> Info</h2>
                <div class="card-body">
                    <div class="card card-default">
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-3">
                                <div class="label-wrapper">
                                    <label class="col-form-label" for="CustomOrderNumber">Order #</label>                                    
                                </div>
                                </div>
                                <div class="col-md-9">
                                <div class="form-text-row"> {{ $order->order_number }}</div>
                                </div>
                            </div>

                            <div class="form-group row">
                            <div class="col-md-3">
                            <div class="label-wrapper"><label class="col-form-label" for="CreatedOn">Created on</label>
                            </div>
                            </div>
                            <div class="col-md-9">
                            <div class="form-text-row">{{ $order->created_at->toFormattedDateString() }}</div>
                            </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-3">
                                <div class="label-wrapper"><label class="col-form-label" for="CreatedOn">Customer</label>
                                </div>
                                </div>
                                <div class="col-md-9">
                                <div class="form-text-row">{{ $order->user->email }}</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                <div class="label-wrapper"><label class="col-form-label" for="CreatedOn">Payment Method</label>
                                </div>
                                </div>
                                <div class="col-md-9">
                                <div class="form-text-row">{{ $order->payment_method }}</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                <div class="label-wrapper"><label class="col-form-label" for="CreatedOn">Status</label>
                                </div>
                                </div>
                                <div class="col-md-9">
                                <div class="form-text-row"> <span class="badge @if($order->status == 'completed')badge-success @else badge-warning @endif ">{{ $order->status }}</span></div>
                                </div>
                            </div>

                           
                        
                        </div>
                    </div>
                </div>
            </div>

            <div class="tile">
                
                <div class="card-body">
                    <div class="card card-default">
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-3">
                                <div class="label-wrapper">
                                    <label class="col-form-label" for="CustomOrderNumber">Order Sub Total</label>                                    
                                </div>
                                </div>
                                <div class="col-md-9">
                                <div class="form-text-row"> {{ $order->grand_total -  $order->ship_fees - $order->other_fees}} L.E</div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-3">
                                <div class="label-wrapper"><label class="col-form-label" for="CreatedOn">Shipping Fees</label>
                                </div>
                                </div>
                                <div class="col-md-9">
                                <div class="form-text-row">{{$order->ship_fees }} L.E</div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-3">
                                <div class="label-wrapper"><label class="col-form-label" for="CreatedOn">Other Fees</label>
                                </div>
                                </div>
                                <div class="col-md-9">
                                <div class="form-text-row">{{$order->other_fees }} L.E</div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-3">
                                <div class="label-wrapper"><label class="col-form-label" for="CreatedOn">Order Total</label>
                                </div>
                                </div>
                                <div class="col-md-9">
                                <div class="form-text-row">{{ $order->grand_total }} L.E</div>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
            <div class="tile">
                <h2 class="page-header"> Shipping </h2>
                <div class="card-body">
                    <div class="card card-default">
                        <div class="card-body">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                    <th colspan="2">
                                    <strong>Shipping address</strong>
                                    </th>
                                    </tr>
                                </thead>

                                <tbody>
                                <tr>
                                    <td>
                                    Full name
                                    </td>
                                    <td>
                                        {{ $order->user->fullName }}
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                    Email
                                    </td>
                                    <td>
                                        {{ $order->user->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    Phone
                                    </td>
                                    <td>
                                        {{ $order->phone_number }}
                                    </td>
                                </tr>                             
                               
                                <tr>
                                    <td>
                                    Address
                                    </td>
                                    <td>
                                        {{ $order->address }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    City
                                    </td>
                                    <td>
                                        {{ $order->state->name }}
                                    </td>
                                </tr>
                               
                              
                               
                                </tbody></table>

                           
                        
                        </div>
                    </div>
                </div>
            </div>
            <div class="tile">
                <section class="invoice">
                    <h2 class="page-header"> Products </h2>
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product Name</th>
                                    <th>SKU #</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->items as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->product->name }}</td>
                                            <td>{{ $item->product->sku }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ config('settings.currency_symbol') }}{{ round($item->price, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
						@if($order->status != 'completed')
					<a href="{{ route('admin.orders.completed', $order->id) }} " class="btn btn-primary pull-right">Complete</a>
					@endif
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
