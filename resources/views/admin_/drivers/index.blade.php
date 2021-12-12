@extends('admin.layout.app')
@section('title')
    @lang('common.drivers')
@endsection
@section('css')
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
                <li class="breadcrumb-item"><a href="{{url('admin')}}"><i class="fa fa-lg fa-home"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="{{url('admin/drivers')}}">@lang('common.drivers')</a></li>
            </ol>
        </nav>
        <div class="row layout-top-spacing layout-spacing">
            <div class="col-lg-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h3>@lang('common.drivers')</h3>
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
                                <div class="form-group col-md-2" style="padding-top: 35px;">
                                    <a id="advance_search_btn" style="font-weight: bold; cursor: pointer">@lang('common.advance_search')</a>
                                </div>
                            </div>

                            <div class="form-row" id="advance_search_div" style="display: none">
                                <div class="form-group col-md-2">
                                    <label for="s_number">@lang('common.number')</label>
                                    <input type="text" class="form-control" id="s_number"
                                           placeholder="@lang('common.number')">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="s_mobile">@lang('common.mobile')</label>
                                    <input type="text" class="form-control" id="s_mobile"
                                           placeholder="@lang('common.mobile')">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="s_job_title_id">@lang('common.job_title')</label>
                                    <select class="form-control" id="s_job_title_id" >
                                        <option value="">@lang('common.select')</option>
                                        @foreach($job_titles as $job_title)
                                            <option value="{{$job_title->id}}">{{$job_title->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="s_branch_id">@lang('common.branch')</label>
                                    <select class="form-control" id="s_branch_id" >
                                        <option selected value="">@lang('common.select')</option>
                                        <optgroup label="Admin">
                                            <option value="0">@lang('common.admin')</option>
                                        </optgroup>
                                        <optgroup label="Branches">
                                            @foreach($branches as $branch)
                                                <option value="{{$branch->id}}">{{$branch->name}}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="s_status">@lang('common.status')</label>
                                    <select class="form-control" id="s_status" >
                                        <option value="">@lang('common.select')</option>
                                        <option value="1">@lang('common.active')</option>
                                        <option value="0">@lang('common.inactive')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <input type="submit" id="search_btn"
                                       class="btn btn-info" value="@lang('common.search')">
                                <input type="submit" id="clear_btn"
                                       class="btn btn-default" value="@lang('common.cancel')">
                            </div>
                        </form>
                        <div class="form-group" style="text-align: end">
                            @if(auth()->user()->hasAnyPermission(['add_drivers']))
                                <a href="{{url('admin/drivers/create')}}" id="info" class="btn btn-primary"><i
                                        class="fa fa-plus"></i> @lang('common.add')</a>
                            @endif
                            @if(auth()->user()->hasAnyPermission(['delete_drivers']))
                                <button disabled="disabled" id="delete_btn" class="delete-btn btn btn-danger"><i
                                        class="fa fa-lg fa-trash-o"></i> @lang('common.delete')</button>
                            @endif
                                <a id="export_btn" class="btn btn-warning">@lang('common.export')</a>
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
                                                style="visibility:hidden">c</span>
                                        </label></th>
                                    <th>@lang('common.id')</th>
                                    <th>@lang('common.name')</th>
                                    <th>@lang('common.number')</th>
                                    <th>@lang('common.branch')</th>
                                    <th>@lang('common.job_title')</th>
                                    <th>@lang('common.mobile')</th>
                                    <th>@lang('common.status')</th>
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
@endsection
@section('js')

@endsection
@section('scripts')
    <script>
        var url = '{{url(app()->getLocale()."/admin/drivers")}}/';

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
                url: '{{ url('/admin/drivers/indexTable')}}',
                data: function (d) {
                    d.branch_id = $('#s_branch_id').val();
                    d.job_title_id = $('#s_job_title_id').val();
                    d.name = $('#s_name').val();
                    d.number = $('#s_number').val();
                    d.mobile = $('#s_mobile').val();
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
                {data: 'name', name: 'name'},
                {data: 'number', name: 'number'},
                {data: 'branch_name', name: 'branch_id'},
                {data: 'job_title_name', name: 'job_title_id'},
                {data: 'mobile', name: 'mobile'},
                {data: 'status_text', name: 'status'},
                {data: 'create_date', name: 'create_date'},
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
