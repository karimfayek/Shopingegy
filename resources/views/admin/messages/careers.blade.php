@extends('admin.app')
@section('title' , 'careers')
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-shopping-bag"></i> careers</h1>
            <p>careers</p>
        </div>
       
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                        <tr>
                            <th> Name </th>
                            <th class="text-center"> Email  </th>
                            <th class="text-center">  Phone </th>
                            <th class="text-center"> Message </th>
                            <th class="text-center">  Age </th>
                            <th class="text-center">  qualification </th>
                            <th class="text-center">  CV </th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($careers as $product)
                            <tr>
                                <td> {{ $product->name }}</td>
                                <td> {{ $product->email }}</td>
                                <td> {{ $product->phone }}</td>
                                <td> {{ $product->message }}</td>
                                <td> {{ $product->age }}</td>
                                <td> {{ $product->qualification }}</td>
                                <td> <a href="/storage/{{ $product->cv }}">Download</a> </td>
                               
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
<style>
i.false-icon {
    color: #d22d2d;
    font-size: 20px;
}
i.true-icon {
    color: #007fcc;
    font-size: 20px;
}
</style>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>

@endpush
