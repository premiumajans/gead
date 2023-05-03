<div class="trending-bar-dark hidden-xs">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                {{--                <h3 class="trending-bar-title">DXC</h3>--}}
                <div class="trending-news-slider">

                    <div class="item">
                        <div class="post-content">
                            <a href="">
                                <img src="{{asset('frontend/images/logos/dirnislogo.png')}}" alt="DXC" width="30">
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 top-nav-social-lists text-lg-right col-lg-4 ml-lg-auto">
                <ul class="list-unstyled mt-4 mt-lg-0">
                    <li>
                        <a href="#">
                            <span class="social-icon">
                                <i class="fa fa-language"></i>
                            </span>
                        </a>

                        <a href="#">
                            <span class="social-icon">
                                <i class="fa fa-facebook-f"></i>
                            </span>
                        </a>
                        <a href="#">
                            <span class="social-icon">
                                <i class="fa fa-twitter"></i>
                            </span>
                        </a>
{{--                        <a href="#">--}}
{{--                            <span class="social-icon">--}}
{{--                                <i class="fa fa-google-plus"></i>--}}
{{--                            </span>--}}
{{--                        </a>--}}
{{--                        <a href="#">--}}
{{--                            <span class="social-icon">--}}
{{--                                <i class="fa fa-youtube"></i>--}}
{{--                            </span>--}}
{{--                        </a>--}}
{{--                        <a href="#">--}}
{{--                            <span class="social-icon">--}}
{{--                                <i class="fa fa-linkedin"></i>--}}
{{--                            </span>--}}
{{--                        </a>--}}
                        <a href="#">
                            <span class="social-icon">
                                <i class="fa fa-pinterest-p"></i>
                            </span>
                        </a>
                        <a href="{{ route('frontend.frontLanguage','az')}}">
                                                    <span class="social-icon">
                                                        <img src="{{asset('backend/images/flags/aze.png')}}" height="16"
                                                             width="24">
                                                    </span>
                        </a>
                        <a href="{{ route('frontend.frontLanguage','ru') }}">
                                                    <span class="social-icon">
                                                        <img src="{{asset('backend/images/flags/ru.jpg')}}" height="16"
                                                             width="24">
                                                    </span>
                        </a>
                        <a href="{{ route('frontend.frontLanguage','en') }}">
                                                    <span class="social-icon">
                                                        <img src="{{asset('backend/images/flags/us.jpg')}}" height="16"
                                                             width="24">
                                                    </span>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>
