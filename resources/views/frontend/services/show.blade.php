@extends('master.frontend')
@section('title',__('backend.services').' | ' )
@section('front')
    <section id="Otel">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="backPage">
                        <a href="{{ route('frontend.services') }}"><i
                                class="fal fa-arrow-left"></i>@lang('backend.go-to-back')</a>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($service->component()->get() as $key => $component)
                    <div class="col-12">
                        <div class="otelCard">
                            <h4>{{ $key+1 .". ". $component->translate(app()->getLocale())->name ?? '-' }}</h4>
                            <img src="{{ asset($component->photo) }}" alt="gefen.az">
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
@endsection
