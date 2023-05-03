@extends('master.frontend')
@section('title',__('backend.contact-us').' | ' )
@section('front')
    <section id="Contact">
        <div class="bgTitle">
        </div>
        <div class="container">
            <div class="row formBoxContact">
                <div class="col-lg-6 col-md-12 col-sm-12 myP">
                    <div class="orderForm">
                        <form action="{{ route('frontend.sendMessage') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row RowBox w-100 m-auto">
                                <div class="col-12">
                                    <div class="titleForm">
                                        <h2>@lang('backend.contact-us')</h2>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="nameInput inpBox">
                                        <label for="">
                                            @lang('backend.name')
                                            <input type="text" required name="name" placeholder="@lang('backend.name')">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="surNameInput inpBox">
                                        <label for="">
                                            @lang('backend.surname')
                                            <input type="text" required name="surname"
                                                   placeholder="@lang('backend.surname')">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="surNameInput inpBox">
                                        <label for="">
                                            @lang('backend.email')
                                            <input type="email" required name="email"
                                                   placeholder="@lang('backend.email')">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="numbreInput inpBox">
                                        <label for="">
                                            @lang('backend.subject')
                                            <input type="text" required name="subject"
                                                   placeholder="@lang('backend.subject')">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="textArea inpBox">
                                        <label for="">
                                            @lang('backend.order')
                                            <textarea placeholder=" @lang('backend.order')" name="order" required id=""
                                                      cols="30"
                                                      rows="10"></textarea>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="formBtn">
                                        <button type="submit"> @lang('backend.send')</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 myP">
                    <div class="rightBackSocial">
                        <div class="row RowBox  w-100 m-auto">
                            <div class="col-12">
                                <div class="titleFormRight">
                                    <h2>@lang('backend.contact-information')</h2>
                                </div>
                            </div>
                            <div class="col-12">
                                <a href=""><i class="fal fa-phone-alt"></i> {{ settings('phone') }}</a>
                            </div>
                            <div class="col-12">
                                <a href=""><i class="fal fa-map-marker-alt"></i>{{ settings('address') }}</a>
                            </div>
                            <div class="col-12">
                                <div class="iconBox">
                                    <a href="mailto:{{ settings('email') }}"><i class="fas fa-envelope"></i></a>
                                    <a href="{{ settings('facebook') }}"><i class="fab fa-facebook-f"></i></a>
                                    <a href="{{ settings('instagram') }}"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mapRight mt-3">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3039.289205209104!2d49.86416357594375!3d40.38028247144548!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40307d0355af9707%3A0x4d5d7e4271aaa462!2zw4fEsXJhcSBQbGF6YQ!5e0!3m2!1sru!2saz!4v1681392671385!5m2!1sru!2saz"
                                        width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
