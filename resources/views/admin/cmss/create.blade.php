@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/js/plugins/dropzone/dist/min/dropzone.min.css') }}"/>
@endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-shopping-bag"></i> {{ $pageTitle }} - {{ $subTitle }}</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row user">
        <div class="col-md-12">
            <div class="tab-content">
                <div class="tab-pane active" id="general">
                    <div class="tile">
                        <form action="{{ route('admin.cmss.store') }}" method="POST" role="form" enctype="multipart/form-data">
                            @csrf
                            <h3 class="tile-title">Page Information</h3>
                            <hr>
                            <div class="tile-body">
                                <div class="form-group">
                                    <label class="control-label" for="name">Name</label>
                                    <input
                                        class="form-control @error('name') is-invalid @enderror"
                                        type="text"
                                        placeholder="Enter Page name"
                                        id="name"
                                        name="name"
                                        value="{{ old('name') }}"
                                    />
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> @error('name') <span>{{ $message }}</span> @enderror
                                    </div>
                                </div>
								
                                <div class="form-group">
                                    <label class="control-label" for="name2">Name arabic</label>
                                    <input
                                        class="form-control @error('name2') is-invalid @enderror"
                                        type="text"
                                        placeholder="Enter Banner name ar"
                                        id="name2"
                                        name="name2"
                                        value="{{ old('name2') }}"
                                    />
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> @error('name2') <span>{{ $message }}</span> @enderror
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="control-label" for="icon"> icon</label>
                                    <input
                                        class="form-control @error('icon') is-invalid @enderror"
                                        type="text"
                                        placeholder="Enter icon"
                                        id="icon"
                                        name="icon"
                                        value="{{ old('icon') }}"
                                    />
                                    
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="content">content EN</label>
									<textarea  class="form-control" rows="4" id="content2"  name="content">{{ old('content') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="content2">content AR</label>
									<textarea  class="form-control" rows="4" id="content2" name="content2">{{ old('content2') }}</textarea>
                                </div>
                            </div>
							                <div class="card-body" >   
                                <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="control-label"> Image </label>
                                                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image"/>
                                                @error('image') {{ $message }} @enderror
                                            </div>
                                        </div>
                                    </div>
                                 


                        </div>
<nop-card>
<div class="card card-secondary card-outline collapsed-card" data-card-name="topic-display" data-hideattribute="TopicDetailsPage.HideDisplayBlock" id="topic-display"><div class="card-header with-border clearfix"><div class="card-title"><i class="fa fa-lg mr-2 fa-tv"></i>Display</div><div class="card-tools float-right"></div></div>
	<div class="card-body" >
		<div class="form-group row">
			<div class="col-md-3">
				<div class="label-wrapper">
				<label class="col-form-label" for="Published">Published</label>
				</div>
			</div>
			<div class="col-md-9">
				<input  class="check-box" id="published" name="published" type="checkbox" checked>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-md-3">
				<div class="label-wrapper">
				<label class="col-form-label" for="menu">Include in top menu</label>
				</div>
			</div>
			<div class="col-md-9">
				<input  class="check-box" id="menu" name="menu" type="checkbox" >
			</div>
		</div>
	<div class="form-group row">
			<div class="col-md-3">
				<div class="label-wrapper">
				<label class="col-form-label" for="footer">Include in Footer</label>
				</div>
			</div>
			<div class="col-md-9">
				<input  class="check-box" id="footer" name="footer" type="checkbox" >
			</div>
		</div>
        <div class="form-group row">
            <div class="col-md-3">
                <div class="label-wrapper">
                <label class="col-form-label" for="mission2">Include in Mission</label>
                </div>
            </div>
            <div class="col-md-9">
                <input  class="check-box" id="mission" name="mission" type="checkbox" >
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <div class="label-wrapper">
                <label class="col-form-label" for="vision">Include in vision </label>
                </div>
            </div>
            <div class="col-md-9">
                <input  class="check-box" id="vision" name="vision" type="checkbox" >
            </div>
        </div>
       
		
                 
		
		<div class="form-group row">
                <div class="col-md-3">
                    <div class="label-wrapper">
                    <label class="col-form-label" for="blog">Include in Blogs </label>
                    </div>
                </div>
                <div class="col-md-9">
                    <input  class="check-box" id="blog" name="blog" type="checkbox" >
                </div>
            </div>
       
            <div class="form-group row">
                <div class="col-md-3">
                    <div class="label-wrapper">
                    <label class="col-form-label" for="adv">Include in why </label>
                    </div>
                </div>
                <div class="col-md-9">
                    <input  class="check-box" id="adv" name="adv" type="checkbox" >
                </div>
            </div>
			
			
		
            <div class="form-group row">
                <div class="col-md-3">
                    <div class="label-wrapper">
                    <label class="col-form-label" for="cert">Include in Certificates </label>
                    </div>
                </div>
                <div class="col-md-9">
                    <input  class="check-box" id="cert" name="cert" type="checkbox" >
                </div>
            </div>
		
		<div class="form-group row">
			<div class="col-md-3">
				<div class="label-wrapper">
				<label class="col-form-label" for="order_no">Display order</label>
				</div>
			</div>
			<div class="col-md-9">
				<input  class="check-box" id="order_no" name="order_no" type="number" required>
			</div>
		</div>
	</div>
</div>
</nop-card>
                            <div class="tile-footer">
                                
                            <div class="row d-print-none mt-2">
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-success" type="button" id="uploadButton">
                                        <i class="fa fa-fw fa-lg fa-upload"></i>Create
                                    </button>
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
    <script type="text/javascript" src="{{ asset('backend/js/plugins/bootstrap-notify.min.js') }}"></script>
    
@endpush

