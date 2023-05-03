<footer>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="logoFooter">
                    <img src="{{asset('frontend/img/Logo-2 gefen 1.svg')}}" alt="">
                </div>
            </div>
            <div class="col-lg-8 col-md-6 col-sm-12">
                <div class="footerBigBox">
                    <div class="footerBox">
                        <div class="top">
                            <div class="leftContact">
                                <span>@lang('backend.phone')</span>
                                <a href="">{{ settings('phone') }}</a>
                            </div>
                            <div class="rightContact">
                                <span>@lang('backend.address')</span>
                                <a href="">{{ settings('address_'.app()->getLocale()) }}</a>
                            </div>
                        </div>
                        <hr>
                        <div class="bottom">
                            <div class="iconBox">
                                <a href="mailto:{{ settings('email') }}"><i class="fas fa-envelope"></i></a>
                                <a href="{{ settings('facebook') }}"><i class="fab fa-facebook-f"></i></a>
                                <a href="{{ settings('instagram') }}"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <span>© @lang('backend.copyright') {{ date('Y') }} @lang('backend.gefen-company')</span>
    </div>
</footer>
