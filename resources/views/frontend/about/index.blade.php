@extends('master.frontend')
@section('title',__('backend.about').' | ' )
@section('front')

    <section id="About">
        <div class="AboutBox" >
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 col-12 p-0">
                    <div class="leftAbout">
                        <img src="{{asset('frontend/img/gefen.png')}}" alt="Gefen">
                        <div class="bodyLeft">
                            <p style="color: black !important;">{{ $about->translate(app()->getLocale())->description ?? '-' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6  col-md-12 col-sm-12 col-12  p-0">
                    <div class="backImgAbout"></div>
                </div>
            </div>
        </div>
    </section>

    <section id="Why">
        <div class="container">
            <div class="row mt-5 mb-4">
                <div class="col-12">
                    <div class="whyTitle">
                        <h1>@lang('backend.why-gefen')?</h1>
                        <p>{{ $why->translate(app()->getLocale())->description ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="row m-0" style="overflow: hidden; width: 100%;">
                <div class="col-lg-4 p-0">
                    <div class="whyImg">
                        <img src="{{ asset($why->photo_1) }}" alt="Gefen">
                    </div>
                </div>
                <div class="col-lg-4 p-0">
                    <div class="whyImg">
                        <img src="{{ asset($why->photo_2) }}" alt="Gefen">
                    </div>
                </div>
                <div class="col-lg-4 p-0">
                    <div class="whyImg">
                        <img src="{{ asset($why->photo_3) }}" alt="Gefen">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
