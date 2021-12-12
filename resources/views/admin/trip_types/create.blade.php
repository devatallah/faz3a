@extends('admin.layout.app')
@section('title')
    @lang('common.add') @lang('common.trip_type')
@endsection
@section('css')
@endsection
@section('styles')
@endsection
@section('content')

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
                <div class="widget-header">
                    <h3>@lang('common.trip_types')</h3>
                </div>
                <br>
                <nav class="breadcrumb-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}"><i class="fa fa-lg fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a
                                href="{{url('/admin/trip_types')}}">@lang('common.trip_types')</a></li>
                        <li class="breadcrumb-item active">@lang('common.add') @lang('common.trip_type')</li>
                    </ol>
                </nav>
                <br>
                <br>
                <div class="widget-content-area br-4">
                    <div class="widget-one">

                        <div class="widget-content widget-content-area">
                            <form action="{{url(app()->getLocale().'/admin/trip_types')}}" id="basic-form" method="POST"
                                  data-reset="true" class="ajax_form form-horizontal" enctype="multipart/form-data"
                                  novalidate>
                                {{csrf_field()}}
                                <div class="form-body offset-3 col-md-7">
                                    <div class="form-row">
                                        @foreach(locales() as $key => $value)
                                            <div class="form-group col-md-5">
                                                <label for="name_{{$key}}" class="col-form-label">
                                                    @lang('common.name') @lang("common.$value")                                                    <span class="required"> * </span>
                                                </label>
                                                <input type="text" class="form-control" id="name_{{$key}}"
                                                       required name="name_{{$key}}"
                                                       placeholder="@lang('common.name') @lang("common.$value")">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <button type="submit" class="submit_btn btn btn-primary">
                                        <i class="fa fa-spinner fa-spin" style="display: none;"></i>
                                        @lang('common.save')
                                    </button>
                                    <a href="{{url('/admin/trip_types')}}" id="cancel_btn" class="btn btn-default">
                                        @lang('common.cancel')
                                    </a>
                                </div>
                            </form>
                        </div>

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
