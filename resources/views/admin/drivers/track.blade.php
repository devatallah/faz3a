@extends('admin.layout.app')
@section('title')
    @lang('common.home')
@endsection
@section('styles')
    {{--    <link href="{{asset('assets/admin/plugins/apex/apexcharts.css')}}" rel="stylesheet" type="text/css">--}}
    {{--    <link href="{{asset('assets/admin/css/dashboard/dash_1.css')}}" rel="stylesheet" type="text/css" class="dashboard-analytics" />--}}
    {{--    <link href="{{asset('assets/admin/css/dashboard/dash_2.css')}}" rel="stylesheet" type="text/css" class="dashboard-analytics" />--}}
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet'/>
@endsection
@section('content')

    <div class="layout-px-spacing">

        <div id='map' style='width: 100%; height: 800px;'></div>

    </div>


@endsection
@section('js')
    {{--    <script src="{{asset('assets/admin/plugins/apex/apexcharts.min.js')}}"></script>--}}
    {{--    <script src="{{asset('assets/admin/js/dashboard/dash_1.js')}}"></script>--}}
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>--}}
    {{--    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>--}}
    {{--    <script src="https://www.amcharts.com/lib/3/pie.js"></script>--}}
    {{--    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>--}}
    {{--    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all"/>--}}
    {{--    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>--}}
    <script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
    <script type="text/javascript" src="{{asset('parse.js')}}"></script>

@endsection
@section('scripts')


    <script>
        var k = 'marker';
        var i = 0;
        var style = 'mapbox://styles/wishwishapp/ckfna0poa0iv219o6eat1exg7';
        @if(app()->getLocale() == 'ar')
            style = 'mapbox://styles/wishwishapp/ckfna5bm40a1719mdsn8iyv3m';
        @endif

            mapboxgl.accessToken = 'pk.eyJ1Ijoid2lzaHdpc2hhcHAiLCJhIjoiY2tlczB0MTd2MnYzaTJxcGl2NXlhaG5kNyJ9.2pKnuJqVUQ9Fg67a9hOtQg';
        mapboxgl.setRTLTextPlugin(
            'https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-rtl-text/v0.2.3/mapbox-gl-rtl-text.js',
            null,
            true // Lazy load the plugin
        );
        var map = new mapboxgl.Map({
            container: 'map',
            style: style,
            center: [45.0792, 23.8859],
            zoom: 5
        });
        var server_url = "http://198.12.252.234:1337/parse",
            app_id = "KSDJFKDJ9DKFDJDKF",
            classname = "Driver";

        Parse.initialize(app_id);
        Parse.serverURL = server_url;
        var ClassObject = Parse.Object.extend(classname);
        var query = new Parse.Query(ClassObject);

        function loadMessages() {
            (async () => {
                const results = await query.find();
                for (let i = 0; i < results.length; i++) {
                    var object = results[i];
                    console.log(object.attributes)
                    if (object.attributes.lat && object.attributes.lng) {
                        var text = '@lang('common.name'): '+object.attributes.name+' - @lang('common.mobile'): '+object.attributes.mobile+' - @lang('common.email'): '+object.attributes.email;
                        eval('var marker' + object.attributes.driverId + '=  new mapboxgl.Marker().setLngLat([' + object.attributes.lng + ', ' + object.attributes.lat + ']).setPopup(new mapboxgl.Popup().setText("'+text+'")).addTo(map) ;');
                    }
                    /*
                    map.easeTo({
                        center: [object.attributes.lat, object.attributes.lng], // starting position [lng, lat]
                        zoom: 12 // starting zoom
                    });
*/
                }
            })();
        }

        (async () => {
            var subscription = await query.subscribe();


            subscription.on('update', function (obj) {
                if (obj.attributes.lat && obj.attributes.lng) {
                    eval('marker' + obj.attributes.driverId + ' =  marker1.setLngLat([' + obj.attributes.lng + ', ' + obj.attributes.lat + ']) ;');
                }
            });
            subscription.on('open', function (obj) {
                loadMessages();
            });

        })();
    </script>

@endsection

