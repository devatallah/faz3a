@extends('admin.layout.app')
@section('title')
    @lang('common.add') @lang('common.number')
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
                    <h3>@lang('common.numbers')</h3>
                </div>
                <br>
                <nav class="breadcrumb-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}"><i class="fa fa-lg fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a
                                href="{{url('/admin/numbers')}}">@lang('common.numbers')</a></li>
                        <li class="breadcrumb-item active">@lang('common.add') @lang('common.number')</li>
                    </ol>
                </nav>
                <br>
                <br>
                <div class="widget-content-area br-4">
                    <div class="widget-one">

                        <div class="widget-content widget-content-number">
                            <form action="{{url(app()->getLocale().'/admin/numbers')}}" id="basic-form" method="POST"
                                  data-reset="true" class="ajax_form form-horizontal" enctype="multipart/form-data"
                                  novalidate>
                                {{csrf_field()}}
                                <div class="form-body offset-3 col-md-7">
                                        <div class="form-group row">
                                            <label for="number" class="col-form-label">
                                                @lang('common.number') <span class="required"> * </span>
                                            </label>
                                            <input type="text" class="form-control" id="number"
                                                   required name="number" placeholder="@lang('common.number')">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="price" class="col-form-label">
                                                @lang('common.price') <span class="required"> * </span>
                                            </label>
                                            <input type="text" class="form-control" id="price"
                                                   required name="price" placeholder="@lang('common.price')">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="order" class="col-form-label">
                                                @lang('common.order') <span class="required"> * </span>
                                            </label>
                                            <input type="number" class="form-control" id="order"
                                                   required name="order" placeholder="@lang('common.order')">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    <div class="form-group row">
                                        <label for="twitter" class="col-form-label">
                                            @lang('common.twitter') <span class="required"> * </span>
                                        </label>
                                        <input type="text" class="form-control" id="twitter"
                                               required name="twitter" placeholder="@lang('common.twitter')">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="instagram" class="col-form-label">
                                            @lang('common.instagram') <span class="required"> * </span>
                                        </label>
                                        <input type="text" class="form-control" id="instagram"
                                               required name="instagram" placeholder="@lang('common.instagram')">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="whatsapp" class="col-form-label">
                                            @lang('common.whatsapp') <span class="required"> * </span>
                                        </label>
                                        <input type="text" class="form-control" id="whatsapp"
                                               required name="whatsapp" placeholder="@lang('common.whatsapp')">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="snapchat" class="col-form-label">
                                            @lang('common.snapchat') <span class="required"> * </span>
                                        </label>
                                        <input type="text" class="form-control" id="snapchat"
                                               required name="snapchat" placeholder="@lang('common.snapchat')">
                                        <div class="invalid-feedback"></div>
                                    </div>
{{--
                                        <div class="form-group row">
                                            <label for="image" class="col-md-1 col-form-label">
                                                @lang('image')
                                            </label>
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                                         style="width: 200px; height: 150px;"></div>
                                                    <div>
                                                    <span class="btn btn-secondary btn-file"><span
                                                            class="fileinput-new">@lang('select_image')</span><span
                                                            class="fileinput-exists">@lang('change')</span><input
                                                            accept="image/*" type="file"
                                                            name="image"></span>
                                                        <a href="#" class="btn btn-danger fileinput-exists"
                                                           data-dismiss="fileinput">@lang('remove')</a>
                                                    </div>
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                    </div>
--}}

                                    <button type="submit" class="submit_btn btn btn-primary">
                                        <i class="fa fa-spinner fa-spin" style="display: none;"></i>
                                        @lang('common.save')
                                    </button>
                                    <a href="{{url('/admin/numbers')}}" id="cancel_btn" class="btn btn-default">
                                        @lang('common.cancel')
                                    </a>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>


        <!-- CONTENT AREA -->

    </div>

    {{--
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
                    <li class="breadcrumb-item active">@lang('common.add') @lang('common.number')</li>
                </ol>
            </nav>
            <div class="row layout-top-spacing layout-spacing">
                <div class="col-lg-12">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>@lang('common.add') @lang('common.number')</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-number">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    --}}
@endsection
@section('js')
@endsection
@section('scripts')
@endsection
