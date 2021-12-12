@extends('admin.layout.app')
@section('title')
    @lang('common.edit') @lang('common.driver')
@endsection
@section('css')
@endsection
@section('styles')
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet' />

@endsection
@section('content')

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
                <div class="widget-header">
                    <h3>@lang('common.drivers')</h3>
                </div>
                <br>
                <nav class="breadcrumb-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}"><i class="fa fa-lg fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a
                                href="{{url('/admin/drivers')}}">@lang('common.drivers')</a></li>
                        <li class="breadcrumb-item active">@lang('common.edit') @lang('common.driver')</li>
                    </ol>
                </nav>
                <br>
                <br>
                <div class="widget-content-area br-4">
                    <div class="widget-one">

                        <div class="widget-content widget-content-area">
                            <form action="{{url(app()->getLocale()."/admin/drivers/$driver->id")}}" id="basic-form" method="post"
                                  data-reset="false" class="ajax_form form-horizontal" enctype="multipart/form-data" novalidate>
                                {{csrf_field()}}
                                {{method_field('PUT')}}
                                <input type="hidden" value="{{$driver->id}}" name="id">
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
                                                           required name="name" value="{{$driver->name}}"
                                                           placeholder="@lang('common.name')">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="email" class="col-form-label">
                                                        @lang('common.email')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <input type="text" class="form-control" id="email"
                                                           value="{{$driver->email}}" name="email"
                                                           placeholder="@lang('common.email')">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="mobile" class="col-form-label">
                                                        @lang('common.mobile')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <input type="text" class="form-control" id="mobile"
                                                           name="mobile" value="{{$driver->mobile}}"
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
                                                    <label for="status" class="col-form-label">
                                                        @lang('common.status')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <select name="status" id="status">
                                                        <option selected value="">@lang('common.select')</option>
                                                        <option value="1" {{$driver->status == '1' ? 'selected' : ''}} >@lang('common.active')</option>
                                                        <option value="0" {{$driver->status == '0' ? 'selected' : ''}} >@lang('common.inactive')</option>
                                                    </select>
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="dob" class="col-form-label">
                                                        @lang('common.dob')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <input type="date" class="form-control" id="dob" name="dob"
                                                           value="{{$driver->dob}}"
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
                                                        <option value="male" {{$driver->gender == 'male' ? 'selected' : ''}} >@lang('common.male')</option>
                                                        <option value="female" {{$driver->gender == 'female' ? 'selected' : ''}} >@lang('common.female')</option>
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
                                                           value="{{$driver->id_no}}" name="id_no"
                                                           placeholder="@lang('common.id_no')">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="plate_no" class="col-form-label">
                                                        @lang('common.plate_no')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <input type="text" class="form-control" id="plate_no"
                                                           value="{{$driver->plate_no}}" name="plate_no"
                                                           placeholder="@lang('common.plate_no')">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="passengers" class="col-form-label">
                                                        @lang('common.passengers')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <input type="text" class="form-control" id="passengers"
                                                           value="{{$driver->passengers}}" name="passengers"
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
                                                            <option value="{{$trip_type->id}}" {{$trip_type->id == $driver->trip_type_id ? 'selected' : ''}}>{{$trip_type->name}}</option>
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
                                                        @foreach($services as $service)
                                                            <option value="{{$service->id}}" {{in_array($service->id, $driver->services->pluck('id')->toArray()) ? 'selected' : ''}}>{{$service->name}}</option>
                                                        @endforeach
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
                                                           name="driver_licence_expire_date" value="{{$driver->driver_licence_expire_date}}"
                                                           placeholder="@lang('common.driver_licence_expire_date')">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="vehicle_licence_expire_date" class="col-form-label">
                                                        @lang('common.vehicle_licence_expire_date')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <input type="date" class="form-control" id="vehicle_licence_expire_date"
                                                           name="vehicle_licence_expire_date"  value="{{$driver->vehicle_licence_expire_date}}"
                                                           placeholder="@lang('common.vehicle_licence_expire_date')">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="image" class="col-form-label">
                                                        @lang('common.profile_image')
                                                    </label>
                                                    <br>
                                                    <div class="fileinput fileinput-exists"
                                                         data-provides="fileinput">
                                                        <div class="fileinput-preview thumbnail"
                                                             data-trigger="fileinput"
                                                             style="width: 200px; height: 150px;">
                                                            <img src="{{$driver->image}}" alt=""/>
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
                                                <div class="form-group col-md-4">
                                                    <label for="id_image" class="col-form-label">
                                                        @lang('common.id_image')
                                                    </label>
                                                    <br>
                                                    <div class="fileinput fileinput-exists"
                                                         data-provides="fileinput">
                                                        <div class="fileinput-preview thumbnail"
                                                             data-trigger="fileinput"
                                                             style="width: 200px; height: 150px;">
                                                            <img src="{{$driver->id_image}}" alt=""/>
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
                                                <div class="form-group col-md-4">
                                                    <label for="driver_licence_image" class="col-form-label">
                                                        @lang('common.driver_licence_image')
                                                    </label>
                                                    <br>
                                                    <div class="fileinput fileinput-exists"
                                                         data-provides="fileinput">
                                                        <div class="fileinput-preview thumbnail"
                                                             data-trigger="fileinput"
                                                             style="width: 200px; height: 150px;">
                                                            <img src="{{$driver->driver_licence_image}}" alt=""/>
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
                                                <div class="form-group col-md-4">
                                                    <label for="vehicle_licence_image" class="col-form-label">
                                                        @lang('common.vehicle_licence_image')
                                                    </label>
                                                    <br>
                                                    <div class="fileinput fileinput-exists"
                                                         data-provides="fileinput">
                                                        <div class="fileinput-preview thumbnail"
                                                             data-trigger="fileinput"
                                                             style="width: 200px; height: 150px;">
                                                            <img src="{{$driver->vehicle_licence_image}}" alt=""/>
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
                                                <div class="form-group col-md-4">
                                                    <label for="vehicle_image" class="col-form-label">
                                                        @lang('common.vehicle_image')
                                                    </label>
                                                    <br>
                                                    <div class="fileinput fileinput-exists"
                                                         data-provides="fileinput">
                                                        <div class="fileinput-preview thumbnail"
                                                             data-trigger="fileinput"
                                                             style="width: 200px; height: 150px;">
                                                            <img src="{{$driver->vehicle_image}}" alt=""/>
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
{{--
                                            <div class="form-row">
                                                <div id='map' style='width: 100%; height: 800px;'></div>
                                            </div>
--}}
                                        </div>
                                    </div>
                                </div>
{{--                                <br>--}}
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


        <!-- CONTENT AREA -->

    </div>

@endsection
@section('js')
@endsection
@section('scripts')
    <script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
    <script type="text/javascript" src="{{asset('parse.js')}}"></script>
    <script>

        {{--var vehicle_types_list = {--}}
        {{--    @foreach($services as $service)--}}
        {{--    'service_{{$service->id}}': [--}}
        {{--            @foreach($service->vehicleTypes as $vehicle_type)--}}
        {{--        {--}}
        {{--            id: '{{$vehicle_type->id}}',--}}
        {{--            text: '{{$vehicle_type->name}}',--}}
        {{--        },--}}

        {{--        @endforeach--}}
        {{--    ],--}}
        {{--    @endforeach--}}
        {{--};--}}

        {{--$(document).on("change", "#service_id", function (e) {--}}
        {{--    var value = $(this).val();--}}
        {{--    $("#vehicle_type_id").html('<option selected value="">@lang('common.select')</option>')--}}
        {{--    $("#vehicle_type_id").select2({--}}
        {{--        data: vehicle_types_list['service_' + value]--}}
        {{--    }).trigger("change");--}}
        {{--});--}}

        var services_list = {
            @foreach($vehicle_types as $vehicle_type)
            'vehicle_type_{{$vehicle_type->id}}': [
                    @foreach($vehicle_type->services as $services)
                {
                    id: '{{$services->id}}',
                    text: '{{$services->name}}',
                },

                @endforeach
            ],
            @endforeach
        };

        $(document).on("change", "#service_id", function (e) {
            var value = $(this).val();
            $("#vehicle_type_id").html('<option selected value="">@lang('common.select')</option>')
            $("#vehicle_type_id").select2({
                data: vehicle_types_list['service_' + value]
            }).trigger("change");
        });
        $(document).on("change", "#vehicle_type_id", function (e) {
            var value = $(this).val();
            $("#service_ids").html('')
            $("#service_ids").select2({
                data: services_list['vehicle_type_' + value]
            }).trigger("change");
        });
        // var k = 'marker';
        // var i = 0;

/*
        mapboxgl.accessToken = 'pk.eyJ1Ijoid2lzaHdpc2hhcHAiLCJhIjoiY2tlczB0MTd2MnYzaTJxcGl2NXlhaG5kNyJ9.2pKnuJqVUQ9Fg67a9hOtQg';
*/
/*
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11', // stylesheet location
            zoom: 1 // starting zoom
        });
*/
        // var marker3;
/*
        var server_url = "http://198.12.252.234:1337/parse",
            app_id = "KSDJFKDJ9DKFDJDKF",
            classname = "Driver";
*/

        {{--var driver_id = parseInt("{{$driver->id}}");--}}
        // Parse.initialize(app_id);
        // Parse.serverURL = server_url;
        // var ClassObject = Parse.Object.extend(classname);
        // var query = new Parse.Query(ClassObject);
        // query.equalTo("driverId", driver_id);
/*
        function loadMessages(){
            (async () => {
                const results = await query.find();
                var object = results[0];
                console.log(object)
                marker3 = new mapboxgl.Marker()
                    .setLngLat([object.attributes.lat, object.attributes.lng])
                    .setPopup(new mapboxgl.Popup().setText('{{$driver->name}}'))
                    .addTo(map);
                map.easeTo({
                    center: [object.attributes.lat, object.attributes.lng], // starting position [lng, lat]
                    zoom: 12 // starting zoom
                });
            })();
        }
*/
/*
        (async () => {
            var subscription = await query.subscribe();


            subscription.on('update', function (obj) {
                marker3.setLngLat([obj.attributes.lat, obj.attributes.lng]);
                map.easeTo({
                    center: [obj.attributes.lat, obj.attributes.lng], // starting position [lng, lat]
                    zoom: 12 // starting zoom
                });
                console.log(obj.attributes.lat);
            });
            subscription.on('open', function (obj) {
                loadMessages();
            });

        })();
*/
    </script>

@endsection
