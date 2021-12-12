@extends('admin.layout.app')
@section('title')
    @lang('common.add') @lang('common.page')
@endsection
@section('css')
@endsection
@section('styles')
@endsection
@section('content')

    <div class="layout-px-spacing">
        <div class="page-header">
            <div class="page-title">
                <h3>@lang('common.pages')</h3>
            </div>
        </div>
        <br>
        <nav class="breadcrumb-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}"><i class="fa fa-lg fa-home"></i></a>
                </li>
                <li class="breadcrumb-item"><a
                        href="{{url('/admin/pages')}}">@lang('common.pages')</a></li>
                <li class="breadcrumb-item active">@lang('common.add') @lang('common.page')</li>
            </ol>
        </nav>
        <div class="row layout-top-spacing layout-spacing">
            <div class="col-lg-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>@lang('common.add') @lang('common.page')</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <form action="{{url(app()->getLocale().'/admin/pages')}}" id="basic-form" method="POST"
                              data-reset="true" class="ajax_form form-horizontal" enctype="multipart/form-data"
                              novalidate>
                            {{csrf_field()}}
                            <div class="form-body offset-3 col-md-7">
                                <div class="form-row">
                                    @foreach(locales() as $key => $value)
                                        <div class="form-group col-md-5">
                                            <label for="title_{{$key}}" class="col-form-label">
                                                @lang('common.title') @lang("common.$value")                                                    <span class="required"> * </span>
                                            </label>
                                            <input type="text" class="form-control" id="title_{{$key}}"
                                                   required name="title_{{$key}}"
                                                   placeholder="@lang('common.title') @lang("common.$value")">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    @endforeach
                                        @foreach(locales() as $key => $value)
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="content_{{$key}}" class="col-form-label">
                                                        @lang('common.content') @lang("common.$value")
                                                    </label>
                                                    <textarea name="content_{{$key}}" class="form-control"
                                                              id="content_{{$key}}" cols="30" rows="3"
                                                              placeholder="@lang('common.name')
                                                              @lang("common.$value")"></textarea>
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        @endforeach

                                </div>

                                <button type="submit" class="submit_btn btn btn-primary">
                                    <i class="fa fa-spinner fa-spin" style="display: none;"></i>
                                    @lang('common.save')
                                </button>
                                <a href="{{url('/admin/pages')}}" id="cancel_btn" class="btn btn-default">
                                    @lang('common.cancel')
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

    </div>
    </div>
@endsection
@section('js')
@endsection
@section('scripts')
@endsection
