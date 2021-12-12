@extends('admin.layout.app')
@section('title')
    @lang('common.home')
@endsection
@section('css')
    <link href="{{asset('assets/admin/plugins/apex/apexcharts.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/admin/css/dashboard/dash_1.css')}}" rel="stylesheet" type="text/css" class="dashboard-analytics" />
    <link href="{{asset('assets/admin/css/dashboard/dash_2.css')}}" rel="stylesheet" type="text/css" class="dashboard-analytics" />

@endsection
@section('styles')
    <style>
        .amcharts-chart-div a {display:none !important;}


    </style>
@endsection
@section('content')
{{--
    <div class="layout-px-spacing">

        <div class="page-header">
            <div class="page-title">
                <h3>@lang('common.dashboard')</h3>
            </div>
        </div>

        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-card-four">
                    <div class="widget-content">
                        <div class="form-body">
                            <form id="search_form">
                            <div class="form-group row">
                                <label for="branch_id" class="col-md-1 col-form-label">
                                    @lang('common.branch')
                                </label>

                                <div class='col-sm-2'>
                                    <select name="branch_id" class="form-control" id="branch_id">

                                        <option value="0">@lang('common.all')</option>
                                    @foreach($branches_list as $branch)
                                            <option value="{{$branch->id}}" {{$branch->id == request('branch_id') ? 'selected' : ''}}>{{$branch->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            </form>
                        </div>
                        <div class="w-content">

--}}
{{--
                            <div class="w-info">
                                <h6 class="value">{{$products->count()}}</h6>
                                <p class="">@lang('common.products')</p>
                            </div>
--}}{{--

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 layout-spacing">
                <div class="widget widget-card-four">
                    <div class="widget-content">
                        <div class="w-content">
                            <div class="w-info">
                                <h6 class="value">{{$products->count()}}</h6>
                                <p class="">@lang('common.products')</p>
                            </div>
                            <div class="">
                                <div class="w-icon">
                                    <i style="padding-top: 5px;" class="fa fa-dollar fa-lg float-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 layout-spacing">
                <div class="widget widget-card-four">
                    <div class="widget-content">
                        <div class="w-content">
                            <div class="w-info">
                                <h6 class="value">{{$employees->count()}}</h6>
                                <p class="">@lang('common.employees')</p>
                            </div>
                            <div class="">
                                <div class="w-icon">
                                    <i style="padding-top: 5px;" class="fa fa-users fa-lg float-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 layout-spacing">
                <div class="widget widget-card-four">
                    <div class="widget-content">
                        <div class="w-content">
                            <div class="w-info">
                                <h6 class="value">{{$complaints->count()}}</h6>
                                <p class="">@lang('common.complaints')</p>
                            </div>
                            <div class="">
                                <div class="w-icon">
                                    <i style="padding-top: 5px;" class="fa fa-head-side-cough fa-lg float-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 layout-spacing">
                <div class="widget widget-card-four">
                    <div class="widget-content">
                        <div class="w-content">
                            <div class="w-info">
                                <h6 class="value">{{$last_day_closes->sum('budget')}}</h6>
                                <p class="">@lang('common.last_day_close')</p>
                            </div>
                            <div class="">
                                <div class="w-icon">
                                    <i style="padding-top: 5px;" class="fa fa-dollar fa-lg float-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-chart-two">
                    <div class="widget-heading">
                        <h5 class="">@lang('common.area_branches_count')</h5>
                    </div>
                    <div class="widget-content">
                        <div id="branches_per_area" class=""></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-chart-two">
                    <div class="widget-heading">
                        <h5 class="">@lang('common.category_products_count')</h5>
                    </div>
                    <div class="widget-content">
                        <div id="products_per_category" class=""></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-chart-two">
                    <div class="widget-heading">
                        <h5 class="">@lang('common.branch_employees_count')</h5>
                    </div>
                    <div class="widget-content">
                        <div id="employees_per_branch" class=""></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-chart-two">
                    <div class="widget-heading">
                        <h5 class="">@lang('common.job_title_employees_count')</h5>
                    </div>
                    <div class="widget-content">
                        <div id="employees_per_job_title" class=""></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-chart-one">
                    <div class="widget-heading">
                        <h5 class="">@lang('common.invoices')</h5>
                        <ul class="tabs tab-pills">
                            <li><a href="javascript:void(0);" id="tb_1" class="tabmenu">Monthly</a></li>
                        </ul>
                    </div>

                    <div class="widget-content">
                        <div class="tabs tab-content">
                            <div id="content_1" class="tabcontent">
                                <div id="revenueMonthly"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing" style="direction: rtl">
                <div class="widget widget-chart-three">
                    <div class="widget-heading">
                        <div class="">
                            <h5 class="">@lang('common.closes')</h5>
                        </div>

                    </div>

                    <div class="widget-content">
                        <div id="uniqueVisits"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
        </div>
            <div class="row clearfix">
                <div class="col-lg-4 col-md-12" style="margin-bottom: 10px">
                    <div class="widget-four">
                        <div class="widget-heading">
                            <h5 class="">{{__('common.top_rated_product')}}</h5>
                        </div>
                        <table class="table table-striped m-b-0">
                            <tbody>
                            @foreach($product_ratings as $item)
                                <tr>
                                    <td>{{@$item->product->name}}</td>
                                    <td class="font-medium">{{@$item->rating}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="col-lg-4 col-md-12" style="margin-bottom: 10px">
                    <div class="widget-four">
                        <div class="widget-heading">
                            <h5 class="">{{__('common.most_complaint_products')}}</h5>
                        </div>
                        <table class="table table-striped m-b-0">
                            <tbody>
                            @foreach($most_product_complaints as $item)
                                <tr>
                                    <td>{{$item->product->name}}</td>
                                    <td class="font-medium">{{$item->counts}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="col-lg-4 col-md-12" style="margin-bottom: 10px">
                    <div class="widget-four">
                        <div class="widget-heading">
                            <h5 class="">{{__('common.top_rated_employees')}}</h5>
                        </div>
                        <table class="table table-striped m-b-0">
                            <tbody>
                            @foreach($employee_ratings as $item)
                                <tr>
                                    <td>{{$item->employee->name}}</td>
                                    <td class="font-medium">{{$item->rating}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

    </div>
--}}

@endsection
@section('js')
    <script src="{{asset('assets/admin/plugins/apex/apexcharts.min.js')}}"></script>
{{--    <script src="{{asset('assets/admin/js/dashboard/dash_1.js')}}"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/pie.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all"/>
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

@endsection
@section('scripts')
{{--
    <script>
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
            colors: ['#1b55e2', '#e7515a'],
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
                }, {
                    seriesIndex: 2,
                    dataPointIndex: 11,
                    fillColor: '#000',
                    strokeColor: '#000',
                    size: 4
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
                name: 'Purchase',
                data: @json($purchases_arr)
            }, {
                name: 'Expenses',
                data: @json($expenses_arr)
            }],
            labels: @json($months),
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
            document.querySelector("#revenueMonthly"),
            options1
        );

        chart1.render();

        @if($area_branches_count)
        var branches_per_area = {
            chart: {
                type: 'donut',
                width: 380
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                position: 'bottom',
                horizontalAlign: 'center',
                fontSize: '14px',
                markers: {
                    width: 10,
                    height: 10,
                },
                itemMargin: {
                    horizontal: 0,
                    vertical: 8
                }
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '65%',
                        background: 'transparent',
                        labels: {
                            show: true,
                            name: {
                                show: true,
                                fontSize: '29px',
                                fontFamily: 'Nunito, sans-serif',
                                color: undefined,
                                offsetY: -10
                            },
                            value: {
                                show: true,
                                fontSize: '26px',
                                fontFamily: 'Nunito, sans-serif',
                                color: '20',
                                offsetY: 16,
                                formatter: function (val) {
                                    return val
                                }
                            },
                            total: {
                                show: true,
                                showAlways: true,
                                label: '@lang('common.total')',
                                color: '#888ea8',
                                formatter: function (w) {
                                    return w.globals.seriesTotals.reduce( function(a, b) {
                                        return a + b
                                    }, 0)
                                }
                            }
                        }
                    }
                }
            },
            stroke: {
                width: 25,
                show: true,
            },
            series: @json($area_branches_count),
            labels: @json($areas_names),
            responsive: [{
                breakpoint: 1599,
                options: {
                    chart: {
                        width: '350px',
                        height: '400px'
                    },
                    legend: {
                        position: 'bottom'
                    }
                },

                breakpoint: 1439,
                options: {
                    chart: {
                        width: '250px',
                        height: '390px'
                    },
                    legend: {
                        position: 'bottom'
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '65%',
                            }
                        }
                    }
                },
            }]

        };
        var branches_per_area_chart = new ApexCharts(
            document.querySelector("#branches_per_area"),
            branches_per_area
        );
        branches_per_area_chart.render();

        @endif
            @if($branch_employees_count)
        var employees_per_branch = {
            chart: {
                type: 'donut',
                width: 380
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                position: 'bottom',
                horizontalAlign: 'center',
                fontSize: '14px',
                markers: {
                    width: 10,
                    height: 10,
                },
                itemMargin: {
                    horizontal: 0,
                    vertical: 8
                }
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '65%',
                        background: 'transparent',
                        labels: {
                            show: true,
                            name: {
                                show: true,
                                fontSize: '29px',
                                fontFamily: 'Nunito, sans-serif',
                                color: undefined,
                                offsetY: -10
                            },
                            value: {
                                show: true,
                                fontSize: '26px',
                                fontFamily: 'Nunito, sans-serif',
                                color: '20',
                                offsetY: 16,
                                formatter: function (val) {
                                    return val
                                }
                            },
                            total: {
                                show: true,
                                showAlways: true,
                                label: '@lang('common.total')',
                                color: '#888ea8',
                                formatter: function (w) {
                                    return w.globals.seriesTotals.reduce( function(a, b) {
                                        return a + b
                                    }, 0)
                                }
                            }
                        }
                    }
                }
            },
            stroke: {
                width: 25,
                show: true,
            },
            series: @json($branch_employees_count),
            labels: @json($branches_names),
            responsive: [{
                breakpoint: 1599,
                options: {
                    chart: {
                        width: '350px',
                        height: '400px'
                    },
                    legend: {
                        position: 'bottom'
                    }
                },

                breakpoint: 1439,
                options: {
                    chart: {
                        width: '250px',
                        height: '390px'
                    },
                    legend: {
                        position: 'bottom'
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '65%',
                            }
                        }
                    }
                },
            }]
        };
        var employees_per_branch_chart = new ApexCharts(
            document.querySelector("#employees_per_branch"),
            employees_per_branch
        );
        employees_per_branch_chart.render();

        @endif
            @if($job_title_employees_count)
        var employees_per_job_title = {
            chart: {
                type: 'donut',
                width: 380
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                position: 'bottom',
                horizontalAlign: 'center',
                fontSize: '14px',
                markers: {
                    width: 10,
                    height: 10,
                },
                itemMargin: {
                    horizontal: 0,
                    vertical: 8
                }
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '65%',
                        background: 'transparent',
                        labels: {
                            show: true,
                            name: {
                                show: true,
                                fontSize: '29px',
                                fontFamily: 'Nunito, sans-serif',
                                color: undefined,
                                offsetY: -10
                            },
                            value: {
                                show: true,
                                fontSize: '26px',
                                fontFamily: 'Nunito, sans-serif',
                                color: '20',
                                offsetY: 16,
                                formatter: function (val) {
                                    return val
                                }
                            },
                            total: {
                                show: true,
                                showAlways: true,
                                label: '@lang('common.total')',
                                color: '#888ea8',
                                formatter: function (w) {
                                    return w.globals.seriesTotals.reduce( function(a, b) {
                                        return a + b
                                    }, 0)
                                }
                            }
                        }
                    }
                }
            },
            stroke: {
                width: 25,
                show: true,
            },
            series: @json($job_title_employees_count),
            labels: @json($job_titles_names),
            responsive: [{
                breakpoint: 1599,
                options: {
                    chart: {
                        width: '350px',
                        height: '400px'
                    },
                    legend: {
                        position: 'bottom'
                    }
                },

                breakpoint: 1439,
                options: {
                    chart: {
                        width: '250px',
                        height: '390px'
                    },
                    legend: {
                        position: 'bottom'
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '65%',
                            }
                        }
                    }
                },
            }]
        };
        var employees_per_job_title_chart = new ApexCharts(
            document.querySelector("#employees_per_job_title"),
            employees_per_job_title
        );
        employees_per_job_title_chart.render();
@endif
        @if($category_products_count)
        var products_per_category = {
            chart: {
                type: 'donut',
                width: 380
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                position: 'bottom',
                horizontalAlign: 'center',
                fontSize: '14px',
                markers: {
                    width: 10,
                    height: 10,
                },
                itemMargin: {
                    horizontal: 0,
                    vertical: 8
                }
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '65%',
                        background: 'transparent',
                        labels: {
                            show: true,
                            name: {
                                show: true,
                                fontSize: '29px',
                                fontFamily: 'Nunito, sans-serif',
                                color: undefined,
                                offsetY: -10
                            },
                            value: {
                                show: true,
                                fontSize: '26px',
                                fontFamily: 'Nunito, sans-serif',
                                color: '20',
                                offsetY: 16,
                                formatter: function (val) {
                                    return val
                                }
                            },
                            total: {
                                show: true,
                                showAlways: true,
                                label: '@lang('common.total')',
                                color: '#888ea8',
                                formatter: function (w) {
                                    return w.globals.seriesTotals.reduce( function(a, b) {
                                        return a + b
                                    }, 0)
                                }
                            }
                        }
                    }
                }
            },
            stroke: {
                width: 25,
                show: true,
            },
            series: @json($category_products_count),
            labels: @json($categories_names),
            responsive: [{
                breakpoint: 1599,
                options: {
                    chart: {
                        width: '350px',
                        height: '400px'
                    },
                    legend: {
                        position: 'bottom'
                    }
                },

                breakpoint: 1439,
                options: {
                    chart: {
                        width: '250px',
                        height: '390px'
                    },
                    legend: {
                        position: 'bottom'
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '65%',
                            }
                        }
                    }
                },
            }]
        };
        var products_per_category_chart = new ApexCharts(
            document.querySelector("#products_per_category"),
            products_per_category
        );
        products_per_category_chart.render();

        @endif
        // Total Visits

        var spark1 = {
            chart: {
                id: 'total_purchase',
                group: 'sparks2',
                type: 'line',
                height: 80,
                sparkline: {
                    enabled: true
                },
                dropShadow: {
                    enabled: true,
                    top: 1,
                    left: 1,
                    blur: 2,
                    color: '#e2a03f',
                    opacity: 0.7,
                }
            },
            series: [{
                data: [21, 9, 36, 12, 44, 25, 59, 41, 66, 25].reverse()
            }],
            stroke: {
                curve: 'smooth',
                width: 2,
            },
            markers: {
                size: 0
            },
            grid: {
                padding: {
                    top: 35,
                    bottom: 0,
                    left: 40
                }
            },
            colors: ['#e2a03f'],
            tooltip: {
                x: {
                    show: false
                },
                y: {
                    title: {
                        formatter: function formatter(val) {
                            return '';
                        }
                    }
                }
            },
            responsive: [{
                breakpoint: 1351,
                options: {
                    chart: {
                        height: 95,
                    },
                    grid: {
                        padding: {
                            top: 35,
                            bottom: 0,
                            left: 0
                        }
                    },
                },
            },
                {
                    breakpoint: 1200,
                    options: {
                        chart: {
                            height: 80,
                        },
                        grid: {
                            padding: {
                                top: 35,
                                bottom: 0,
                                left: 40
                            }
                        },
                    },
                },
                {
                    breakpoint: 576,
                    options: {
                        chart: {
                            height: 95,
                        },
                        grid: {
                            padding: {
                                top: 45,
                                bottom: 0,
                                left: 0
                            }
                        },
                    },
                }

            ]
        }
        d_1C_1 = new ApexCharts(document.querySelector("#total_purchase"), spark1);
        d_1C_1.render();

        // Paid Visits

        var spark2 = {
            chart: {
                id: 'total_expenses',
                group: 'sparks1',
                type: 'line',
                height: 80,
                sparkline: {
                    enabled: true
                },
                dropShadow: {
                    enabled: true,
                    top: 3,
                    left: 1,
                    blur: 3,
                    color: '#009688',
                    opacity: 0.7,
                }
            },
            series: [{
                data: [22, 90, 30, 47, 200,80, 110, 150, 44, 34, 180, 90, 69].reverse()
            }],
            stroke: {
                curve: 'smooth',
                width: 2,
            },
            markers: {
                size: 0
            },
            grid: {
                padding: {
                    top: 35,
                    bottom: 0,
                    left: 40
                }
            },
            colors: ['#009688'],
            tooltip: {
                x: {
                    show: false
                },
                y: {
                    title: {
                        formatter: function formatter(val) {
                            return '';
                        }
                    }
                }
            },
            responsive: [{
                breakpoint: 1351,
                options: {
                    chart: {
                        height: 95,
                    },
                    grid: {
                        padding: {
                            top: 35,
                            bottom: 0,
                            left: 0
                        }
                    },
                },
            },
                {
                    breakpoint: 1200,
                    options: {
                        chart: {
                            height: 80,
                        },
                        grid: {
                            padding: {
                                top: 35,
                                bottom: 0,
                                left: 40
                            }
                        },
                    },
                },
                {
                    breakpoint: 576,
                    options: {
                        chart: {
                            height: 95,
                        },
                        grid: {
                            padding: {
                                top: 35,
                                bottom: 0,
                                left: 0
                            }
                        },
                    },
                }
            ]
        }
        d_1C_2 = new ApexCharts(document.querySelector("#total_expenses"), spark2);
        d_1C_2.render();

        var d_1options1 = {
            chart: {
                height: 350,
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
            colors: ['#5c1ac3', '#ffbb44'],
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
                name: '{{\Carbon\Carbon::now()->subDays(2)->format('m-d')}}',
                data: @json(@$branch_closes_count[\Carbon\Carbon::now()->subDays(2)->format('m-d')]).reverse()
            },{
                name: '{{\Carbon\Carbon::now()->subDays(1)->format('m-d')}}',
                data: @json(@$branch_closes_count[\Carbon\Carbon::now()->subDays(1)->format('m-d')]).reverse()
            }],
            xaxis: {
                categories: @json($branches_names).reverse(),
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

        var category_products_count = AmCharts.makeChart("category_products_count", {
            "type": "pie",
            "theme": "light",
            "labelsEnabled": false,
            "legend": {
                "position": "right"
            },
            "dataProvider": @json($category_products_count),
            "valueField": "count",
            "titleField": "category",
        });
        var branch_employees_count = AmCharts.makeChart("branch_employees_count", {
            "type": "pie",
            "theme": "light",
            "labelsEnabled": false,
            "legend": {
                "position": "right"
            },
            "dataProvider": @json($branch_employees_count),
            "valueField": "count",
            "titleField": "category",
        });

        $(document).on("change", "#branch_id", function (e) {
            $('#search_form').submit()
        })

    </script>
--}}

@endsection

