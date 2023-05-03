@extends('master.backend')
@section('title',__('backend.about'))
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
                                        <h4 class="mb-sm-0">@lang('backend.about')</h4>
                                    </div>
                                </div>
                                <form action="{{ route('backend.about.update',$about->id) }}" method="POST"
                                      class="needs-validation" novalidate="" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <ul class="nav nav-pills nav-justified" role="tablist">
                                        @foreach(active_langs() as $lan)
                                            <li class="nav-item waves-effect waves-light">
                                                <a class="nav-link @if($loop->first) active @endif" data-bs-toggle="tab"
                                                   href="#{{ $lan->code }}" role="tab" aria-selected="true">
                                                    <span class="d-block d-sm-none"><i
                                                            class="fas fa-flag">&nbsp; {{ $lan->code }}</i></span>
                                                    <span class="d-none d-sm-block">{{ $lan->name }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content p-3 text-muted">
                                        @foreach(active_langs() as $lan)
                                            <div class="tab-pane @if($loop->first) active show @endif"
                                                 id="{{ $lan->code }}" role="tabpanel">
                                                <div class="form-group row">
                                                    <div class="mb-3">
                                                        <label>@lang('backend.description') <span
                                                                class="text-danger">*</span></label>
                                                        <textarea type="text" name="description[{{$lan->code}}]"
                                                                  class="form-control" required="" rows="7"
                                                                  placeholder="">{{ $about->translate($lan->code)->description }}</textarea>
                                                        <div class="valid-feedback">
                                                            @lang('backend.description') @lang('messages.is-correct')
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            @lang('backend.description') @lang('messages.not-correct')
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="mb-0 text-center">
                                        <div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                                @lang('backend.submit')
                                            </button>
                                            <a href="{{url()->previous()}}" type="button"
                                               class="btn btn-secondary waves-effect">
                                                @lang('backend.cancel')
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                        <h4 class="mb-sm-0">@lang('backend.why-gefen')?</h4>
                                    </div>
                                </div>
                                <form action="{{ route('backend.why-gefen',$why->id) }}" method="POST"
                                      class="needs-validation" novalidate="" enctype="multipart/form-data">
                                    @csrf
                                    <ul class="nav nav-pills nav-justified" role="tablist">
                                        @foreach(active_langs() as $lan)
                                            <li class="nav-item waves-effect waves-light">
                                                <a class="nav-link @if($loop->first) active @endif" data-bs-toggle="tab"
                                                   href="#{{ $lan->code }}1" role="tab" aria-selected="true">
                                                    <span class="d-block d-sm-none"><i
                                                            class="fas fa-flag">&nbsp; {{ $lan->code }}</i></span>
                                                    <span class="d-none d-sm-block">{{ $lan->name }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content p-3 text-muted">
                                        @foreach(active_langs() as $lan)
                                            <div class="tab-pane @if($loop->first) active show @endif"
                                                 id="{{ $lan->code }}1" role="tabpanel">
                                                <div class="form-group row">
                                                    <div class="mb-3">
                                                        <label>@lang('backend.description') <span
                                                                class="text-danger">*</span></label>
                                                        <textarea type="text" name="description[{{$lan->code}}]"
                                                                  class="form-control" required="" rows="7"
                                                                  placeholder="">{{ $why->translate($lan->code)->description }}</textarea>
                                                        <div class="valid-feedback">
                                                            @lang('backend.description') @lang('messages.is-correct')
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            @lang('backend.description') @lang('messages.not-correct')
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="mb-3">
                                            <label>@lang('backend.photo') 1<span class="text-danger">*</span></label>
                                            <input type="file" name="photo1" class="form-control mb-2">
                                            @if(file_exists($why->photo_1))
                                                <img src="{{ asset($why->photo_1) }}" class="form-control" style="width: 100%">
                                            @endif
                                            <div class="valid-feedback">
                                                @lang('backend.photo') 1@lang('messages.is-correct')
                                            </div>
                                            <div class="invalid-feedback">
                                                @lang('backend.photo') 1@lang('messages.not-correct')
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label>@lang('backend.photo') 2<span class="text-danger">*</span></label>
                                            <input type="file" name="photo2" class="form-control mb-2">
                                            @if(file_exists($why->photo_2))
                                                <img src="{{ asset($why->photo_2) }}" class="form-control" style="width: 100%">
                                            @endif
                                            <div class="valid-feedback">
                                                @lang('backend.photo') 2@lang('messages.is-correct')
                                            </div>
                                            <div class="invalid-feedback">
                                                @lang('backend.photo') 2@lang('messages.not-correct')
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label>@lang('backend.photo') 3<span class="text-danger">*</span></label>
                                            <input type="file" name="photo3" class="form-control mb-2">
                                            @if(file_exists($why->photo_3))
                                                <img src="{{ asset($why->photo_3) }}" class="form-control" style="width: 100%">
                                            @endif
                                            <div class="valid-feedback">
                                                @lang('backend.photo') 3@lang('messages.is-correct')
                                            </div>
                                            <div class="invalid-feedback">
                                                @lang('backend.photo') 3@lang('messages.not-correct')
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-0 text-center">
                                        <div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                                @lang('backend.submit')
                                            </button>
                                            <a href="{{url()->previous()}}" type="button"
                                               class="btn btn-secondary waves-effect">
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
