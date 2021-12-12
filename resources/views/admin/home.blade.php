@extends('admin.layout.app')
@section('title')
    @lang('common.home')
@endsection
@section('styles')
    <link href="{{asset('assets/admin/'.LaravelLocalization::getCurrentLocaleDirection().'/plugins/apex/apexcharts.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/'.LaravelLocalization::getCurrentLocaleDirection().'/assets/css/dashboard/dash_1.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/'.LaravelLocalization::getCurrentLocaleDirection().'/assets/css/dashboard/dash_2.css')}}" rel="stylesheet" type="text/css" />
    <style>
        .amcharts-chart-div a {display:none !important;}


    </style>
@endsection
@section('content')
        <div class="layout-px-spacing">

            <div class="page-header">
                <div class="page-title">
                    <h3>@lang('common.dashboard')</h3>
                </div>
            </div>

            <div class="row layout-top-spacing">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 layout-spacing">
                    <a href="{{url('admin/users')}}" class="">
                    <div class="widget widget-card-four">
                        <div class="widget-content">
                            <div class="w-content">
                                <div class="w-info">
                                    <h6 class="value">{{$users->count()}}</h6>
                                    <p class="">@lang('common.users')</p>
                                </div>
                                <div class="">
                                    <div class="w-icon">
                                        <i style="padding-top: 5px;" class="fa fa-user fa-lg float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 layout-spacing">
                    <a href="{{url('admin/drivers')}}" class="">
                    <div class="widget widget-card-four">
                        <div class="widget-content">
                            <div class="w-content">
                                <div class="w-info">
                                    <h6 class="value">{{$drivers->count()}}</h6>
                                    <p class="">@lang('common.drivers')</p>
                                </div>
                                <div class="">
                                    <div class="w-icon">
                                        <i style="padding-top: 5px;" class="fa fa-users fa-lg float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 layout-spacing">
                    <a href="{{url('admin/drivers')}}" class="">
                    <div class="widget widget-card-four">
                        <div class="widget-content">
                            <div class="w-content">
                                <div class="w-info">
                                    <h6 class="value">{{$drivers->where('is_available', 1)->count()}}</h6>
                                    <p class="">@lang('common.available_drivers')</p>
                                </div>
                                <div class="">
                                    <div class="w-icon">
                                        <i style="padding-top: 5px;" class="fa fa-users fa-lg float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 layout-spacing">
                    <a href="{{url('admin/trips')}}" class="">
                    <div class="widget widget-card-four">
                        <div class="widget-content">
                            <div class="w-content">
                                <div class="w-info">
                                    <h6 class="value">{{$trips->count()}}</h6>
                                    <p class="">@lang('common.trips')</p>
                                </div>
                                <div class="">
                                    <div class="w-icon">
                                        <i style="padding-top: 5px;" class="fa fa-car fa-lg float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 layout-spacing">
                    <a href="{{url('admin/trips')}}" class="">
                    <div class="widget widget-card-four">
                        <div class="widget-content">
                            <div class="w-content">
                                <div class="w-info">
                                    <h6 class="value">{{$trips->whereIn('status', ['accepted', 'started'])->count()}}</h6>
                                    <p class="">@lang('common.current_trips')</p>
                                </div>
                                <div class="">
                                    <div class="w-icon">
                                        <i style="padding-top: 5px;" class="fa fa-car fa-lg float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 layout-spacing">
                    <a href="{{url('admin/subscriptions')}}" class="">
                    <div class="widget widget-card-four">
                        <div class="widget-content">
                            <div class="w-content">
                                <div class="w-info">
                                    <h6 class="value">{{$subscriptions->sum('price')}}</h6>
                                    <p class="">@lang('common.subscription_earnings')</p>
                                </div>
                                <div class="">
                                    <div class="w-icon">
                                        <i style="padding-top: 5px;" class="fa fa-dollar fa-lg float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 layout-spacing">
                    <a href="{{url('admin/trips')}}" class="">
                    <div class="widget widget-card-four">
                        <div class="widget-content">
                            <div class="w-content">
                                <div class="w-info">
                                    <h6 class="value">{{$trips->whereIn('status', ['completed', 'confirmed'])->sum('price')}}</h6>
                                    <p class="">@lang('common.drivers_earnings')</p>
                                </div>
                                <div class="">
                                    <div class="w-icon">
                                        <i style="padding-top: 5px;" class="fa fa-dollar fa-lg float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-chart-three">
                        <div class="widget-heading">
                            <div class="">
                                <h5 class="">@lang('common.drivers_earnings')</h5>
                            </div>

                        </div>

                        <div class="widget-content">
                            <div style="padding-left: 30px" id="trips_weekly"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-chart-three">
                        <div class="widget-heading">
                            <div class="">
                                <h5 class="">@lang('common.trips')</h5>
                            </div>

                        </div>

                        <div class="widget-content">
                            <div id="uniqueVisits"></div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

@endsection
@section('js')
    <script src="{{asset('assets/admin/'.LaravelLocalization::getCurrentLocaleDirection().'/plugins/apex/apexcharts.min.js')}}"></script>
    {{--    <script src="{{asset('assets/admin/js/dashboard/dash_1.js')}}"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/pie.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all"/>
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

@endsection
@section('scripts')



    <script>
        var d_1options1 = {
            chart: {
                height: 365,
                type: 'bar',
                toolbar: {
                    show: false,
                },
                dropShadow: {
                    enabled: true,
                    top: 1,
                    left: 1,
                    blur: 2,
                    color: '#acb0c3',
                    opacity: 0.7,
                }
            },
            colors: ['#5c1ac3'],
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                position: 'bottom',
                horizontalAlign: 'center',
                fontSize: '14px',
                fontFamily: 'Cairo Nunito, sans-serif',
                markers: {
                    width: 10,
                    height: 10,
                },
                itemMargin: {
                    horizontal: 0,
                    vertical: 8
                }
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            series: [{
                name: '@lang('common.trips')',
                data: @json($trips_arr)
            }],
            xaxis: {
                categories: @json($days_dates),
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'light',
                    type: 'vertical',
                    shadeIntensity: 0.3,
                    inverseColors: false,
                    opacityFrom: 1,
                    opacityTo: 0.8,
                    stops: [0, 100]
                }
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val
                    }
                }
            }
        }
        var d_1C_3 = new ApexCharts(
            document.querySelector("#uniqueVisits"),
            d_1options1
        );
        d_1C_3.render();
        var options1 = {
            chart: {
                fontFamily: 'Nunito, sans-serif',
                height: 365,
                type: 'area',
                zoom: {
                    enabled: false
                },
                dropShadow: {
                    enabled: true,
                    opacity: 0.3,
                    blur: 5,
                    left: -7,
                    top: 22
                },
                toolbar: {
                    show: false
                },
            },
            colors: ['#1b55e2'],
            dataLabels: {
                enabled: false
            },
            markers: {
                discrete: [{
                    seriesIndex: 0,
                    dataPointIndex: 7,
                    fillColor: '#000',
                    strokeColor: '#000',
                    size: 5
                }]
            },
            /*            subtitle: {
                            text: 'Total Profit',
                            align: 'right',
                            margin: 0,
                            offsetX: -70,
                            offsetY: 35,
                            floating: false,
                            style: {
                                fontSize: '14px',
                                color:  '#888ea8'
                            }
                        },*/
            /*            title: {
                            text: '$10,840',
                            align: 'right',
                            margin: 0,
                            offsetX: -90,
                            offsetY: 0,
                            floating: false,
                            style: {
                                fontSize: '25px',
                                color:  '#0e1726'
                            },
                        },*/
            stroke: {
                show: true,
                curve: 'smooth',
                width: 2,
                lineCap: 'square'
            },
            series: [{
                name: '@lang('common.amount')',
                data: @json($trips_earnings_arr)
            }],
            labels: @json($days_dates),
            xaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                crosshairs: {
                    show: true
                },
                labels: {
                    offsetX: 0,
                    offsetY: 5,
                    style: {
                        fontSize: '12px',
                        fontFamily: 'Nunito, sans-serif',
                        cssClass: 'apexcharts-xaxis-title',
                    },
                }
            },
            yaxis: {
                labels: {
                    formatter: function(value, index) {
                        return value
                    },
                    offsetX: -25,
                    offsetY: 0,
                    style: {
                        fontSize: '12px',
                        fontFamily: 'Nunito, sans-serif',
                        cssClass: 'apexcharts-yaxis-title',
                    },
                }
            },
            grid: {
                borderColor: '#e0e6ed',
                strokeDashArray: 5,
                xaxis: {
                    lines: {
                        show: true
                    }
                },
                yaxis: {
                    lines: {
                        show: false,
                    }
                }
            },
            legend: {
                position: 'top',
                horizontalAlign: 'right',
                offsetY: -50,
                fontSize: '16px',
                fontFamily: 'Nunito, sans-serif',
                markers: {
                    width: 10,
                    height: 10,
                    strokeWidth: 0,
                    strokeColor: '#fff',
                    fillColors: undefined,
                    radius: 12,
                    onClick: undefined,
                    offsetX: 0,
                    offsetY: 0
                },
                itemMargin: {
                    horizontal: 0,
                    vertical: 20
                }
            },
            tooltip: {
                theme: 'dark',
                marker: {
                    show: true,
                },
                x: {
                    show: false,
                }
            },
            fill: {
                type:"gradient",
                gradient: {
                    type: "vertical",
                    shadeIntensity: 1,
                    inverseColors: !1,
                    opacityFrom: .28,
                    opacityTo: .05,
                    stops: [45, 100]
                }
            },
            responsive: [{
                breakpoint: 575,
                options: {
                    legend: {
                        offsetY: -30,
                    },
                },
            }]
        }
        var chart1 = new ApexCharts(
            document.querySelector("#trips_weekly"),
            options1
        );

        chart1.render();

    </script>

@endsection

