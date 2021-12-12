@extends('admin.layout.app')
@section('title')
    @lang('common.add') @lang('common.driver')
@endsection
@section('css')
    {{--
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.standalone.min.css"/>
    --}}
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
                <li class="breadcrumb-item active">@lang('common.add') @lang('common.driver')</li>
            </ol>
        </nav>
        <div class="row layout-top-spacing layout-spacing">
            <div class="col-lg-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>@lang('common.add') @lang('common.driver')</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <form action="{{url(app()->getLocale().'/admin/drivers')}}" id="basic-form" method="POST"
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
                                            {{--                                        </div>--}}
                                            {{--                                        <div class="form-row">--}}
                                            <div class="form-group col-md-5">
                                                <label for="id_no" class="col-form-label">
                                                    @lang('common.id_no')
                                                    <span class="required"> * </span>
                                                </label>
                                                <input type="text" class="form-control" id="id_no"
                                                       required name="id_no"
                                                       placeholder="@lang('common.id_no')">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label for="plate_no" class="col-form-label">
                                                    @lang('common.plate_no')
                                                    <span class="required"> * </span>
                                                </label>
                                                <input type="text" class="form-control" id="plate_no"
                                                       required name="plate_no"
                                                       placeholder="@lang('common.plate_no')">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label for="passengers" class="col-form-label">
                                                    @lang('common.passengers')
                                                    <span class="required"> * </span>
                                                </label>
                                                <input type="text" class="form-control" id="passengers"
                                                       required name="passengers"
                                                       placeholder="@lang('common.passengers')">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            {{--                                        </div>--}}
                                            {{--                                        <div class="form-row">--}}
                                            <div class="form-group col-md-5">
                                                <label for="trip_type_id" class="col-form-label">
                                                    @lang('common.trip_type')
                                                    <span class="required"> * </span>
                                                </label>
                                                <select name="trip_type_id" id="trip_type_id">
                                                    @foreach($trip_types as $trip_type)
                                                        <option value="{{$trip_type->id}}">{{$trip_type->name}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label for="vehicle_type_id" class="col-form-label">
                                                    @lang('common.vehicle_type')
                                                    <span class="required"> * </span>
                                                </label>
                                                <select name="vehicle_type_id" id="vehicle_type_id">
                                                    @foreach($vehicle_types as $vehicle_type)
                                                        <option value="{{$vehicle_type->id}}" {{$vehicle_type->id == $driver->vehicle_type_id ? 'selected' : ''}}>{{$vehicle_type->name}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label for="service_id" class="col-form-label">
                                                    @lang('common.service')
                                                    <span class="required"> * </span>
                                                </label>
                                                <select name="service_ids[]" id="service_ids" multiple>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            {{--                                        </div>--}}
                                            {{--                                        <div class="form-row">--}}
                                            <div class="form-group col-md-5">
                                                <label for="driver_licence_expire_date" class="col-form-label">
                                                    @lang('common.driver_licence_expire_date')
                                                    <span class="required"> * </span>
                                                </label>
                                                <input type="date" class="form-control" id="driver_licence_expire_date"
                                                       name="driver_licence_expire_date" required
                                                       placeholder="@lang('common.driver_licence_expire_date')">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label for="vehicle_licence_expire_date" class="col-form-label">
                                                    @lang('common.vehicle_licence_expire_date')
                                                    <span class="required"> * </span>
                                                </label>
                                                <input type="date" class="form-control" id="vehicle_licence_expire_date"
                                                       name="vehicle_licence_expire_date" required
                                                       placeholder="@lang('common.vehicle_licence_expire_date')">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-row">
                                                <div class="form-group col-md-9">
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
                                            <div class="form-group col-md-9">
                                                <label for="id_image" class="col-form-label">
                                                    @lang('common.id_image')
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
                                                        <input type="file" name="id_image"></span>
                                                    </div>
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="form-group col-md-9">
                                                <label for="driver_licence_image" class="col-form-label">
                                                    @lang('common.driver_licence_image')
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
                                                        <input type="file" name="driver_licence_image"></span>
                                                    </div>
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="form-group col-md-9">
                                                <label for="vehicle_licence_image" class="col-form-label">
                                                    @lang('common.vehicle_licence_image')
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
                                                        <input type="file" name="vehicle_licence_image"></span>
                                                    </div>
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="form-group col-md-9">
                                                <label for="vehicle_image" class="col-form-label">
                                                    @lang('common.vehicle_image')
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
                                                        <input type="file" name="vehicle_image"></span>
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
                                        <a href="{{url('/admin/drivers')}}" id="cancel_btn" class="btn btn-default">
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
@endsection
@section('js')
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    @if(app()->isLocale('ar'))
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.ar.min.js"></script>
    @endif
@endsection
@section('scripts')
    <script>


        var services_list = {
            @foreach($vehicle_types as $vehicle_type)
            'vehicle_type_{{$vehicle_type->id}}': [
                    @foreach($vehicle_type->vehicleTypes as $services)
                {
                    id: '{{$services->id}}',
                    text: '{{$services->name}}',
                },

                @endforeach
            ],
            @endforeach
        };

        $(document).on("change", "#vehicle_type_id", function (e) {
            var value = $(this).val();
            $("#service_ids").html('<option selected value="">@lang('common.select')</option>')
            $("#service_ids").select2({
                data: services_list['vehicle_type_' + value]
            }).trigger("change");
        });
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
