@extends('admin.layout.app')
@section('title')
    @lang('common.number')
@endsection
@section('css')
@endsection
@section('styles')
@endsection
@section('content')
    <div class="layout-px-spacing">
        <div class="page-header">
            <div class="page-title">
                <h3>@lang('common.numbers')</h3>
            </div>
        </div>
        <br>
        <nav class="breadcrumb-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}"><i class="fa fa-lg fa-home"></i></a>
                </li>
                <li class="breadcrumb-item"><a
                        href="{{url('/admin/numbers')}}">@lang('common.numbers')</a></li>
                <li class="breadcrumb-item active">@lang('common.number')</li>
            </ol>
        </nav>
        <div class="row layout-top-spacing layout-spacing">
            <div class="col-lg-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>@lang('common.number')</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-number">
                        <form action="{{url(app()->getLocale()."/admin/numbers/$number->id")}}" id="basic-form" method="post"
                              data-reset="false" class="ajax_form form-horizontal" enctype="multipart/form-data" novalidate>
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                            <div class="form-body offset-3 col-md-7">
                                <div class="form-row">
                                    @foreach(locales() as $key => $value)
                                        <div class="form-group col-md-5">
                                            <label for="name_{{$key}}" class="col-form-label">
                                                @lang('common.name') @lang("common.$value")
                                                <span class="required"> * </span>
                                            </label>
                                            <input type="text" class="form-control" id="name_{{$key}}"
                                                   required disabled disabled name="name_{{$key}}"
                                                   value="{{$number->getTranslation('name', $key)}}"
                                                   placeholder="@lang('common.name') @lang("common.$value")">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-10">
                                        <label for="note" class="col-form-label">
                                            @lang("common.note")
                                        </label>
                                        <textnumber disabled disabled name="note" class="form-control" id="note" cols="30" rows="3"
                                                  placeholder="@lang('common.note')">{{$number->note}}</textnumber>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>

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
