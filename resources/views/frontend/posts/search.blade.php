@extends('master.frontend')
@section('title',$searchIndex.' | ')
@section('front')
<div role="main" class="main">
    <div class="container py-4">
        <div class="row">
            <div class="col">
                <div class="blog-posts">
                    <div class="heading heading-border heading-middle-border">
                        <h3 class="text-4">
                            <strong class="font-weight-bold text-1 px-3 text-light py-2 bg-primary">
                                @lang('backend.search-result') : "{{ $searchIndex }}"
                            </strong>
                        </h3>
                    </div>
                    <div class="row">
                        @foreach($searchResult as $post)
                        <div class="col-md-4 col-lg-3" style="height: 370px; !important;">
                            <article class="post post-medium border-0 pb-0 mb-5">
                                <div class="post-image" style="background-image: url({{ asset($post->photo) }})">
                                    <a href="{{ route('frontend.selectedPost',$post->id) }}">
                                        <img src="{{ asset($post->photo) }}" class="img-resize" alt="{{ $post->translate(app()->getLocale())->title }}">
                                    </a>
                                </div>
                                <div class="post-content">
                                    <h2 class="font-weight-semibold text-5 line-height-6 mt-3 mb-2 titles ">
                                        <a href="{{ route('frontend.selectedPost',$post->id) }}" title="{{ $post->translate(app()->getLocale())->title }}">
                                            {{ $post->translate(app()->getLocale())->title }}
                                        </a>
                                    </h2>
                                    <div class="post-meta text-center">
                                        <span>
                                            <i class="fas fa-layer-group"></i>
                                            <a href="#">{{ \App\Models\Category::find($post->category_id)->translate(app()->getLocale())->name }}</a>
                                        </span>
                                        <span>
                                            <i class="far fa-eye"></i>
                                            {{ $post->view_count }}
                                        </span>
                                        <span>
                                            <i class="far fa-clock"></i>
                                            {{ $post->created_at->format('d') }} {{ __('datetime.'.$post->created_at->format('M')) }}
                                        </span>
                                        <span class="d-block mt-2">
                                            <a href="{{route('frontend.selectedPost',$post->id)}}" class="text-lowercase read-more text-color-dark font-weight-bold text-2">@lang('backend.read-more') <i class="fas fa-chevron-right text-1 ms-1"></i></a>
                                        </span>
                                    </div>
                                </div>
                            </article>
                        </div>
                        @endforeach
                        @if(count($searchResult) == 0)
                        <div class="row justify-content-center align-items-center">
                            <div class="col-lg-6">
                                <div class="error-block ">
                                    <div class="error-info">
                                        <h2 class="mb-2">@lang('messages.info-not-found')!</h2>
                                        <a href="{{ route('login') }}">@lang('backend.back-to-home')<i class="fa fa-angle-double-right ml-2"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="broken-img mt-5 mt-lg-0 d-flex justify-content-center align-items-center">
                                    <img src="{{asset('frontend/images/broken.png')}}" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
