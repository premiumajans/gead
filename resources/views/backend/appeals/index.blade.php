@extends('master.backend')
@section('title',__('backend.appeals'))
@section('styles')
    @include('backend.templates.components.dt-styles')
@endsection
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">@lang('backend.appeals'):</h4>
                            </div>
                        </div>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>@lang('backend.status'):</th>
                                <th>@lang('backend.content'):</th>
                                <th>@lang('backend.name'):</th>
                                <th>@lang('backend.email'):</th>
                                <th>@lang('backend.phone'):</th>
                                <th>@lang('backend.time'):</th>
                                <th>@lang('backend.actions'):</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($appeals as $appeal)
                                <tr>
                                    <td class="text-center">{{ $appeal->id }}</td>
                                    <td class="text-center">
                                        <span class="mdi {{ ($appeal->read_status == 0) ? 'mdi-eye-off' : 'mdi-eye' }}"> {{ ($appeal->read_status == 0) ? __('backend.unread') : __('backend.read') }}</span>
                                    </td>
                                    <td class="text-center"><a target="_blank" href="https://gead.az/content/{{ $appeal->content_id }}">{{ \App\Models\Content::find($appeal->content_id)->translate(app()->getLocale())->name ?? '-' }}</a></td>
                                    <td class="text-center">{{ $appeal->name }}</td>
                                    <td class="text-center">{{ $appeal->email }}</td>
                                    <td class="text-center">{{ $appeal->phone }}</td>
                                    <td>{{ date('d.m.Y H:i:s',strtotime($appeal->created_at))}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-primary" href="{{ route('backend.readAppeal',['id'=>$appeal->id]) }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        {!! admin_delete('backend.appealsDelete',$appeal->id) !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @include('backend.templates.components.dt-scripts')
@endsection
