@extends('site.app')
@section('title', $heading['orderdetails'] )
@push('styles')
  <style>
    .form-select {
    display: block;
    padding: 0.6rem 2.25rem 0.6rem 0.75rem;
    -moz-padding-start: calc(.75rem - 3px);
    font-size: .9rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    background-color: #fff;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 16px 12px;
    border: 1px solid #ced4da;
    border-radius: 0;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}

select {
    word-wrap: normal;
}
button, select {
    text-transform: none;
}
button, input, optgroup, select, textarea {
    margin: 0;
    font-family: inherit;
    font-size: inherit;
    line-height: inherit;
}
  </style>
@endpush
@section('content')

@include('site.partials.breadcrumb', ['name' =>  $heading['orderdetails']  , 'account' => 'yes'] )

<section class="section section-sm bg-transparent novi-background">
    <div class="container-fluid">

        <div class="container">
          <!-- Title -->
          <div class="d-flex justify-content-between align-items-center py-3">
            <h2 class="h5 mb-0"><a href="#" class="text-muted"></a> {{ $translations['orderno'] }} {{ $order->order_number }}</h2>
          </div>
        
          <!-- Main content -->
          <div class="row">
            <div class="col-lg-8">
              <!-- Details -->
              <div class="card mb-4">
                <div class="card-body">
                  <div class="mb-3 d-flex justify-content-between">
                    <div>
                      <span class="me-3">   {{ $order->created_at->toFormattedDateString() }}</span>
                      <span class="me-3">{{ $order->order_number }}</span>
                      <span class="me-3">{{ $order->payment_method }}</span>
                      <span class="badge rounded-pill bg-info">{{ $order->status }}</span>
                    </div>
                    
                  </div>
                  <table class="table table-borderless">
                    <tbody>
                        @foreach($order->items as $item)
                      <tr>
                        <td>
                          <div class="d-flex mb-2">
                            <div class="flex-shrink-0">
                              <img src="/storage/products/thumbnail/{{ $item->product->FirstImage }}" alt="" width="35" class="img-fluid">
                            </div>
                            <div class="flex-lg-grow-1 ms-3">
                              <h6 class="small mb-0"><a href="#" class="text-reset">{{ $item->product->LocalName }}</a></h6>
                            </div>
                           
                          </div>
                        </td>
                        <td>{{ $item->quantity }}</td>
                        <td class="text-end">L.E {{ $item->price }}</td>
                        <td class="text-end">
                          <a href="/review/add/{{ $item->product->id }}/{{ $local }}" class="btn btn-dark">{{$translations['review']}}</a></td>
                      </tr>
                      @endforeach
                   
                    </tbody>
                    <tfoot>
                     
                     
                     
                      <tr class="fw-bold">
                        <td colspan="2">{{ $translations['total'] }}</td>
                        <td class="text-end">L.E {{ round($order->grand_total, 2) }}</td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
              <!-- Payment -->
              <div class="card mb-4">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-6">
                      <h3 class="h6">Payment Method</h3>
                      <p>{{  $order->payment_method }} <br>
                        {{ $translations['total'] }}: L.E {{ round($order->grand_total, 2) }}</p>
                    </div>
                    <div class="col-lg-6">
                      <h3 class="h6">Billing address</h3>
                      <address>
                        <strong>{{ $order->first_name }} {{  $order->last_name }}</strong><br>
                        {{$order->address}}
                     
                      </address>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <!-- Customer Notes -->
              <div class="card mb-4">
                <div class="card-body">
                  <h3 class="h6">Customer Notes</h3>
                  @isset($order->notes )
                  <p>{{  $order->notes }}</p>
                  @else
                  .. 
                  @endisset
                 
                </div>
              </div>
              <div class="card mb-4">
                <!-- Shipping information -->
                <div class="card-body">
                 
                  <h3 class="h6"> {{ $translations['address'] }}</h3>
                  <address>
                    <strong>{{ $order->first_name }} {{  $order->last_name }}</strong><br>
                    {{$order->address}}
                 
                  </address>
                </div>
              </div>
              
              
        </div>

    
          </div>
        </div>
          </div>
    </section>

@stop