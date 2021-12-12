@extends('admin.layout.app')
@section('title')
    @lang('common.edit') @lang('common.admin')
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
                    <h3>@lang('common.admins')</h3>
                </div>
                <br>
                <nav class="breadcrumb-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}"><i class="fa fa-lg fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a
                                href="{{url('/admin/admins')}}">@lang('common.admins')</a></li>
                        <li class="breadcrumb-item active">@lang('common.edit') @lang('common.admin')</li>
                    </ol>
                </nav>
                <br>
                <br>
                <div class="widget-content-area br-4">
                    <div class="widget-one">

                        <div class="widget-content widget-content-admin">
                            <form action="{{url(app()->getLocale()."/admin/admins/$admin->id")}}" id="basic-form" method="post"
                                  data-reset="false" class="ajax_form form-horizontal" enctype="multipart/form-data" novalidate>
                                {{csrf_field()}}
                                {{method_field('PUT')}}
                                <div class="form-body offset-3 col-md-7">
                                        <div class="form-group row">
                                            <label for="name" class="col-form-label">
                                                @lang('common.name') <span class="required"> * </span>
                                            </label>
                                            <input type="text" class="form-control" id="name" value="{{$admin->name}}"
                                                   required name="name" placeholder="@lang('common.name')">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-form-label">
                                                @lang('common.email') <span class="required"> * </span>
                                            </label>
                                            <input type="text" class="form-control" id="email" value="{{$admin->email}}"
                                                   required name="email" placeholder="@lang('common.email')">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="mobile" class="col-form-label">
                                                @lang('common.mobile') <span class="required"> * </span>
                                            </label>
                                            <input type="text" class="form-control" id="mobile" value="{{$admin->mobile}}"
                                                   required name="mobile" placeholder="@lang('common.mobile')">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password" class="col-form-label">
                                                @lang('common.password') <span class="required"> * </span>
                                            </label>
                                            <input type="password" class="form-control" id="password"
                                                   required name="password" placeholder="@lang('common.password')">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="image" class="col-md-1 col-form-label">
                                                @lang('common.image')
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6">

                                                <div class="fileinput fileinput-exists"
                                                     data-provides="fileinput">
                                                    <div class="fileinput-preview thumbnail"
                                                         data-trigger="fileinput"
                                                         style="width: 200px; height: 150px;">
                                                        <img src="{{$admin->image}}" alt=""/>
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
                                            </div>
                                        </div>

                                    <button type="submit" class="submit_btn btn btn-primary">
                                        <i class="fa fa-spinner fa-spin" style="display: none;"></i>
                                        @lang('common.save')
                                    </button>
                                    <a href="{{url('/admin/admins')}}" id="cancel_btn" class="btn btn-default">
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
                    <h3>@lang('common.admins')</h3>
                </div>
            </div>
            <br>
            <nav class="breadcrumb-one" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}"><i class="fa fa-lg fa-home"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a
                            href="{{url('/admin/admins')}}">@lang('common.admins')</a></li>
                    <li class="breadcrumb-item active">@lang('common.edit') @lang('common.admin')</li>
                </ol>
            </nav>
            <div class="row layout-top-spacing layout-spacing">
                <div class="col-lg-12">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>@lang('common.edit') @lang('common.admin')</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-admin">

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
