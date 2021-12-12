@extends('admin.layout.app')
@section('title')
    @lang('common.chats')
@endsection
@section('css')
@endsection
@section('styles')
    <script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet'/>
<style>
    .msg_date{
        padding-top: 5px;
        display:block;
        text-align:right;
        font-size: small;
    }
</style>
@endsection
@section('content')

    <div class="layout-px-spacing">

        {{--        <div id='map' style='width: 100%; height: 800px;'></div>--}}
        <div class="chat-section layout-top-spacing">
            <div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12">

                    <div class="chat-system">
                        <div class="chat-box" style="height: calc(100vh - 203px);">
                            <div class="chat-box-inner" style="height: 100%;">
                                <div class="chat-meta-user chat-active">
                                    <div class="current-chat-user-name"><span>
                                                  <span class="name">@lang('common.driver'): {{@$driver->name}}   --   @lang('common.user'): {{@$user->name}}</span>
                                              </span>
                                    </div>

                                </div>
                                <div class="chat-conversation-box ps" style="overflow: auto !important;">
                                    <div id="chat-conversation-box-scroll" class="chat-conversation-box-scroll">
                                        <div id="chat_box" class="chat active-chat">
                                            <div class="conversation-start">
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


        @endsection
        @section('js')
            <script type="text/javascript" src="{{asset('parse.js')}}"></script>

        @endsection
        @section('scripts')
            {{--<script>
                var k = 'marker';
                var i = 0;

                mapboxgl.accessToken = 'pk.eyJ1Ijoid2lzaHdpc2hhcHAiLCJhIjoiY2tlczB0MTd2MnYzaTJxcGl2NXlhaG5kNyJ9.2pKnuJqVUQ9Fg67a9hOtQg';
                var map = new mapboxgl.Map({
                    container: 'map',
                    style: 'mapbox://styles/mapbox/streets-v11', // stylesheet location
                    // center: [31.354675, 34.308826], // starting position [lng, lat]
                    zoom: 1 // starting zoom
                });
                var lat3 = 30.50005
                var marker3;
                var server_url = "http://198.12.252.234:1337/parse",
                    app_id = "KSDJFKDJ9DKFDJDKF",
                    classname = "Driver";

                Parse.initialize(app_id);
                Parse.serverURL = server_url;
                var ClassObject = Parse.Object.extend(classname);
                var query = new Parse.Query(ClassObject);
                query.equalTo("driverId", 3);
                function loadMessages(){
                    (async () => {
                        const results = await query.find();
                        var object = results[0];
                        console.log(object)
                         marker3 = new mapboxgl.Marker()
                            .setLngLat([object.attributes.lat, object.attributes.lng])
                            .setPopup(new mapboxgl.Popup().setText('Hello, world!'))
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
                // for(i = 1; i < 5; i++) {
                //   eval('var ' + k + i + '= ' + i + ';');
                // }
                var inc = 0.0001
/*
                window.setInterval(function() {
                    // lat1 += inc
                    // lat2 += inc
                    lat3 += inc
                    // eval('marker1 =  marker1.setLngLat(['+ lat1 +', 50.5]) ;');
                    // eval('marker2 =  marker2.setLngLat(['+ lat2 +', 50.5]) ;');
                    eval('marker3 =  marker3.setLngLat(['+ lat3 +', 50.5]) ;');
                    inc += 0.0005
                    console.log(inc)
                    // marker.setLngLat([lat, 50.5]);
                }, 2000);
*/
            </script>--}}

            <script type="text/javascript">
                var trip_types = @json($trip_types);
                var vehicle_types = @json($vehicle_types);
                var services = @json($services);
                var statuses = @json($statuses);
                var lastScrollTop = 0;
/*
                $('.chat-conversation-box').scroll(function (event) {
                    var st = $(this).scrollTop();
                    if (st === 0) {
                        loadMessages();
                    }
                });
*/

                /*
                * Your credentials from:
                * SashiDo Dashboard > You app > App Settings > Security & Keys
                */
                // let skip = 0
                // let limit = 10
                var server_url = "http://198.12.252.234:1337/parse",
                    app_id = "KSDJFKDJ9DKFDJDKF",
                    classname = "Messages";

                Parse.initialize(app_id);
                Parse.serverURL = server_url;
                var ClassObject = Parse.Object.extend(classname);
                var query = new Parse.Query(ClassObject);
                query.equalTo("conv_id", "{{request('driver_id')}}_{{request('user_id')}}");

                // query.withCount();

                function loadMessages() {
                    (async () => {
                        const results = await query.find();
                        if (results){
                        for (let i = 0; i < results.length; i++) {
                            var object = results[i];
                            var send_date = object.attributes.createdAt;
                            send_date = (''+send_date).split('GMT')[0];
                            console.log(send_date)
                            if (object.attributes.type == 'text') {
                                if (object.attributes.sender == object.attributes.agent) {
                                    $('#chat_box').prepend(`<div class="bubble you">` + object.attributes.text + ` <span class="msg_date">`+send_date+`</span></div>`)
                                    // console.log(`<div class="bubble you">`+object.attributes.text+`</div>`)
                                } else {
                                    $('#chat_box').prepend(`<div class="bubble me">` + object.attributes.text + `<span class="msg_date">`+send_date+`</span></div>`)
                                    // console.log(`<div class="bubble me">`+object.attributes.text+`</div>`)
                                }
                                // console.log(object.attributes);
                            }
                            if (object.attributes.type == 'image') {
                                if (object.attributes.sender == object.attributes.agent) {
                                    $('#chat_box').prepend(`<div class="bubble you"><img style="width: 215px;" src="`+object.attributes.file._url+`" alt=""><span class="msg_date">`+send_date+`</span></div>`)
                                } else {
                                    $('#chat_box').prepend(`<div class="bubble me"><img style="width: 215px;" src="`+object.attributes.file._url+`" alt=""><span class="msg_date">`+send_date+`</span></div>`)
                                }

                            }
                            if (object.attributes.type == 'contract') {
                                var trip_query = new Parse.Query('Contracts');
                                trip_query.equalTo("tripId", object.attributes.trip_id);
                                console.log(object.attributes.trip_id)
                                var trip_results = await trip_query.find();
                                var trip_object = trip_results[0];
                                if (trip_object){
                                $('#chat_box').prepend(`<div class="bubble me">
                                    <b>@lang('common.date'): </b>`+trip_object.attributes.date+`<br>
                                    <b>@lang('common.price'): </b>`+trip_object.attributes.price+`<br>
                                    <b>@lang('common.vehicle_type'): </b>`+vehicle_types[trip_object.attributes.vehicleTypeId]+`<br>
                                    <b>@lang('common.service'): </b>`+vehicle_types[trip_object.attributes.serviceId]+`<br>
                                    <b>@lang('common.trip_type'): </b>`+vehicle_types[trip_object.attributes.tripTypeId]+`<br>
                                    <b>@lang('common.from_address'): </b>`+trip_object.attributes.fromAddress+`<br>
                                    <b>@lang('common.to_address'): </b>`+trip_object.attributes.toAddress+`<br>
                                    <b>@lang('common.status'): </b>`+statuses[object.attributes.status]+`<br>
                                    <span class="msg_date">`+send_date+`</span></div>`)
                            }
                            }
                            if (object.attributes.type == 'voice') {
                                if (object.attributes.sender == object.attributes.agent) {
                                    $('#chat_box').prepend(`<div class="bubble you">
    <audio controls preload="auto" id="` + object.id + `_audio">
      <source src="" type="audio/mpeg" id="` + object.id + `_source">
        This text displays if the audio tag isn't supported.
    </audio>

    <span class="msg_date">`+send_date+`</span></div>`)

                                } else {
                                    $('#chat_box').prepend(`<div class="bubble me">
    <audio controls preload="auto" id="` + object.id + `_audio">
      <source src="" type="audio/mpeg" id="` + object.id + `_source">
        This text displays if the audio tag isn't supported.
    </audio>

    <span class="msg_date">`+send_date+`</span></div>`)

                                }
                                document.getElementById(object.id + '_source').src = object.attributes.file._url;
                                document.getElementById(object.id + '_audio').load();

                            }

                            console.log(object.attributes);
                        }
                        }
                        })();
                }

                (async () => {
                    var subscription = await query.subscribe();


                    subscription.on('update', function (obj) {
                        console.log(obj);
                    });
                    subscription.on('open', function (obj) {
                        loadMessages();
                    });

                })();
                $('#json').text('Waiting for changes ...')


            </script>

@endsection
