@extends('admin.app')
@section('title') Add review @endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/js/plugins/dropzone/dist/min/dropzone.min.css') }}"/>
@endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-shopping-bag"></i>Add review</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row user">
        <div class="col-md-12">
            <div class="tab-content">
                <div class="tab-pane active" id="general">
                    <div class="tile">
                        <form action="{{ route('admin.reviews.adminupdate') }}" method="POST" role="form">
                            @csrf
                            <h3 class="tile-title">review Information</h3>
                            <hr>
                            <div class="tile-body">
							<div class="form-group">
							<select name="product_id"  class="form-control custom-select mt-15 @error('parent_id') is-invalid @enderror">
							@foreach($products as $product)
							<option value="{{$product->id}}">{{$product->name}}</option>
							@endforeach
							</select>
							</div>
                                <div class="form-group">
                                    <label class="control-label" for="name">Name</label>
                                    <input
                                        class="form-control @error('name') is-invalid @enderror"
                                        type="text"
                                        placeholder="Enter attribute name"
                                        id="name"
                                        name="name"
                                        value=""
                                    />
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="email">Email</label>
                                            <input
                                                class="form-control @error('email') is-invalid @enderror"
                                                type="text"
                                                placeholder="Enter review email"
                                                id="email"
                                                name="email"
                                                value=""
                                            />
                                            <div class="invalid-feedback active">
                                                <i class="fa fa-exclamation-circle fa-fw"></i> @error('email') <span>{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="rate">rate</label>
                                            <input
                                                class="form-control @error('rate') is-invalid @enderror"
                                                type="number"
                                                placeholder="Enter review rate"
                                                id="rate"
                                                name="rate"
												min="1"
												max="5"
                                                value=""
                                            />
                                            <div class="invalid-feedback active">
                                                <i class="fa fa-exclamation-circle fa-fw"></i> @error('rate') <span>{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="editor">
                                    <label class="control-label"  for="comment">Comment</label>
                                    <input type="text" name="comment" id="comment" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="tile-footer">
                                <div class="row d-print-none mt-2">
                                    <div class="col-12 text-right">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>add review</button>
                                        <a class="btn btn-danger" href="{{ route('admin.reviews.index') }}"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Go Back</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/bootstrap-notify.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/app.js') }}"></script>

@endpush
