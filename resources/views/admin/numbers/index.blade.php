@extends('admin.layout.app')
@section('title')
    @lang('common.numbers')
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
                    <h3>@lang('common.numbers')</h3>
                </div>
                <br>
                <nav class="breadcrumb-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('admin')}}"><i class="fa fa-lg fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{url('admin/numbers')}}">@lang('common.numbers')</a></li>
                    </ol>
                </nav>
                <br>
                <br>
                <div class="widget-content-area br-4">
                    <div class="widget-one">

                        <div class="widget-content widget-content-number">
                            <form id="search_form">
                                <div class="row">

                                    <div class="form-group col-md-2">
                                        <label for="s_number">@lang('common.number')</label>
                                        <input class="form-control" id="s_number" type="text"
                                               placeholder="@lang('common.number')">
                                    </div>
                                    <div class="form-group col-md-3 align-self-end" style="margin-bottom: 20px;">
                                        <input type="submit" id="search_btn"
                                               class="btn btn-info" value="@lang('common.search')">
                                        <input type="submit" id="clear_btn"
                                               class="btn btn-default" value="@lang('common.cancel')">
                                    </div>

                                </div>
                            </form>
                            <div class="form-group" style="text-align: end">
                                {{--                            @if(auth()->user()->hasAnyPermission(['add_numbers']))--}}
                                <a href="{{url('admin/numbers/create')}}" id="info" class="btn btn-primary"><i
                                        class="fa fa-plus"></i> @lang('common.add')</a>
                                {{--                            @endif--}}
                                {{--                            @if(auth()->user()->hasAnyPermission(['delete_numbers']))--}}
                                <button disabled="disabled" id="delete_btn" class="delete-btn btn btn-danger"><i
                                        class="fa fa-lg fa-trash-o"></i> @lang('common.delete')</button>
                                {{--                            @endif--}}
                            </div>
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
                                        <th>@lang('common.number')</th>
                                        <th>@lang('common.price')</th>
                                        <th>@lang('common.order')</th>
                                        <th>@lang('common.create_date')</th>
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

        var url = '{{url(app()->getLocale()."/admin/numbers")}}/';


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
            "order": [[1, 'desc']],
            processing: true,
            serverSide: true,
            searching: false,
            ajax: {
                url: '{{ url('/admin/numbers/indexTable')}}',
                data: function (d) {
                    d.number = $('#s_number').val();
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
                {data: 'number', name: 'number'},
                {data: 'price', name: 'price'},
                {data: 'order', name: 'order'},
                {data: 'create_date', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
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
