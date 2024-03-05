@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/js/plugins/dropzone/dist/min/dropzone.min.css') }}"/>
@endsection
=@section('content')
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
                        <form action="{{ route('admin.banners.store') }}" method="POST" role="form" enctype="multipart/form-data">
                            @csrf
                            <h3 class="tile-title">Banner Information</h3>
                            <hr>
                            <div class="tile-body">
                                <div class="form-group">
                                    <label class="control-label" for="name">Title</label>
                                    <input
                                        class="form-control @error('name') is-invalid @enderror"
                                        type="text"
                                        placeholder="Enter Banner name"
                                        id="name"
                                        name="name"
                                        value="{{ old('name') }}"
                                    />
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> @error('name') <span>{{ $message }}</span> @enderror
                                    </div>
                                </div>
								
                                <div class="form-group">
                                    <label class="control-label" for="namear">Title arabic</label>
                                    <input
                                        class="form-control @error('namear') is-invalid @enderror"
                                        type="text"
                                        placeholder="Enter Banner name ar"
                                        id="namear"
                                        name="namear"
                                        value="{{ old('namear') }}"
                                    />
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> @error('namear') <span>{{ $message }}</span> @enderror
                                    </div>
                                </div>
								
                                <div class="form-group">
                                    <label class="control-label" for="url">URL</label>
                                    <input
                                        class="form-control @error('url') is-invalid @enderror"
                                        type="text"
                                        placeholder="Enter URL"
                                        id="url"
                                        name="url"
                                        value="{{ old('url') }}"
                                    />
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> @error('name') <span>{{ $message }}</span> @enderror
                                    </div>
                                </div>
								 <div class="tab-pane" id="images">
									<div class="tile">
										<h3 class="tile-title">Upload Image</h3>
										<hr>
										<div class="tile-body">
											<div class="row">
												<div class="col-md-12">
												   <input class="form-control " type="file" id="image" name="full">
												</div>
											</div>
										</div>
									</div>
								</div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="status"
                                                   name="status"
                                                />Status
                                        </label>
                                    </div>
                                </div>
                            </div>
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
    <script type="text/javascript" src="{{ asset('backend/js/app.js') }}"></script>
    
@endpush

