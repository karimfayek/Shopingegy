@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-briefcase"></i> {{ $pageTitle }}</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">{{ $subTitle }}</h3>
                <form action="{{ route('admin.states.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Name  <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name') }}"/>
                            
                            @error('name') {{ $message }} @enderror
                        </div>
						
						<div class="form-group">
						<label class="control-label" for="country_id">Country <span class="m-l-5 text-danger"> *</span></label>
						<select name="country_id" class="form-control" required>
						<option value="" disable >Select Country</option>
						@foreach($countries as $cntry)
						<option value="{{$cntry->id}}">{{$cntry->name}}</option>
						@endforeach
						</select>
						</div>
						<div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="ship"
                                                   name="ship"
                                                   
                                                />Ship ? 
                                        </label>
                                    </div>
						</div>
						<div class="form-group">
                            <label class="control-label" for="ship_price">shipping Price <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('ship_price') is-invalid @enderror" type="text" name="ship_price" id="ship_price" value="{{ old('ship_price') }}"/>
                           
                            @error('ship_price') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save </button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.states.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
