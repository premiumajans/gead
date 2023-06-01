@extends('master.backend')
@section('title',__('backend.contact-us'))
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="email mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-12">
                                        <div
                                            class="page-title-box d-sm-flex align-items-center justify-content-between">
                                            <h4 class="mb-sm-0">
                                                #{{ $appeal->id . ' '.__('backend.content').': '.\App\Models\Content::find($appeal->content_id)->translate(app()->getLocale())->name ?? '-'}}</h4>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-4">
                                        <img class="me-3 rounded-circle avatar-sm"
                                             src="{{asset('backend/images/users/mail.png')}}"
                                             alt="Generic placeholder image">
                                        <div class="flex-1">
                                            <h5 class="font-size-16 my-1">{{ $appeal->name . ' ' .$appeal->surname}}</h5>
                                            <small> {{ date('d.m.Y H:i:s',strtotime($appeal->created_at))}}</small>
                                        </div>
                                    </div>
                                    <div>
                                        <h5>@lang('backend.education'): <a>{{ $appeal->education }}</a></h5>
                                        <h5>@lang('backend.work'): <a>{{ $appeal->work }}</a></h5>
                                        <h5>@lang('backend.email'): <a
                                                href="mailto:{{ $appeal->email }}">{{ $appeal->email }}</a></h5>
                                        <h5>@lang('backend.phone'): <a
                                                href="tel:{{ $appeal->phone }}">{{ $appeal->phone }}</a></h5>
                                    </div>
                                    <a href="mailto:{{ $appeal->email }}"
                                       class="btn btn-secondary waves-effect mt-4"><i class="mdi mdi-reply"></i>
                                        @lang('backend.reply')</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
