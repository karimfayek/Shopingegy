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
                        <form action="{{ route('admin.translation.update') }}" method="POST" role="form" enctype="multipart/form-data">
                            @csrf
							
							<input type="hidden" name="product_id" value="{{ $product->id }}">
                            <h3 class="tile-title">Information</h3>
                            <hr>
                            <div class="tile-body">
                                <div class="form-group">
                                    <label class="control-label" for="header">header</label>
                                    <input
                                        class="form-control @error('header') is-invalid @enderror"
                                        type="text"
                                        placeholder="Enter header"
                                        id="header"
                                        name="header"
                                        value="{{ old('header', $product->header) }}"
										disabled="disabled"
                                    />
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> @error('header') <span>{{ $message }}</span> @enderror
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="control-label" for="ar">ar</label>
                                    <input
                                        class="form-control @error('name2') is-invalid @enderror"
                                        type="text"
                                        placeholder="Enter name ar"
                                        id="ar"
                                        name="ar"
                                        value="{{ old('ar', $product->ar) }}"
                                    />
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> @error('ar') <span>{{ $message }}</span> @enderror
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="control-label" for="en">EN</label>
                                    <input
                                        class="form-control @error('en') is-invalid @enderror"
                                        type="text"
                                        placeholder="Enter  en"
                                        id="en"
                                        name="en"
                                        value="{{ old('en', $product->en) }}"
                                    />
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> @error('en') <span>{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                
                            </div>
                            
							

                            <div class="tile-footer">
                                <div class="row d-print-none mt-2">
                                    <div class="col-12 text-right">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update </button>
                                        <a class="btn btn-danger" href="{{ route('admin.translation.index') }}"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Go Back</a>
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

@endpush
