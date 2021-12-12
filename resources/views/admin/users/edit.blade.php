@extends('admin.layout.app')
@section('title')
    @lang('common.edit') @lang('common.user')
@endsection
@section('css')
@endsection
@section('styles')
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet'/>

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
                        <li class="breadcrumb-item active">@lang('common.edit') @lang('common.user')</li>
                    </ol>
                </nav>
                <br>
                <br>
                <div class="widget-content-area br-4">
                    <div class="widget-one">

                        <div class="widget-content widget-content-area">
                            <form action="{{url(app()->getLocale()."/admin/users/$user->id")}}" id="basic-form"
                                  method="post"
                                  data-reset="false" class="ajax_form form-horizontal" enctype="multipart/form-data"
                                  novalidate>
                                {{csrf_field()}}
                                {{method_field('PUT')}}
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
                                                           name="name" value="{{$user->name}}"
                                                           placeholder="@lang('common.name')">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="email" class="col-form-label">
                                                        @lang('common.email')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <input type="text" class="form-control" id="email"
                                                           name="email" value="{{$user->email}}"
                                                           placeholder="@lang('common.email')">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="mobile" class="col-form-label">
                                                        @lang('common.mobile')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <input type="text" class="form-control" id="mobile"
                                                           name="mobile" value="{{$user->mobile}}"
                                                           placeholder="@lang('common.mobile')">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="password" class="col-form-label">
                                                        @lang('common.password')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <input type="password" class="form-control" id="password"
                                                           name="password" placeholder="@lang('common.password')">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="dob" class="col-form-label">
                                                        @lang('common.dob')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <input type="date" class="form-control" id="dob"
                                                           name="dob" value="{{$user->dob}}"
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


        <!-- CONTENT AREA -->

    </div>

@endsection
@section('js')
@endsection
@section('scripts')
    <script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
    <script type="text/javascript" src="{{asset('parse.js')}}"></script>
    <script>
        var k = 'marker';
        var i = 0;

        mapboxgl.accessToken = 'pk.eyJ1Ijoid2lzaHdpc2hhcHAiLCJhIjoiY2tlczB0MTd2MnYzaTJxcGl2NXlhaG5kNyJ9.2pKnuJqVUQ9Fg67a9hOtQg';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11', // stylesheet location
            zoom: 1 // starting zoom
        });
        var marker3;
        var server_url = "http://198.12.252.234:1337/parse",
            app_id = "KSDJFKDJ9DKFDJDKF",
            classname = "user";

        var user_id = parseInt("{{$user->id}}");
        Parse.initialize(app_id);
        Parse.serverURL = server_url;
        var ClassObject = Parse.Object.extend(classname);
        var query = new Parse.Query(ClassObject);
        query.equalTo("userId", user_id);

        function loadMessages() {
            (async () => {
                const results = await query.find();
                var object = results[0];
                console.log(object)
                marker3 = new mapboxgl.Marker()
                    .setLngLat([object.attributes.lat, object.attributes.lng])
                    .setPopup(new mapboxgl.Popup().setText('{{$user->name}}'))
                    .addTo(map);
                map.easeTo({
                    center: [object.attributes.lat, object.attributes.lng], // starting position [lng, lat]
                    zoom: 12 // starting zoom
                });
            })();
        }

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
    </script>

@endsection
