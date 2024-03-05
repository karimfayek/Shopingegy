@extends('admin.app')
@section('title') Dashboard @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon">
                <i class="icon fa fa-users fa-3x"></i>
                <div class="info">
                    <h4>Customers</h4>
                    <p><b>{{ \App\Models\User::count() }}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon">
                <i class="icon fa fa-thumbs-o-up fa-3x"></i>
                <div class="info">
                    <h4>Reviews</h4>
                    <p><b>{{ \App\Models\Review::count() }}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small warning coloured-icon">
                <i class="icon fa fa-shopping-bag fa-3x"></i>
                <div class="info">
                    <h4>Products</h4>
                    <p><b>{{ \App\Models\Product::count() }}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small danger coloured-icon">
                <i class="icon fa fa-shopping-cart fa-3x"></i>
                <div class="info">
                    <h4>Orders</h4>
                    <p><b>{{ \App\Models\Order::count() }}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small danger coloured-icon">
                <i class="icon fa fa-shopping-cart fa-3x"></i>
                <div class="info">
                    <h4>Today Sales</h4>
                    <p><b>{{ \App\Models\Order::whereDate('created_at', \Carbon\Carbon::today())->sum('grand_total') }} L.E</b></p>
                </div>
            </div>
        </div>
       
       
       <div class="col-md-6 col-lg-3">
        <div class="widget-small danger coloured-icon">
            <i class="icon fa fa-shopping-cart fa-3x"></i>
            <div class="info">
                <h4>This Week Sales</h4>
                <p><b>{{ \App\Models\Order::whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()])->sum('grand_total')}}L.E</b></p>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3">
        <div class="widget-small danger coloured-icon">
            <i class="icon fa fa-shopping-cart fa-3x"></i>
            <div class="info">
                <h4>This Month Sales</h4>
                <p><b>{{ \App\Models\Order::whereBetween('created_at', [\Carbon\Carbon::now()->startOfmonth(), \Carbon\Carbon::now()->endOfmonth()])->sum('grand_total')}}L.E</b></p>
            </div>
        </div>
    </div>
	 <div class="col-md-6 col-lg-3">
        <div class="widget-small danger coloured-icon">
            <i class="icon fa fa-shopping-cart fa-3x"></i>
            <div class="info">
                <h4>Total Sales</h4>
                <p><b>{{ \App\Models\Order::sum('grand_total')}}L.E</b></p>
            </div>
        </div>
    </div>
    
<canvas id="salesChart" width="400" height="200"></canvas>
    </div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('salesChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Sales',
                data: @json($salesValues),
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
    
@endpush