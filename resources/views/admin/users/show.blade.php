@extends('admin.layout.app')
@section('title')
    @lang('common.user')
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
                        <li class="breadcrumb-item active">@lang('common.user')</li>
                    </ol>
                </nav>
                <br>
                <br>
                <div class="widget-content-area br-4">
                    <div class="widget-one">

                        <div class="widget-content widget-content-area">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="offset-2 col-md-10">
                                            <div class="form-row">
                                                <div class="form-group col-md-5">
                                                    <label for="name" class="col-form-label">
                                                        @lang('common.name')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <input disabled type="text" class="form-control" id="name"
                                                           name="name" value="{{$user->name}}"
                                                           placeholder="@lang('common.name')">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="email" class="col-form-label">
                                                        @lang('common.email')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <input disabled type="text" class="form-control" id="email"
                                                           name="email" value="{{$user->email}}"
                                                           placeholder="@lang('common.email')">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="mobile" class="col-form-label">
                                                        @lang('common.mobile')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <input disabled type="text" class="form-control" id="mobile"
                                                           name="mobile" value="{{$user->mobile}}"
                                                           placeholder="@lang('common.mobile')">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="password" class="col-form-label">
                                                        @lang('common.password')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <input disabled type="password" class="form-control" id="password"
                                                           name="password" placeholder="@lang('common.password')">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="dob" class="col-form-label">
                                                        @lang('common.dob')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <input disabled type="date" class="form-control" id="dob"
                                                           name="dob" value="{{$user->dob}}"
                                                           placeholder="@lang('common.dob')">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="gender" class="col-form-label">
                                                        @lang('common.gender')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <select disabled name="gender" id="gender">
                                                        <option selected value="">@lang('common.select')</option>
                                                        <option value="male" {{$user->gender == 'male' ? 'selected' : ''}} >@lang('common.male')</option>
                                                        <option value="female" {{$user->gender == 'female' ? 'selected' : ''}} >@lang('common.female')</option>
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
                                                            <img src="{{$user->image}}" alt=""/>
                                                        </div>
                                                        <div class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>


        <!-- CONTENT AREA -->

    </div>

@endsection
@section('js')
@endsection
@section('scripts')
@endsection
