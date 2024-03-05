@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-shopping-bag"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary pull-right">Add Product</a>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                        <tr>
                            <th> # </th>
                            <th> SKU </th>
                            <th> Name </th>
                            <th class="text-center"> Featured </th>
                            <th class="text-center"> Quantity </th>
                            <th class="text-center"> Price </th>
                            <th class="text-center"> Seller </th>
                            <th class="text-center"> Status </th>
                            <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->sku }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td> @if ($product->featured == 1)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Not Active</span>
                                    @endif</td>
                                    <td>
                                        <input class="form-control" type="number" name="quantity" id= "{{$product['id']}}" value="{{$product->quantity}}">
                                        <a onclick="edit({{$product->id}})"   type="submit" class="edit" style="cursor: pointer;"> edit</a><p id="p{{$product['id']}}"></p>
                                    </td>
                                    <td> <input class="form-control" type="number" name="price" id= "{{$product['id']}}-price" value="{{$product->price}}">  <a onclick="editprice({{$product->id}})"   type="submit" class="edit" style="cursor: pointer;"> edit</a><p id="p{{$product['id']}}-price"></p></td>
                                    <td>@isset($product->seller->full_name)
                                        {{ $product->seller->full_name }} 
                                        @else 
                                        admin
                                    @endisset
                                 </td>
                                    <td class="text-center">
                                        @if ($product->status == 1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Not Active</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Second group">
                                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('admin.products.delete', $product->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
<style>
    .edit{
        cursor: pointer;padding: 0 5px;border-radius: 5px;margin: 5px;background: #28a745;color: #fff !important
    }

</style>

<script>
    
   function edit(product_id) {
		var quantity = $("#"+product_id).val();
		$.ajax({
			url:'/admin/products/quantity/' + product_id,
		data:{"quantity":quantity,'product_id':product_id},
		success:function(results){
			$("#p"+product_id).html(results.message);
			$(".quickview-"+product_id).removeClass("loading");
		}
		});
		
}
function editprice(product_id) {
		var price = $("#"+product_id + '-price').val();
		$.ajax({
			url:'/admin/products/price/' + product_id,
		data:{"price":price,'product_id':product_id},
		success:function(results){
			$("#p"+product_id + '-price').html(results.message);
			$(".quickview-"+product_id).removeClass("loading");
		}
		});
	}
function edit_sale_price(product_id) {
	var price = $("#"+product_id + '-sale_price').val();
	$.ajax({
		url:'/admin/products/sale_price/' + product_id,
	data:{"price":price,'product_id':product_id},
	success:function(results){
		$("#p"+product_id + '-sale_price').html(results.message);
		$(".quickview-"+product_id).removeClass("loading");
	}
	});
}
</script>
@endpush
