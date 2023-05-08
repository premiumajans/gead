@extends('master.backend')
@section('title',__('backend.content'))
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-12">
                        <div class="card">
                            <form action="{{ route('backend.content.store') }}" class="needs-validation" novalidate
                                  method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    @include('backend.templates.components.card-col-12',['variable' => 'content'])
                                    @include('backend.templates.components.multi-lan-tab')
                                    <div class="tab-content p-3 text-muted">
                                        @foreach(active_langs() as $lan)
                                            <div class="tab-pane @if($loop->first) active show @endif"
                                                 id="{{ $lan->code }}"
                                                 role="tabpanel">
                                                <div class="form-group row">
                                                    <div class="mb-3">
                                                        <label>@lang('backend.name') <span class="text-danger">*</span></label>
                                                        <input name="name[{{ $lan->code }}]" type="text"
                                                               class="form-control"
                                                               required="" placeholder="@lang('backend.name')">
                                                        {!! validation_response('backend.name') !!}
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>@lang('backend.content') <span
                                                                class="text-danger">*</span></label>
                                                        <textarea name="content[{{ $lan->code }}]"
                                                                  id="elm{{$lan->code}}1"
                                                                  class="form-control"
                                                                  required=""
                                                                  placeholder="@lang('backend.content')"></textarea>
                                                        {!! validation_response('backend.content') !!}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="mb-3">
                                            <label>@lang('backend.category')</label>
                                            <select class="form-control" name="category" id="category">
                                                @foreach($categories as $category)
                                                    <option
                                                        value="{{ $category->id }}">{{ $category->translate(app()->getLocale())->name ?? '-' }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3" id="altCategoryDiv">
                                            <label>@lang('backend.alt-categories')</label>
                                            <select class="form-control" name="altCategory" id="altCategory">
                                                @foreach($altCategories as $alt)
                                                    <option
                                                        value="{{ $alt->id }}">{{ $alt->translate(app()->getLocale())->name ?? '-' }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if(!empty($subCategories))
                                            <div class="mb-3" id="subCategoryDiv">
                                                <label>@lang('backend.sub-categories')</label>
                                                <select class="form-control" name="subCategory" id="subCategory">
                                                    @foreach($subCategories as $sub)
                                                        <option
                                                            value="{{ $sub->id }}">{{ $sub->translate(app()->getLocale())->name ?? '-' }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif
                                        <div class="mb-3">
                                            <label>@lang('backend.photo')</label>
                                            <input name="photo" type="file" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label>@lang('backend.photos')</label>
                                            <input type="file" class="form-control mb-2" id="photos" name="photos[]"
                                                   multiple>
                                            <div id="image-preview-container" class="d-flex flex-wrap"></div>
                                        </div>
                                @include('backend.templates.components.buttons')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @include('backend.templates.components.tiny')
    @include('backend.templates.components.preview-images')
    <script>
        $(document).ready(function () {
            $('#category').on('change', function () {
                var catID = $('#category').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                $.ajax({
                    url: "{{ route('backend.changeCategory') }}",
                    type: "POST",
                    data: {
                        category_id: catID,
                    },
                    success: function (data) {
                        $("#altCategory").remove();
                        $("#altCategoryDiv").append(data);
                    },
                });
            });
            $('#altCategory').on('change', function () {
                var altID = $('#altCategory').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                $.ajax({
                    url: "{{ route('backend.changeAltCategory') }}",
                    type: "POST",
                    data: {
                        alt_id: altID,
                    },
                    success: function (data) {
                        $("#subCategory").remove();
                        $("#subCategoryDiv").append(data);
                    },
                });
            });
        });
    </script>
@endsection
