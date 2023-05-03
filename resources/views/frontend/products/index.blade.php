@extends('master.frontend')
@section('title',__('backend.products').' | ' )
@section('front')
    <section id="Products">
        <div class="container">
            <div class="row mt-5">
                <div class="col-12">
                    <div class="nav nav-tabs">
                        @foreach($categories as $category)
                            <div class="nav-tabs__item"><a class="nav-tabs__link @if($loop->first) active @endif"
                                                           href="#{{ Str::lower( $category->slug ?? '-') }}">{{ $category->translate(app()->getLocale())->name ?? '-' }}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-content__wrapper">
                    @foreach($categories as $category)
                        <div class="tab-content__item faden @if($loop->first) active @endif" id="{{ Str::lower($category->slug ?? '-') }}">
                            <div class="row mt-5">
                                @foreach($category->product as $product)

                                    <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                                        <div class="productsBox">
                                            <img src="{{ $product->photo }}" alt="{{ $product->alt }}">
                                            <div class="boxText">
                                                <span>{{ $product->translate(app()->getLocale())->name ?? '-' }}</span>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            </div>
                            <hr>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <div class="container">


    </div>
    <div class="choice-menu" style="display: none;">
        <select>
            <option value="faden" selected="selected">fade</option>
        </select>
    </div>
@endsection
