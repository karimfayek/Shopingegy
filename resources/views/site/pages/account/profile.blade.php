@extends('site.app')
@section('title', 'Orders')
@section('content')
@if ($local == 'ar')
<style>
  .my-account-wrap.clearfix{
    display: flex ;
    flex-wrap: wrap;
  }
  .my-account-navigation{
    -webkit-box-ordinal-group: 2;
    -ms-flex-order: 1;
    order: 1;
  }
  .my-account-content{
    -webkit-box-ordinal-group: 3;
    -ms-flex-order: 2;
    order: 2;
    margin: auto
  }
</style>
  
@endif
@include('site.partials.breadcrumb', ['name' => $heading['profile'] ])
<div id="content" class="site-content" role="main">
  <div class="section-padding">
    @if($errors->count())
    <div class="alert alert-danger p-3">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
      </ul>
    </div>
    @endif
    @if(\Session::has('success'))
    <div class="alert alert-success p-3">
        <p>{{ Session::get('success') }}</p>
     
      </ul>
    </div>
    @endif
   
    <div class="section-container p-l-r">
      <div class="page-my-account rtl textRight">
        <div class="my-account-wrap clearfix">
          <nav class="my-account-navigation">
            <ul class="nav nav-tabs">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#dashboard" role="tab">{{ $heads['dashboard'] }}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#orders" role="tab">{{ $heads['orders'] }}</a>
              </li>
              
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#account-details" role="tab">{{ $heads['accountdetails'] }}</a>
              </li>
              <li class="nav-item">
                
                <a class="nav-link text-danger" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();" href="#">{{ $heads['logout'] }}
               <i>
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                  <title>send-out</title>
                  <path d="M16 26.667h-9.333c-0.736 0-1.333-0.597-1.333-1.333v-18.667c0-0.736 0.597-1.333 1.333-1.333h9.333c0.737 0 1.333-0.596 1.333-1.333s-0.596-1.333-1.333-1.333h-9.333c-2.205 0-4 1.795-4 4v18.667c0 2.205 1.795 4 4 4h9.333c0.737 0 1.333-0.596 1.333-1.333s-0.596-1.333-1.333-1.333zM29.231 15.491c-0.068-0.164-0.167-0.312-0.289-0.436l-5.332-5.332c-0.521-0.521-1.364-0.521-1.885 0s-0.521 1.364 0 1.885l3.057 3.059h-12.781c-0.737 0-1.333 0.596-1.333 1.333s0.596 1.333 1.333 1.333h12.781l-3.057 3.057c-0.521 0.521-0.521 1.364 0 1.885 0.26 0.26 0.601 0.391 0.943 0.391s0.683-0.131 0.943-0.391l5.332-5.332c0.124-0.123 0.221-0.271 0.289-0.435 0.135-0.325 0.135-0.693 0-1.019z"></path>
                  </svg>
               </i>
                </a>
              </li>
            </ul>
          </nav>
          <div class="my-account-content tab-content">
            <div class="tab-pane fade show active" id="dashboard" role="tabpanel">
              <div class="my-account-dashboard">
                <p>
                  Hello <strong>{{ $user->first_name }}</strong> (not <strong>{{ $user->first_name }}</strong>? <a href="#" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">Log out</a>)
                </p>
                <p>
                  From your account dashboard you can view your <a href="#">recent orders</a>, manage your <a href="#">shipping and billing addresses</a>, and <a href="#">edit your password and account details</a>.
                </p>
              </div>
            </div>
            <div class="tab-pane fade" id="orders" role="tabpanel">
              <div class="my-account-orders">
                <div class="table-responsive">
                  <table class="table">
                    @if($user->orders->count())
                      <thead>
                          <tr>
                              <th>{{ $translations['orderno'] }}</th>
                              <th>{{ $translations['date'] }}</th>
                              <th>{{ $translations['status'] }}</th>
                              <th>{{ $translations['total'] }}</th>
                              <th>{{ $translations['actions'] }}</th>
                          </tr>
                      </thead>
                      @endif
                      <tbody>
                        @php
                        $reversedOrders = $user->orders->reverse();
                    @endphp
                            @forelse ($reversedOrders as $order)      
                          <tr>
                              <td>{{ $order->order_number }}</td>
                              <td>{{ $order->created_at->toFormattedDateString() }}</td> 
                              <td>{{ $order->status }}</td>
                              <td>L.E  {{ round($order->grand_total, 2) }} for {{ $order->items->count() }} item</td>
                              <td><a href="/order-details/{{ $order->order_number }}/{{ $local }}" class="btn-small d-block">{{ $heading['view'] }}</a></td>
                          </tr>
                          @empty
                          <tr aria-colspan="5">No Orders</tr>
                          @endforelse
                      </tbody>
                  </table>
              </div>
         </div>
            </div>
            <div class="tab-pane fade" id="addresses" role="tabpanel">
              <div class="my-account-addresses">
                <p>
                  The following addresses will be used on the checkout page by default.
                </p>
                <div class="addresses">
                  <div class="addresses-col">
                    <header class="col-title">
                      <h3>Billing address</h3>
                      <a href="#" class="edit">Edit</a>
                    </header>
                    <address>
                                                    3522 Interstate<br>
                                                    75 Business Spur,<br>
                                                    Sault Ste.<br>
                                                    Marie, MI 49783
                                                </address>
                  </div>
                  <div class="addresses-col">
                    <header class="col-title">
                      <h3>Shipping address</h3>
                      <a href="#" class="edit">Edit</a>
                    </header>
                    <address>
                                                    4299 Express Lane<br>
                                                    Sarasota,<br>
                                                    FL 34249 USA <br>
                                                    Phone: 1.941.227.4444
                                                </address>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="account-details" role="tabpanel">
              <div class="my-account-account-details">
                <form class="edit-account" action="/profile/update" method="post" autocomplete="off">
                  <input autocomplete="false" name="hidden" type="text" style="display:none;">
                  @csrf
                  <p class="form-row">
                    <label for="account_first_name">{{ $heading['firstname'] }}<span class="required">*</span></label>
                    <input type="text" class="input-text" name="first_name" value="{{ $user->first_name }}">
                    @error('first_name') 
                    <div class="invalid-feedback active">
                      <i class="fa fa-exclamation-circle fa-fw"></i><span>{{ $message }}</span>
                  </div>
                  @enderror
                  </p>
                  <p class="form-row">
                    <label>{{ $heading['lastname'] }} <span class="required">*</span></label>
                    <input type="text" class="input-text" name="last_name" value="{{ $user->last_name }}">
                    @error('last_name') 
                    <div class="invalid-feedback active">
                      <i class="fa fa-exclamation-circle fa-fw"></i><span>{{ $message }}</span>
                  </div>
                  @enderror
                  </p>
                  <div class="clear"></div>
                 
                  <div class="clear"></div>
                  <p class="form-row">
                    <label>{{ $heading['email'] }} <span class="required">*</span></label>
                    <input type="email" class="input-text" name="email"  value="{{ $user->email }}">
                    @error('email') 
                    <div class="invalid-feedback active">
                      <i class="fa fa-exclamation-circle fa-fw"></i><span>{{ $message }}</span>
                  </div>
                  @enderror
                  </p>
                  <p class="form-row">
                    <label>{{ $heading['phone'] }} <span class="required">*</span></label>
                    <input type="text" class="input-text" name="phone"  value="{{ $user->phone }}">
                    @error('phone') 
                    <div class="invalid-feedback active">
                      <i class="fa fa-exclamation-circle fa-fw"></i><span>{{ $message }}</span>
                  </div>
                  @enderror
                  </p>
                  <p class="form-row">
                    <label>{{ $heading['address'] }} <span class="required">*</span></label>
                    <input type="text" class="input-text" name="address"  value="{{ $user->address }}">
                    @error('address') 
                    <div class="invalid-feedback active">
                      <i class="fa fa-exclamation-circle fa-fw"></i><span>{{ $message }}</span>
                  </div>
                  @enderror
                  </p>
                  <p class="form-row">
                    <label>{{ $heading['city'] }} <span class="required" >*</span></label>
                    <select name="city" id="city" class="form-control">
                      <option value> Choose...</option>
                          @foreach ($states as $state)
                          <option value="{{ $state->id }}" @if( $user->city == $state->id  ) selected @endif>{{ $state->LocalName }}</option>
                            @endforeach
                    </select>
                    @error('city') 
                    <div class="invalid-feedback active">
                      <i class="fa fa-exclamation-circle fa-fw"></i><span>{{ $message }}</span>
                  </div>
                  @enderror
                  </p>
                  <fieldset>
                    <legend>Password change</legend>
                    <p class="form-row">
                      <label>Current password (leave blank to leave unchanged)</label>
                      <input type="password" class="input-text" name="current_password" autocomplete="off">
                      @error('current_password') 
                      <div class="invalid-feedback active">
                        <i class="fa fa-exclamation-circle fa-fw"></i><span>{{ $message }}</span>
                    </div>
                    @enderror
                    </p>
                    <p class="form-row">
                      <label>New password (leave blank to leave unchanged)</label>
                      <input type="password" class="input-text" name="new_password" autocomplete="off">
                      @error('new_password') 
                      <div class="invalid-feedback active">
                        <i class="fa fa-exclamation-circle fa-fw"></i><span>{{ $message }}</span>
                    </div>
                    @enderror
                    </p>
                    <p class="form-row">
                      <label>Confirm new password</label>
                      <input type="password" class="input-text" name="new_password_confirmation" autocomplete="off">
                      @error('new_password') 
                      <div class="invalid-feedback active">
                        <i class="fa fa-exclamation-circle fa-fw"></i><span>{{ $message }}</span>
                    </div>
                    @enderror
                    </p>
                  </fieldset>
                  <div class="clear"></div>
                  <p class="form-row">
                    <button type="submit" class="button" name="save_account_details" value="Save changes">Save changes</button>
                  </p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div><!-- #content -->

  
  <form id="logout-form" action="/logout" method="POST" style="display: none;">
    @csrf                                    </form>
@stop

@push('scripts')

<style>
  .badge-danger{
    background: red
  }
  .badge-warning{
    background: orange
  }
  .badge-success{
    background: green
  }
  [dir=rtl] .nav-item a svg {
    margin-right: 0;
    margin-left: 0.75rem;
}
.nav-item a svg {
    margin-right: 0.75rem;
    height: 1rem;
    width: 1rem;
    fill: #9ca3af;
}

.nav-item a svg {
    fill: #ff443a!important;
}
.nav-item a svg {
    -webkit-transform: rotate(180deg);
    transform: rotate(180deg);
}
</style>
  <script>
    jQuery( document ).ready(function( $ ) {



      $('.nav-link').on('click', function(e){
        e.preventDefault(); // Prevent default behavior of the link
        var targetTabId = $(this).attr('href'); // Get the target tab id from the href attribute
        $('.tab-pane').removeClass('active show'); // Hide all tab panes
        $(targetTabId).addClass('active show'); // Show the selected tab pane
      });

});
  </script>
@endpush