@extends('admin.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Sellers List to Approve</div>

                    <div class="card-body">

                        @if (session('message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif

                        <table class="table">
                            <tr>
                                <th>Seller name</th>
                                <th>Email</th>
                                <th>Registered at</th>
                                <th></th>
                            </tr>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->full_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td><a href="{{ route('admin.sellers.approve', $user->id) }}"
                                           class="btn btn-primary btn-sm">Approve</a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">All sellers are approved</td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Deactivated</div>

                    <div class="card-body">


                        <table class="table">
                            <tr>
                                <th>Seller name</th>
                                <th>Email</th>
                                <th>Registered at</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @forelse ($deactivateds as $deactivated)
                                <tr>
                                    <td>{{ $deactivated->full_name }}</td>
                                    <td>{{ $deactivated->email }}</td>
                                    <td>{{ $deactivated->created_at }}</td>
                                    <td>
                                        <a href="#s" class="btn btn-primary btn-sm">View</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.sellers.activate', $deactivated->id) }}"class="btn btn-success btn-sm">Activate</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No users found.</td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">All sellers</div>

                    <div class="card-body">


                        <table class="table">
                            <tr>
                                <th>Seller name</th>
                                <th>Email</th>
                                <th>Registered at</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @forelse ($all as $seller)
                                <tr>
                                    <td>{{ $seller->full_name }}</td>
                                    <td>{{ $seller->email }}</td>
                                    <td>{{ $seller->created_at }}</td>
                                    <td>
                                        <a href="#s" class="btn btn-primary btn-sm">View</a>
                                    </td>
                                    <td>
                                        @if ($seller->active)
                                        <a href="{{ route('admin.sellers.deactivate', $seller->id) }}"class="btn btn-danger btn-sm">deactivate</a>
                                        @endif
                                        
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No users found.</td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection