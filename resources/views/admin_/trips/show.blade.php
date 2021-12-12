@extends('admin.layout.app')
@section('title')
    @lang('common.trip')
@endsection
@section('css')
@endsection
@section('styles')
@endsection
@section('content')
    <div class="layout-px-spacing">
        <div class="page-header">
            <div class="page-title">
                <h3>@lang('common.trips')</h3>
            </div>
        </div>
        <br>
        <nav class="breadcrumb-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}"><i class="fa fa-lg fa-home"></i></a>
                </li>
                <li class="breadcrumb-item"><a
                        href="{{url('/admin/trips')}}">@lang('common.trips')</a></li>
                <li class="breadcrumb-item active">@lang('common.trip')</li>
            </ol>
        </nav>
        <div class="row layout-top-spacing layout-spacing">
            <div class="col-lg-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>@lang('common.trip')</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <form action="{{url(app()->getLocale()."/admin/trips/$trip->id")}}" id="basic-form" method="post"
                              data-reset="false" class="ajax_form form-horizontal" enctype="multipart/form-data" novalidate>
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                            <div class="form-body offset-3 col-md-7">
                                <div class="form-row">
                                    @foreach(locales() as $key => $value)
                                        <div class="form-group col-md-5">
                                            <label for="name_{{$key}}" class="col-form-label">
                                                @lang('common.name') @lang("common.$value")                                                    <span class="required"> * </span>
                                            </label>
                                            <input type="text" class="form-control" id="name_{{$key}}"
                                                   value="{{$trip->getTranslation('name', $key)}}"
                                                   required disabled name="name_{{$key}}"
                                                   placeholder="@lang('common.name') @lang("common.$value")">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    @endforeach
                                </div>
                                @foreach(locales() as $key => $value)
                                    <div class="form-row">
                                        <div class="form-group col-md-10">
                                            <label for="description_{{$key}}" class="col-form-label">
                                                @lang('common.description') @lang("common.$value")                                                    <span class="required"> * </span>
                                            </label>
                                            <textarea disabled name="description_{{$key}}" class="form-control"
                                                      id="description_{{$key}}" cols="30" rows="3"
                                                      placeholder="@lang('common.name') @lang("common.$value")"
                                            >{{$trip->getTranslation('description', $key)}}</textarea>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                @endforeach

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
    <script>


    </script>


@endsection
