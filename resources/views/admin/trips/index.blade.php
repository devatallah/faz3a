@extends('admin.layout.app')
@section('title')
    @lang('common.trips')
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
                    <h3>@lang('common.trips')</h3>
                </div>
                <br>
                <nav class="breadcrumb-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('admin')}}"><i class="fa fa-lg fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{url('admin/trips')}}">@lang('common.trips')</a></li>
                    </ol>
                </nav>
                <br>
                <br>
                <div class="widget-content-area br-4">
                    <div class="widget-one">

                        <div class="widget-content widget-content-area">
                            <form id="search_form">
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="s_name">@lang('common.name')</label>
                                        <input type="text" class="form-control" id="s_name"
                                               placeholder="@lang('common.name')">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="s_driver_id">@lang('common.driver')</label>
                                        <select id="s_driver_id">
                                            <option value="">@lang('common.select')</option>
                                        @foreach($drivers as $driver)
                                                <option value="{{$driver->id}}">{{$driver->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
{{--
                                    <div class="form-group col-md-2">
                                        <label for="s_trip_id">@lang('common.driver')</label>
                                        <select id="s_trip_id">
                                            @foreach($trips as $trip)
                                                <option value="{{$trip->id}}">{{$trip->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
--}}
                                    <div class="form-group col-md-3 align-self-end" style="margin-bottom: 20px;">
                                        <input type="submit" id="search_btn"
                                               class="btn btn-info" value="@lang('common.search')">
                                        <input type="submit" id="clear_btn"
                                               class="btn btn-default" value="@lang('common.cancel')">
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive mb-4">
                                <table id="datatable" class="table style-1 datatable table-hover"
                                       style="margin-top: 15px !important;">
                                    <thead>
                                    <tr>
                                        <th class="checkbox-column sorting_disabled" rowspan="1" colspan="1"
                                            style="width: 35px;" aria-label=" Record Id ">
                                            <label
                                                class="new-control new-checkbox checkbox-outline-primary m-auto">
                                                <input id="select_all" type="checkbox"
                                                       class="new-control-input chk-parent select-customers-info">
                                                <span class="new-control-indicator"></span><span
                                                    style="visibility:hidden">&nbsp;</span>
                                            </label></th>
                                        <th>@lang('common.id')</th>
                                        <th>@lang('common.user')</th>
                                        <th>@lang('common.driver')</th>
                                        <th>@lang('common.service')</th>
                                        <th>@lang('common.trip_type')</th>
                                        <th>@lang('common.status')</th>
                                        <th>@lang('common.price')</th>
                                        <th>@lang('common.date')</th>
                                        {{--                                    <th>@lang('common.create_date')</th>--}}
                                                                            <th>@lang('common.actions')</th>
                                    </tr>
                                    </thead>
                                </table>
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
    <script>
        var url = '{{url(app()->getLocale()."/admin/trips")}}/';

        var oTable = $('#datatable').DataTable({
            "oLanguage": {
                @if(app()->isLocale('ar'))
                "sEmptyTable": "ليست هناك بيانات متاحة في الجدول",
                "sLoadingRecords": "جارٍ التحميل...",
                "sProcessing": "جارٍ التحميل...",
                "sLengthMenu": "أظهر _MENU_ مدخلات",
                "sZeroRecords": "لم يعثر على أية سجلات",
                "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
                "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                "sInfoPostFix": "",
                "sSearch": "ابحث:",
                "oAria": {
                    "sSortAscending": ": تفعيل لترتيب العمود تصاعدياً",
                    "sSortDescending": ": تفعيل لترتيب العمود تنازلياً"
                },

                "oPaginate": {
                    "sPrevious": '<i class="fa fa-arrow-right"></i>',
                    "sNext": '<i class="fa fa-arrow-left"></i>'
                },
                @else
                "oPaginate": {
                    "sPrevious": '<i class="fa fa-arrow-left"></i>',
                    "sNext": '<i class="fa fa-arrow-right"></i>'
                },
                @endif// "oPaginate": {"sPrevious": '<-', "sNext": '->'},
            },
            'columnDefs': [
                {
                    "targets": 1,
                    "visible": false
                },
                {
                    'targets': 0,
                    "searchable": false,
                    "orderable": false
                },
            ],
            // dom: 'lrtip',
            "order": [[1, 'asc']],
            processing: true,
            serverSide: true,
            searching: false,
            ajax: {
                url: '{{ url('/admin/trips/indexTable')}}',
                data: function (d) {
                    d.name = $('#s_name').val();
                    d.driver_id = $('#s_driver_id').val();
                    d.trip_id = $('#s_trip_id').val();
                    d.status = $('#s_status').val();
                }
            },
            columns: [
                {
                    "render": function (data, type, full, meta) {
                        return `<td class="checkbox-column sorting_1">
                                    <label class="new-control new-checkbox checkbox-outline-primary  m-auto">
                                        <input type="checkbox" class="table_ids new-control-input child-chk select-customers-info"
                                         name="table_ids[]" value="` + full.id + `"><span class="new-control-indicator"></span>
                                            <span style="visibility:hidden">&nbsp;</span>
                                    </label>
                                </td>`;
                    }
                },

                {data: 'id', name: 'id'},
                {data: 'user_name', name: 'user_id'},
                {data: 'driver_name', name: 'driver_id'},
                {data: 'service_name', name: 'service_id'},
                {data: 'trip_type_name', name: 'trip_type_id'},
                {data: 'status', name: 'status'},
                {data: 'price', name: 'price'},
                {data: 'date', name: 'date'},
            // {data: 'create_date', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false}]
        });
        $(document).ready(function () {
            oTable.on('draw', function () {
                $("#select_all").prop("checked", false)
                $('#delete_btn').prop('disabled', 'disabled');
                $('.status_btn').prop('disabled', 'disabled');
            });


        })
    </script>

@endsection
