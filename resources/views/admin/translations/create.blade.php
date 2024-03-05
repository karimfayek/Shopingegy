@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection

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
                        <form action="{{ route('admin.translation.store') }}" method="POST" role="form" enctype="multipart/form-data">
                            @csrf
                            <h3 class="tile-title">Page Information</h3>
                            <hr>
                            <div class="tile-body">
                                <div class="form-group">
                                    <label class="control-label" for="name">header</label>
                                    <input
                                        class="form-control @error('header') is-invalid @enderror"
                                        type="text"
                                        placeholder="Enter header"
                                        id="header"
                                        name="header"
                                        value="{{ old('header') }}"
                                    />
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> @error('header') <span>{{ $message }}</span> @enderror
                                    </div>
                                </div>
								
                                <div class="form-group">
                                    <label class="control-label" for="ar">arabic</label>
                                    <input
                                        class="form-control @error('ar') is-invalid @enderror"
                                        type="text"
                                        placeholder="Enter Banner name ar"
                                        id="ar"
                                        name="ar"
                                        value="{{ old('ar') }}"
                                    />
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> @error('ar') <span>{{ $message }}</span> @enderror
                                    </div>
                                </div>
								
								<div class="form-group">
                                    <label class="control-label" for="en">English</label>
                                    <input
                                        class="form-control @error('en') is-invalid @enderror"
                                        type="text"
                                        placeholder="Enter  en"
                                        id="en"
                                        name="en"
                                        value="{{ old('en') }}"
                                    />
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> @error('en') <span>{{ $message }}</span> @enderror
                                    </div>
                                </div>
								
                            </div>
                            <div class="tile-footer">
                                
                            <div class="row d-print-none mt-2">
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-success" type="button" >
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

