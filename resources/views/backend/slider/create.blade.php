@extends('master.backend')
@section('title',__('backend.slider'))
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">@lang('backend.slider'): @lang('backend.add-new')</h4>
                                </div>
                            </div>
                            <form action="{{ route('backend.slider.store') }}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label>@lang('backend.photo') <span class="text-danger">*</span></label>
                                    <input type="file" name="photo" class="form-control" required="" id="validationCustom">
                                    <div class="valid-feedback">
                                        @lang('backend.photo') @lang('messages.is-correct')
                                    </div>
                                    <div class="invalid-feedback">
                                        @lang('backend.photo') @lang('messages.not-correct')
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label>@lang('backend.alt') <span class="text-danger">*</span></label>
                                    <input type="text" name="alt" class="form-control" required="" id="validationCustom"  placeholder="@lang('backend.alt')">
                                    <div class="valid-feedback">
                                        @lang('backend.alt') @lang('messages.is-correct')
                                    </div>
                                    <div class="invalid-feedback">
                                        @lang('backend.alt') @lang('messages.not-correct')
                                    </div>
                                </div>
                                <div class="mb-0 text-center">
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                            @lang('backend.submit')
                                        </button>
                                        <a href="{{url()->previous()}}" type="button" class="btn btn-secondary waves-effect">
                                            @lang('backend.cancel')
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
