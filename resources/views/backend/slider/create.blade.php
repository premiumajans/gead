@extends('master.backend')
@section('title',__('backend.slider'))
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-9">
                    <div class="card">
                        <form action="{{ route('backend.slider.store') }}" class="needs-validation" novalidate method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                @include('backend.templates.components.card-col-12',['variable' => 'slider'])
                                @include('backend.templates.components.multi-lan-tab')
                                <div class="tab-content p-3 text-muted">
                                    @foreach(active_langs() as $lan)
                                        <div class="tab-pane @if($loop->first) active show @endif" id="{{ $lan->code }}"
                                             role="tabpanel">
                                            <div class="form-group row">
                                                <div class="mb-3">
                                                    <label>@lang('backend.title') <span class="text-danger">*</span></label>
                                                    <input name="title[{{ $lan->code }}]" type="text" class="form-control"
                                                           required="" placeholder="@lang('backend.title')">
                                                    {!! validation_response('backend.title') !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                        <div class="mb-3">
                                            <label>@lang('backend.photo') <span class="text-danger">*</span></label>
                                            <input type="file" name="photo" class="form-control" required="" id="validationCustom">
                                           {!! validation_response('backend.photo') !!}
                                        </div>
                                        <div class="mb-3">
                                            <label>@lang('backend.link')</label>
                                            <input type="url" name="link" class="form-control" id="validationCustom" placeholder="https://premium.az">
                                            {!! validation_response('backend.link') !!}
                                        </div>
                                        <div class="mb-3">
                                            <label>@lang('backend.alt') <span class="text-danger">*</span></label>
                                            <input type="text" name="alt" class="form-control" id="validationCustom"  placeholder="@lang('backend.alt')">
                                        </div>
                                </div>
                            </div>
                            @include('backend.templates.components.buttons')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
