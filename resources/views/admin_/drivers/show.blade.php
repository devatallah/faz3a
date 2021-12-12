@extends('admin.layout.app')
@section('title')
    @lang('common.driver')
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.standalone.min.css"/>
@endsection
@section('styles')
@endsection
@section('content')
    <div class="layout-px-spacing">
        <div class="page-header">
            <div class="page-title">
                <h3>@lang('common.drivers')</h3>
            </div>
        </div>
        <br>
        <nav class="breadcrumb-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}"><i class="fa fa-lg fa-home"></i></a>
                </li>
                <li class="breadcrumb-item"><a
                        href="{{url('/admin/drivers')}}">@lang('common.drivers')</a></li>
                <li class="breadcrumb-item active">@lang('common.driver')</li>
            </ol>
        </nav>
        <div class="row layout-top-spacing layout-spacing">
            <div class="col-lg-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>@lang('common.driver')</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <form action="{{url(app()->getLocale()."/admin/drivers/$driver->id")}}" id="basic-form"
                              method="post"
                              data-reset="false" class="ajax_form form-horizontal" enctype="multipart/form-data"
                              novalidate>
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                            <div class="form-body">
                                <div class="row">
                                    <div class="offset-2 col-md-10">
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="name" class="col-form-label">
                                                    @lang('common.name')
                                                    <span class="required"> * </span>
                                                </label>
                                                <input type="text" class="form-control" id="name"
                                                       value="{{$driver->name}}" required disabled name="name"
                                                       placeholder="@lang('common.name')">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="email" class="col-form-label">
                                                    @lang('common.email')
                                                    <span class="required"> * </span>
                                                </label>
                                                <input type="text" class="form-control" id="email" disabled name="email" required
                                                       value="{{$driver->email}}" placeholder="@lang('common.email')">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="password" class="col-form-label">
                                                    @lang('common.password')
                                                    <span class="required"> * </span>
                                                </label>
                                                <input type="password" class="form-control" id="password" disabled name="password" required
                                                       placeholder="@lang('common.password')">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="job_title_id" class="col-form-label">
                                                    @lang('common.job_title')
                                                    <span class="required"> * </span>
                                                </label>
                                                <select disabled name="job_title_id" id="job_title_id">
                                                    <option selected value="">@lang('common.select')</option>
                                                    @foreach($job_titles as $job_title)
                                                        <option value="{{$job_title->id}}"
                                                            {{$job_title->id == $driver->job_title_id ? 'selected' : ''}}>{{$job_title->name}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="status" class="col-form-label">
                                                    @lang('common.status')
                                                    <span class="required"> * </span>
                                                </label>
                                                <select class="form-control" id="status" disabled name="status" required>
                                                    <option value="">@lang('common.select')</option>
                                                    <option value="1" {{1 == $driver->status ? 'selected' : ''}}>@lang('common.active')</option>
                                                    <option value="2" {{2 == $driver->status ? 'selected' : ''}}>@lang('common.inactive')</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="employment_date" class="col-form-label">
                                                    @lang('common.employment_date')
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="input-group date date-picker" id=""
                                                     data-date-format="yyyy-mm-dd">
                                                    <input type="text" class="form-control" disabled name="employment_date"
                                                           value="{{$driver->employment_date}}" id="datepicker" readonly data-date-format="yyyy-mm-dd">
                                                </div>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="branch_id" class="col-form-label">
                                                    @lang('common.branch')
                                                    <span class="required"> * </span>
                                                </label>
                                                <select disabled name="branch_id" id="branch_id">
                                                    <option selected value="">@lang('common.select')</option>
                                                    <optgroup label="Admin">
                                                        <option value="0" {{0 == $driver->branch_id ? 'selected' : ''}}>@lang('common.admin')</option>
                                                    </optgroup>
                                                    <optgroup label="Branches">
                                                        @foreach($branches as $branch)
                                                            <option value="{{$branch->id}}"
                                                                {{$branch->id == $driver->branch_id ? 'selected' : ''}}>{{$branch->name}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="mobile" class="col-form-label">
                                                    @lang('common.mobile')
                                                    <span class="required"> * </span>
                                                </label>
                                                <input type="text" class="form-control" id="mobile"
                                                       value="{{$driver->mobile}}" required disabled name="mobile"
                                                       placeholder="@lang('common.mobile')">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="passport_number" class="col-form-label">
                                                    @lang('common.passport_number')
                                                    <span class="required"> * </span>
                                                </label>
                                                <input type="text" class="form-control" id="passport_number"
                                                       value="{{$driver->passport_number}}" disabled name="passport_number" required
                                                       placeholder="@lang('common.passport_number')">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="id_number" class="col-form-label">
                                                    @lang('common.id_number')
                                                    <span class="required"> * </span>
                                                </label>
                                                <input type="text" class="form-control" id="id_number" disabled name="id_number"
                                                       value="{{$driver->id_number}}" required
                                                       placeholder="@lang('common.id_number')">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="civil_number" class="col-form-label">
                                                    @lang('common.civil_number')
                                                    <span class="required"> * </span>
                                                </label>
                                                <input type="text" class="form-control" id="civil_number" disabled name="civil_number"
                                                       value="{{$driver->civil_number}}" required
                                                       placeholder="@lang('common.civil_number')">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="salary" class="col-form-label">
                                                    @lang('common.salary')
                                                    <span class="required"> * </span>
                                                </label>
                                                <input type="text" class="form-control" id="salary" disabled name="salary" required
                                                       value="{{$driver->salary}}" placeholder="@lang('common.salary')">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="hours" class="col-form-label">
                                                    @lang('common.hours')
                                                    <span class="required"> * </span>
                                                </label>
                                                <input type="text" class="form-control" id="hours"
                                                       value="{{$driver->hours}}" disabled name="hours" required
                                                       placeholder="@lang('common.hours_number_per_month')">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="contract_number" class="col-form-label">
                                                    @lang('common.contract_number')
                                                    <span class="required"> * </span>
                                                </label>
                                                <input type="text" class="form-control" id="contract_number"
                                                       value="{{$driver->contract_number}}" disabled name="contract_number" required
                                                       placeholder="@lang('common.contract_number')">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-9">
                                                <label for="note" class="col-form-label">
                                                    @lang('common.note')
                                                </label>
                                                <textarea disabled name="note" class="form-control" id="note" cols="30" rows="3"
                                                          placeholder="@lang('common.note')">{{$driver->note}}</textarea>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-9">
                                                <label for="image" class="col-form-label">
                                                    @lang('common.image')
                                                </label>
                                                <br>
                                                <div class="fileinput fileinput-exists" data-provides="fileinput">
                                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                                         style="width: 200px; height: 150px;">
                                                        <img src="{{$driver->image}}" alt=""/></div>
                                                    <div>
                                                    <span class="btn btn-secondary btn-file">
                                                                <span class="fileinput-new"> @lang('common.select_image')</span>
                                                                <span class="fileinput-exists"> @lang('common.select_image')</span>
                                                        <input type="file" disabled name="image"></span>
                                                    </div>
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-9">
                                                <label for="contract_images" class="col-form-label">
                                                    @lang('common.contract_images')
                                                </label>
                                                <input type="file" multiple disabled name="contract_images[]" id="contract_images"
                                                       class="form-control" value="" required/>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            @foreach($driver->contract_images as $image)
                                                <div class="col-md-4">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                                             style="width: 200px; height: 150px;">
                                                            <img src="{{$image->image}}" class="image_" data-id="{{$image->id}}" alt=""/></div>
                                                        <div class="invalid-feedback"></div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="row">
                                    <div class="offset-1 col-md-11">

                                        <div class="form-row">
                                            @foreach($permissions as $permission)

                                                <div class="form-group col-md-3">
                                                    <label class="fancy-checkbox">
                                                        <input id="select_all" type="checkbox" value="{{$permission->id}}" disabled name="permissions[]"
                                                            {{ in_array($permission->id, @$admin->getDirectPermissions()->pluck('id')->toArray())? 'checked' : '' }}>
                                                        <span>@lang('common.'.explode('_',$permission->name)[0]) @lang('common.'.ltrim(strstr($permission->name, '_'), '_'))</span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="width: 70%; height: 70%">
                <div class="modal-content">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($driver->onlyImages as $image)
                                <div class="carousel-item " id="image_{{$image->id}}">
                                    <img class="d-block w-100" src="{{$image->image}}" style="width: 100%" alt="First slide">
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    @if(app()->isLocale('ar'))
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.ar.min.js"></script>
    @endif
@endsection
@section('scripts')
    <script>

        $(document).on("click", ".image_", function (e) {
            $('.carousel-item').removeClass('active')
            $('#image_'+$(this).data('id')).addClass('active')
            $('.modal').modal('show');

        });
        $('#datepicker').datepicker({
            minViewMode: 0,
            todayHighlight: true,
            orientation: "bottom",
            autoclose: !0,
        });
        $(document).on("click", ".remove_field", function (e) { //user click on remove text'+
            e.preventDefault();
            var numItems = $('.remove_field').length;
            $(this).parent().parent().parent().remove();
            $('#basic-form').append('<input type="hidden" disabled name="delete_ids[]" value="' + $(this).data('id') + '"/>')
        })
    </script>
@endsection
