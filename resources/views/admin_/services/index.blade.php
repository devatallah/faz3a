@extends('admin.layout.app')
@section('title')
    @lang('common.plans')
@endsection
@section('css')
@endsection
@section('styles')
@endsection
@section('content')
    <div class="layout-px-spacing">
        <div class="page-header">
            <div class="page-title">
                <h3>@lang('common.plans')</h3>
            </div>
        </div>
        <br>
        <nav class="breadcrumb-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('admin')}}"><i class="fa fa-lg fa-home"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="{{url('admin/plans')}}">@lang('common.plans')</a></li>
            </ol>
        </nav>
        <div class="row layout-top-spacing layout-spacing">
            <div class="col-lg-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>@lang('common.plans')</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <form id="search_form">
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="s_name">@lang('common.name')</label>
                                    <input type="text" class="form-control" id="s_name"
                                           placeholder="@lang('common.name')">
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
{{--                            @if(auth()->user()->hasAnyPermission(['add_plans']))--}}
                                <a href="{{url('admin/plans/create')}}" id="info" class="btn btn-primary"><i
                                        class="fa fa-plus"></i> @lang('common.add')</a>
{{--                            @endif--}}
{{--                            @if(auth()->user()->hasAnyPermission(['delete_plans']))--}}
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
                                    <th>@lang('common.name')</th>
                                    <th>@lang('common.for_passengers')</th>
                                    <th>@lang('common.for_packages')</th>
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
@endsection
@section('js')

@endsection
@section('scripts')
    <script>
        var url = '{{url(app()->getLocale()."/admin/plans")}}/';

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
                url: '{{ url('/admin/plans/indexTable')}}',
                data: function (d) {
                    d.name = $('#s_name').val();
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
                {data: 'plan_name', name: 'name'},
                {data: 'for_passengers', name: 'for_passengers'},
                {data: 'for_packages', name: 'for_packages'},
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
