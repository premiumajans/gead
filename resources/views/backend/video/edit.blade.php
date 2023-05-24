@extends('master.backend')
@section('title',__('backend.video'))
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-9">
                        <div class="card">
                            <form action="{{ route('backend.video.update',$id) }}" class="needs-validation" novalidate
                                  method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    @include('backend.templates.components.card-col-12',['variable' => 'video'])
                                    <div class="mb-3">
                                        <label>@lang('backend.link') <span class="text-danger">*</span></label>
                                        <textarea name="link" class="form-control"
                                                  required>{{ $video->link }}</textarea>
                                        {!! validation_response('backend.link') !!}
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
