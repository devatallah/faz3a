@extends('admin.layout.app')
@section('title')
    @lang('common.add') @lang('common.user')
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
                    <h3>@lang('common.users')</h3>
                </div>
                <br>
                <nav class="breadcrumb-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}"><i class="fa fa-lg fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a
                                href="{{url('/admin/users')}}">@lang('common.users')</a></li>
                        <li class="breadcrumb-item active">@lang('common.add') @lang('common.user')</li>
                    </ol>
                </nav>
                <br>
                <br>
                <div class="widget-content-area br-4">
                    <div class="widget-one">

                        <div class="widget-content widget-content-area">
                            <form action="{{url(app()->getLocale().'/admin/users')}}" id="basic-form" method="POST"
                                  data-reset="true" class="ajax_form form-horizontal" enctype="multipart/form-data"
                                  novalidate>
                                {{csrf_field()}}
                                <div class="form-body">
                                    <div class="row">
                                        <div class="offset-2 col-md-10">
                                            <div class="form-row">
                                                <div class="form-group col-md-5">
                                                    <label for="name" class="col-form-label">
                                                        @lang('common.name')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <input type="text" class="form-control" id="name"
                                                           required name="name"
                                                           placeholder="@lang('common.name')">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="email" class="col-form-label">
                                                        @lang('common.email')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <input type="text" class="form-control" id="email" name="email" required
                                                           placeholder="@lang('common.email')">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="mobile" class="col-form-label">
                                                        @lang('common.mobile')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <input type="text" class="form-control" id="mobile"
                                                           required name="mobile"
                                                           placeholder="@lang('common.mobile')">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                                {{--                                        </div>--}}
                                                {{--                                        <div class="form-row">--}}
                                                <div class="form-group col-md-5">
                                                    <label for="password" class="col-form-label">
                                                        @lang('common.password')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <input type="password" class="form-control" id="password"
                                                           name="password" required
                                                           placeholder="@lang('common.password')">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="dob" class="col-form-label">
                                                        @lang('common.dob')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <input type="date" class="form-control" id="dob" name="dob" required
                                                           placeholder="@lang('common.dob')">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="gender" class="col-form-label">
                                                        @lang('common.gender')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <select name="gender" id="gender">
                                                        <option selected value="">@lang('common.select')</option>
                                                        <option value="male">@lang('common.male')</option>
                                                        <option value="female">@lang('common.female')</option>
                                                    </select>
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="image" class="col-form-label">
                                                        @lang('common.image')
                                                    </label>
                                                    <br>
                                                    <div class="fileinput fileinput-exists"
                                                         data-provides="fileinput">
                                                        <div class="fileinput-preview thumbnail"
                                                             data-trigger="fileinput"
                                                             style="width: 200px; height: 150px;">
                                                        </div>
                                                        <div>
                                                    <span class="btn btn-secondary btn-file">
                                                                <span
                                                                    class="fileinput-new"> @lang('common.select_image')</span>
                                                                <span
                                                                    class="fileinput-exists"> @lang('common.select_image')</span>
                                                        <input type="file" name="image"></span>
                                                        </div>
                                                        <div class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-body">
                                    <div class="row">
                                        <div class="offset-2 col-md-10">

                                            <button type="submit" class="submit_btn btn btn-primary">
                                                <i class="fa fa-spinner fa-spin" style="display: none;"></i>
                                                @lang('common.save')
                                            </button>
                                            <a href="{{url('/admin/users')}}" id="cancel_btn" class="btn btn-default">
                                                @lang('common.cancel')
                                            </a>
                                        </div>
                                    </div>
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
    <script>


        /*
                $('#datepicker').datepicker({
                    minViewMode: 0,
                    todayHighlight: true,
                    orientation: "bottom",
                    autoclose: !0,
                });
        */
    </script>

@endsection
