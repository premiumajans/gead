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
                                            <h4 class="mb-sm-0">@lang('backend.read-mail') : #{{ $order->id }}</h4>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-4">
                                        <img class="me-3 rounded-circle avatar-sm"
                                             src="{{asset('backend/images/users/mail.png')}}"
                                             alt="Generic placeholder image">
                                        <div class="flex-1">
                                            <h5 class="font-size-16 my-1">{{ $order->name.' '.$order->surname}}</h5>
                                            <small> {{ date('d.m.Y H:i:s',strtotime($order->created_at))}}</small>
                                        </div>
                                    </div>
                                    <div>
                                        <h5>@lang('backend.phone'):<a
                                                href="tel:{{ $order->phone }}"></a> {{ $order->phone }}</h5>
                                        <h5>@lang('backend.email'): <a
                                                href="mailto:{{ $order->email }}">{{ $order->email }}</a></h5>
                                    </div>
                                    <p>
                                        {{ $order->order }}
                                    </p>
                                    <a href="mailto:{{ $order->email }}" class="btn btn-secondary waves-effect mt-4"><i
                                            class="mdi mdi-reply"></i>
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
