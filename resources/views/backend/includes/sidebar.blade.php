<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
{{--                {{ creation('Gallery','Gallery',true,true) }}--}}
                <li>
                    <a href="{{ route('backend.dashboard') }}" class="waves-effect">
                        <i class="ri-home-4-fill"></i>
                        <span>@lang('backend.dashboard')</span>
                    </a>
                </li>
                <li class="menu-title">@lang('backend.site-setting')</li>
                @can('content index')
                    <li>
                        <a href="{{ route('backend.content.index') }}" class="waves-effect">
                            <i class="fas fa-file"></i>
                            <span>@lang('backend.content')</span>
                        </a>
                    </li>
                @endcan
                @can('slider index')
                    <li>
                        <a href="{{ route('backend.slider.index') }}" class="waves-effect">
                            <i class="fas fa-images"></i>
                            <span>@lang('backend.slider')</span>
                        </a>
                    </li>
                @endcan
                @can('gallery index')
                    <li>
                        <a href="{{ route('backend.gallery.index') }}" class="waves-effect">
                            <i class="fas fa-images"></i>
                            <span>@lang('backend.gallery')</span>
                        </a>
                    </li>
                @endcan
                <li>
                    <a href="{{ route('backend.products.index') }}" class="waves-effect">
                        <i class="fas fa-wine-glass-alt"></i>
                        <span>@lang('backend.products')</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('backend.services.index') }}" class="waves-effect">
                        <i class="fas fa-wine-glass-alt"></i>
                        <span>@lang('backend.services')</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('backend.about.index') }}" class="waves-effect">
                        <i class="fas fa-info"></i>
                        <span>@lang('backend.about')</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('backend.categories.index') }}" class="waves-effect">
                        <i class="fas fa-bars"></i>
                        <span>@lang('backend.categories')</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('backend.site-languages.index') }}" class="waves-effect">
                        <i class="fas fa-language"></i>
                        <span>@lang('backend.languages')</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('backend.orders') }}" class="waves-effect">
                        <i class="ri-contacts-fill"></i>
                        <span>@lang('backend.create-order')</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('backend.contact-us.index') }}" class="waves-effect">
                        <i class="ri-contacts-fill"></i>
                        <span>@lang('backend.contact-us')</span>
                    </a>
                </li>
                {{--                {{ creation('Etibar',false) }}--}}
                @can('news index')
                    <li>
                        <a href="{{ route('backend.news.index') }}" class="waves-effect">
                            <i class="fas fa-newspaper"></i>
                            <span>@lang('backend.news')</span>
                        </a>
                    </li>
                @endcan
                @can('UseFulLink index')
                    <li>
                        <a href="{{ route('backend.useful-links.index') }}" class="waves-effect">
                            <i class="fas fa-link"></i>
                            <span>@lang('backend.useful-links')</span>
                        </a>
                    </li>
                @endcan
                @can('settings index')
                    <li>
                        <a href="{{ route('backend.settings.index') }}" class="waves-effect">
                            <i class="ri-settings-2-fill"></i>
                            <span>@lang('backend.settings')</span>
                        </a>
                    </li>
                @endcan
                {{--                <li class="menu-title">@lang('backend.seo-settings')</li>--}}
                {{--                <li>--}}
                {{--                    <a href="{{ route('backend.seo.index') }}" class="waves-effect">--}}
                {{--                        <i class="fas fa-tags"></i>--}}
                {{--                        <span>@lang('backend.tags')</span>--}}
                {{--                    </a>--}}
                {{--                </li>--}}
                <li class="menu-title">@lang('backend.ap-setting')</li>
                @can('users index')
                    <li>
                        <a href="{{ route('backend.users.index') }}" class=" waves-effect">
                            <i class="ri-account-circle-fill"></i>
                            <span>@lang('backend.users')</span>
                        </a>
                    </li>
                @endcan
                @can('permissions index')
                    <li>
                        <a href="{{ route('backend.permissions.index') }}" class=" waves-effect">
                            <i class="ri-lock-2-fill"></i>
                            <span>@lang('backend.permissions')</span>
                        </a>
                    </li>
                @endcan
                @can('report index')
                    <li>
                        <a href="{{ route('backend.report') }}" class="waves-effect">
                            <i class="fas fa-file"></i>
                            <span>@lang('backend.report')</span>
                        </a>
                    </li>
                @endcan
                @can('dodenv index')
                    <li>
                        <a target="_blank" href="{{ url('admin/env') }}" class="waves-effect">
                            <i class="fab fa-envira"></i>
                            <span>@lang('backend.dod-env')</span>
                        </a>
                    </li>
                @endcan
                @can('languages index')
                    <li>
                        <a target="_blank" href="{{ url('admin/manage-languages') }}" class="waves-effect">
                            <i class="fas fa-flag"></i>
                            <span>@lang('backend.language-panel')</span>
                        </a>
                    </li>
                @endcan
                <li class="menu-title">@lang('backend.user-setting')</li>
                <li>
                    <a href="{{ route('backend.my-informations.index') }}" class=" waves-effect">
                        <i class="ri-information-fill"></i>
                        <span>@lang('backend.informations')</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
