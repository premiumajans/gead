@extends('master.frontend')
@section('title',__('backend.create-order').' | ' )
@section('front')
    <section id="Order">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="title">
                        <h1 style="color: #8F5D13;">@lang('backend.create-order')</h1>
                    </div>
                </div>
            </div>
            <div class="row formBox">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="orderForm">
                        <form action="{{ route('frontend.newOrder') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <div class="nameInput inpBox">
                                        <label for="">
                                            @lang('backend.name')
                                            <input type="text" name="name" required placeholder="@lang('backend.name')">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="surNameInput inpBox">
                                        <label for="">
                                            @lang('backend.surname')
                                            <input type="text" required name="surname"
                                                   placeholder="@lang('backend.surname')">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="surNameInput inpBox">
                                        <label for="">
                                            @lang('backend.email')
                                            <div class="requeried" style="position: absolute;left: 35px;top: 2px;"><i
                                                    class="fas fa-star-of-life"></i></div>
                                            <input type="email" required name="email"
                                                   placeholder="@lang('backend.email')">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-6 col-sm-12">
                                    <div class="numbreInput inpBox">
                                        <label for="">
                                            @lang('backend.phone')
                                            <div class="requeried"><i class="fas fa-star-of-life"></i></div>
                                            <input type="number" required name="phone" placeholder="+994 -- --- -- --">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-6 col-sm-12">
                                    <div class="AdresInput inpBox">
                                        <label for="">
                                            @lang('backend.address')
                                            <input type="text" required name="address"
                                                   placeholder="@lang('backend.address')">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="textArea inpBox">
                                        <label for="">
                                            @lang('backend.order')
                                            <div class="requeried"></div>
                                            <textarea required placeholder="Sifarişiniz" name="order" id="" cols="30"
                                                      rows="10"></textarea>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="formBtn">
                                        <button> @lang('backend.send')</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="bgImgOrder"></div>
                </div>
            </div>
        </div>
    </section>
@endsection
