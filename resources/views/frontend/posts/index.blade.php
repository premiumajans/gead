@extends('master.frontend')
@section('title',$post->translate(app()->getLocale())->title.' | ')
@section('meta')
    <meta name="keywords" content="{{$post->translate(app()->getLocale())->keywords}}">
    <meta name="description" content="{{$post->translate(app()->getLocale())->description}}">
@endsection
@section('front')
    <div role="main" class="main" id="mainnn">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-9">
                    <div class="blog-posts single-post">
                        <article class="post post-large blog-single-post border-0 m-0 p-0">
                            <div class="post-image ms-0">
                                <a href="{{ route('frontend.selectedPost',$post->id) }}">
                                    <img src="{{ asset($post->photo) }}"
                                         class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" width="100%"
                                         alt="{{ $post->translate(app()->getLocale())->title }}"/>
                                </a>
                            </div>
                            <div class="post-date ms-0">
                                <span class="day">{{ $post->created_at->format('d') }}</span>
                                <span class="month">{{ __('datetime.'.$post->created_at->format('M')) }}</span>
                                <span class="year">{{ $post->created_at->format('Y') }}</span>
                            </div>
                            <div class="post-content ms-0">
                                <h1 class="font-weight-semi-bold h1-posts">
                                    <a class="wbb-all">
                                        {{ $post->translate(app()->getLocale())->title }}
                                    </a>
                                </h1>
                                <div class="post-meta">
                                    <span class="text-black"><i class="fas fa-user text-color-primary"></i>{{ \App\Models\User::find($post->user_id)->name }}</span>
                                    <span><i class="fas fa-layer-group text-color-primary"></i>
                                        <a href="{{ route('frontend.selectedCategory',\App\Models\Category::find($post->category_id)->slug) }}">{{ \App\Models\Category::find($post->category_id)->translate(app()->getLocale())->name }}</a>
                                    </span>
                                    <span class="text-black"><i class="far fa-eye text-color-primary"></i>{{ $post->view_count }}</span>
                                </div>
                                <div class="content-post" id="contentPost" style="width: 100%">
                                    {!! $post->translate(app()->getLocale())->content !!}
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-md-3">
                    <h3 class="font-weight-bold text-3 pt-1 font-weight-bold text-1 px-3 text-light py-2 bg-primary">@lang('backend.suggestions'):</h3>
                    <div class="pb-2">
                        @foreach($releatedPosts as $key => $rpost)
                            <div class="mb-4 pb-2">
                                <article class="thumb-info thumb-info-no-zoom bg-transparent border-radius-0 pb-2 mb-2">
                                    <div class="row">
                                        <div class="col">
                                            <a href="{{ route('frontend.selectedPost',$rpost->id) }}" class="">
                                                <img src="{{asset($rpost->photo)}}"
                                                     class="img-fluid border-radius-0 img-resize"
                                                     alt="{{ $rpost->translate(app()->getLocale())->title }}">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="thumb-info-caption-text">
                                                <div class="d-inline-block text-default text-1 mt-2 float-none">
                                                    <a class="text-decoration-none text-color-default"> {{ $rpost->created_at->format('d') }} {{ __('datetime.'.$rpost->created_at->format('M')) }}</a>
                                                </div>
                                                <h4 class="d-block line-height-2 text-4 text-dark font-weight-bold mb-0 titles">
                                                    <a href="{{ route('frontend.selectedPost',$rpost->id) }}"
                                                       class="text-decoration-none text-color-dark text-color-hover-primary">
                                                        {{ $rpost->translate(app()->getLocale())->title }}
                                                    </a>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            @if($key == 1)
                                <div class="mb-4 pb-2">
                                    <ins class="adsbygoogle"
                                         style="display:block"
                                         data-ad-client="ca-pub-9095041631453435"
                                         data-ad-slot="9004905283"
                                         data-ad-format="auto"
                                         data-full-width-responsive="true"></ins>
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
@endsection
