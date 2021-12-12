<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>WishWish</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/admin/'.LaravelLocalization::getCurrentLocaleDirection().'/assets/img/favicon.ico')}}"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="{{asset('assets/admin/'.LaravelLocalization::getCurrentLocaleDirection().'/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/'.LaravelLocalization::getCurrentLocaleDirection().'/assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    {{--    <link rel="stylesheet" href="{{asset('assets/vendor/datatables/datatables.min.css')}}">--}}
    {{--    <link rel="stylesheet" href="{{asset('assets/vendor/datatables/css/dataTables.bootstrap4.min.css')}}">--}}
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/admin/'.LaravelLocalization::getCurrentLocaleDirection().'/plugins/table/datatable/datatables.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/admin/'.LaravelLocalization::getCurrentLocaleDirection().'/assets/css/forms/theme-checkbox-radio.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/admin/'.LaravelLocalization::getCurrentLocaleDirection().'/plugins/table/datatable/dt-global_style.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/admin/'.LaravelLocalization::getCurrentLocaleDirection().'/plugins/table/datatable/custom_dt_custom.css')}}">
    {{--    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/'.LaravelLocalization::getCurrentLocaleDirection().'/plugins/select2/select2.min.css')}}">--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2/dist/css/select2.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/admin/'.LaravelLocalization::getCurrentLocaleDirection().'/assets/css/elements/miscellaneous.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/admin/'.LaravelLocalization::getCurrentLocaleDirection().'/assets/css/elements/breadcrumb.css')}}">
    {{--    <link rel="stylesheet" href="{{asset('assets/admin/'.LaravelLocalization::getCurrentLocaleDirection().'/plugins/font-awesome/css/font-awesome.min.css')}}">--}}
    <script src="https://kit.fontawesome.com/e27bf94107.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastr/build/toastr.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <link href="{{asset('assets/admin/'.LaravelLocalization::getCurrentLocaleDirection().'/assets/css/apps/mailing-chat.css')}}" rel="stylesheet" type="text/css" />

    @yield('css')

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <style>
        .sidebar-wrapper .profile-info .user-info {
            text-align: center;
            padding: 140px 0 0 0 !important;;
            height: 180px !important;
        }        /*
            The below code is for DEMO purpose --- Use it if you are using this demo otherwise, Remove it
        */
        @if(LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
  .navbar .navbar-item.navbar-dropdown {
            margin-right: auto;
        }

        /*
                .datepicker.datepicker-dropdown.dropdown-menu.datepicker-orient-right.datepicker-orient-bottom{
                top: 446.391px;
                !* left: -88px; *!
                z-index: 10;
                display: block;
                width: 195px;
                right: 190px;
                }
        */
        .datepicker {
            direction: rtl;
        }
        .datepicker.dropdown-menu {
            right: initial;
        }
        @else
{{--
  .navbar .navbar-item.navbar-dropdown {
            margin-left: auto;
        }
--}}

        @endif

        .layout-px-spacing {
            min-height: calc(100vh - 145px) !important;
        }

        .select2-container.select2-container--default {
            margin-bottom: 0 !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #444;
            line-height: 45px;
        }

        .select2-selection__arrow {
            margin-top: 8px;
        }

        .select2-container--default .select2-selection--single {
            height: 45px;
        }

        .fileinput-preview.thumbnail {
            width: 200px !important;
            line-height: 145px !important;
            border: 1px solid #6c757d;
        }

        .fileinput .thumbnail > img {
            max-width: 100%;
            max-height: 100%;
        }

        .select2-container {
            width: 100% !important;
        }
        /*
                .datepicker.dropdown-menu {
                    width: 14% !important;
                }
        */

        .paginate_button.page-item .page-link {
            padding: 10px 15px;
        }

        .paginate_button.page-item.previous .page-link {
            padding: 10px 12px;
        }

        .paginate_button.page-item.next .page-link {
            padding: 10px 12px;
        }
        input:disabled, textarea:disabled {
            color: black;
        }

        /*
                .widget-content.widget-content-area{
                    padding-bottom: 0 !important;
                    padding-top: 0 !important;
                }
        */
        /*
                .sidebar-theme #compactSidebar {
                    background: #2B2D42;
                }
                .sidebar-wrapper #compact_submenuSidebar {
                    background: #EDF2F4;
                }
        */
    </style>

    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    @yield('styles')
</head>
<body class="sidebar-noneoverflow">

<!--  BEGIN NAVBAR  -->
<div class="header-container fixed-top">
    <header class="header navbar navbar-expand-sm">

        <ul class="navbar-nav theme-brand flex-row  text-center">
{{--
            <li class="nav-item theme-logo">
                <a href="{{url('admin')}}">
                    <img src="{{asset('22.png')}}" class="navbar-logo" alt="logo">
                </a>
            </li>
--}}
            <li class="nav-item theme-text">
                <a href="{{url('admin')}}" class="nav-link" style="font-size: 20px"> WishWish </a>
            </li>
            <li class="nav-item toggle-sidebar">
                <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3" y2="6"></line><line x1="3" y1="12" x2="3" y2="12"></line><line x1="3" y1="18" x2="3" y2="18"></line></svg></a>
            </li>
        </ul>

        <ul class="navbar-item flex-row navbar-dropdown ml-auto">
            <li class="nav-item dropdown language-dropdown more-dropdown">
                <div class="dropdown  custom-dropdown-icon">
                    <a class="dropdown-toggle btn" href="#" role="button" id="langDropdown" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false"> {{ LaravelLocalization::getCurrentLocaleNative() }}
                        <i class="fa fa-chevron-down"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right animated fadeInUp" aria-labelledby="langDropdown">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <a class="dropdown-item" data-img-value="{{$localeCode}}"
                               data-value="{{ $properties['name'] }}" hreflang="{{ $localeCode }}"
                               href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">{{ $properties['native'] }}</a>
                        @endforeach
                    </div>
                </div>
            </li>

            <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                </a>
                <div class="dropdown-menu position-absolute animated fadeInUp" aria-labelledby="userProfileDropdown">
                    <div class="user-profile-section">
                        <div class="media mx-auto">
                            <img src="{{auth()->user()->image}}" class="img-fluid mr-2">
                            <div class="media-body">
                                <h5>{{auth()->user()->name}}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-item">
                        <a href="{{url('admin/profile')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> <span>@lang('common.profile')</span>
                        </a>
                    </div>
                    <div class="dropdown-item">
                        <a href="#!" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> <span>@lang('common.logout')</span>
                        </a>
                        <form id="logout-form" action="{{ route('admin_logout') }}" method="POST"
                              style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </li>
        </ul>
    </header>
</div>
<!--  END NAVBAR  -->

<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">

    <div class="overlay"></div>
    <div class="search-overlay"></div>

    <!--  BEGIN SIDEBAR  -->
    <div class="sidebar-wrapper sidebar-theme">

        <nav id="sidebar">
            <div class="profile-info">
                {{--                <figure class="user-cover-image"></figure>--}}
                <div class="user-info">
                    <img src="{{auth()->user()->image}}">
                    <h6 class="">{{auth()->user()->email}}</h6>
                </div>
            </div>

            {{--            <div class="shadow-bottom"></div>--}}
            <ul class="list-unstyled menu-categories" id="accordionExample">
                <li class="menu {{explode('/',\Request::path())[2] == 'home' ? 'active' : '' }}">
                    <a href="{{url('admin/home')}}" aria-expanded="{{explode('/',\Request::path())[2] == 'home' ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <i data-feather="home"></i>
                            <span>@lang('common.home')</span>
                        </div>
                    </a>
                </li>
                <li class="menu {{explode('/',\Request::path())[2] == 'services' ? 'active' : '' }}">
                    <a href="{{url('admin/services')}}" aria-expanded="{{explode('/',\Request::path())[2] == 'services' ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <i data-feather="clipboard"></i>
                            <span>@lang('common.services')</span>
                        </div>
                    </a>
                </li>
                <li class="menu {{explode('/',\Request::path())[2] == 'packages' ? 'active' : '' }}">
                    <a href="{{url('admin/packages')}}" aria-expanded="{{explode('/',\Request::path())[2] == 'packages' ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <i data-feather="clipboard"></i>
                            <span>@lang('common.packages')</span>
                        </div>
                    </a>
                </li>
                <li class="menu {{explode('/',\Request::path())[2] == 'trip_types' ? 'active' : '' }}">
                    <a href="{{url('admin/trip_types')}}" aria-expanded="{{explode('/',\Request::path())[2] == 'trip_types' ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <i data-feather="package"></i>
                            <span>@lang('common.trip_types')</span>
                        </div>
                    </a>
                </li>
                <li class="menu {{explode('/',\Request::path())[2] == 'vehicle_types' ? 'active' : '' }}">
                    <a href="{{url('admin/vehicle_types')}}" aria-expanded="{{explode('/',\Request::path())[2] == 'vehicle_types' ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <i data-feather="truck"></i>
                            <span>@lang('common.vehicle_types')</span>
                        </div>
                    </a>
                </li>
                <li class="menu {{explode('/',\Request::path())[2] == 'plans' ? 'active' : '' }}">
                    <a href="{{url('admin/plans')}}" aria-expanded="{{explode('/',\Request::path())[2] == 'plans' ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <i data-feather="copy"></i>
                            <span>@lang('common.plans')</span>
                        </div>
                    </a>
                </li>
                <li class="menu {{explode('/',\Request::path())[2] == 'drivers' ? 'active' : '' }}">
                    <a href="{{url('admin/drivers')}}" aria-expanded="{{explode('/',\Request::path())[2] == 'drivers' ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <i data-feather="users"></i>
                            <span>@lang('common.drivers')</span>
                        </div>
                    </a>
                </li>
                <li class="menu {{explode('/',\Request::path())[2] == 'users' ? 'active' : '' }}">
                    <a href="{{url('admin/users')}}" aria-expanded="{{explode('/',\Request::path())[2] == 'users' ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <i data-feather="user"></i>
                            <span>@lang('common.users')</span>
                        </div>
                    </a>
                </li>
                <li class="menu {{explode('/',\Request::path())[2] == 'subscriptions' ? 'active' : '' }}">
                    <a href="{{url('admin/subscriptions')}}" aria-expanded="{{explode('/',\Request::path())[2] == 'subscriptions' ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <i data-feather="user-check"></i>
                            <span>@lang('common.subscriptions')</span>
                        </div>
                    </a>
                </li>
                <li class="menu {{explode('/',\Request::path())[2] == 'trips' ? 'active' : '' }}">
                    <a href="{{url('admin/trips')}}" aria-expanded="{{explode('/',\Request::path())[2] == 'trips' ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <i data-feather="map-pin"></i>
                            <span>@lang('common.trips')</span>
                        </div>
                    </a>
                </li>
                <li class="menu {{explode('/',\Request::path())[2] == 'admins' ? 'active' : '' }}">
                    <a href="{{url('admin/admins')}}" aria-expanded="{{explode('/',\Request::path())[2] == 'admins' ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <i data-feather="user"></i>
                            <span>@lang('common.admins')</span>
                        </div>
                    </a>
                </li>
            </ul>
        </nav>

    </div>
    <!--  END SIDEBAR  -->

    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <br>
        @yield('content')
        <div class="footer-wrapper">
        </div>
    </div>
    <!--  END CONTENT AREA  -->

</div>
<script
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>
{{--    <script src="{{asset(LaravelLocalization::getCurrentLocaleDirection().'_admin/assets/js/libs/jquery-3.1.1.min.js')}}"></script>--}}
<script src="{{asset('assets/admin/'.LaravelLocalization::getCurrentLocaleDirection().'/bootstrap/js/popper.min.js')}}"></script>
<script
    src="{{asset('assets/admin/'.LaravelLocalization::getCurrentLocaleDirection().'/bootstrap/js/bootstrap.min.js')}}"></script>
<script
    src="{{asset('assets/admin/'.LaravelLocalization::getCurrentLocaleDirection().'/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script
    src="{{asset('assets/admin/'.LaravelLocalization::getCurrentLocaleDirection().'/plugins/font-icons/feather/feather.min.js')}}"></script>
<script src="{{asset('assets/admin/'.LaravelLocalization::getCurrentLocaleDirection().'/assets/js/app.js')}}"></script>
<script>
    $(document).ready(function () {
        App.init();
    });
</script>
<script src="{{asset('assets/admin/'.LaravelLocalization::getCurrentLocaleDirection().'/assets/js/custom.js')}}"></script>

{{--    <script src="{{asset('assets/vendor/datatables/datatables.min.js')}}"></script>--}}
{{--    <script src="{{asset('assets/vendor/datatables/js/dataTables.bootstrap4.min.js')}}"></script>--}}
<script
    src="{{asset('assets/admin/'.LaravelLocalization::getCurrentLocaleDirection().'/plugins/table/datatable/datatables.js')}}"></script>

<script src="{{asset('assets/vendor/dataTables-checkboxes/dataTables-checkboxes.min.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/select2/dist/js/select2.full.min.js"></script>
@if(app()->isLocale('ar'))
    <script src="https://cdn.jsdelivr.net/npm/select2/dist/js/i18n/ar.js"></script>
@endif
{{--<script src="{{asset('assets/admin/'.LaravelLocalization::getCurrentLocaleDirection().'/assets/js/apps/mailbox-chat.js')}}"></script>--}}
{{--<script src="{{asset('assets/admin/'.LaravelLocalization::getCurrentLocaleDirection().'/plugins/select2/select2.min.js')}}"></script>--}}
{{--<script src="{{asset('assets/admin/'.LaravelLocalization::getCurrentLocaleDirection().'/plugins/select2/custom-select2.js')}}"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>

@yield('js')
<script>
    var selectedIds = function () {
        return $("input[name='table_ids[]']:checked").map(function () {
            return this.value;
        }).get();
    };
    $('select').select2({
        dir: '{{LaravelLocalization::getCurrentLocaleDirection()}}',
        placeholder: "@lang('common.select')",
    });
    $(document).ready(function () {
        $(document).on('click', "#export_btn", function (e) {
            e.preventDefault();
            var new_url = url + 'export?' + $('#search_form').serialize()
            window.open(new_url, '_blank');
            console.log(new_url);
            console.log($('#search_form').serialize());

        });


        $("#advance_search_btn").click(function (e) {
            e.preventDefault();
            $('#advance_search_div').toggle(500);
        });
        $(document).on('change', "#select_all", function (e) {
            this.checked ? $(".table_ids").each(function () {
                this.checked = true
            }) : $(".table_ids").each(function () {
                this.checked = false
            })
            $('#delete_btn').attr('data-id', selectedIds().join());
            $('.status_btn').attr('data-id', selectedIds().join());
            if (selectedIds().join().length) {
                $('#delete_btn').prop('disabled', '');
                $('.status_btn').prop('disabled', '');
            } else {
                $('#delete_btn').prop('disabled', 'disabled');
                $('.status_btn').prop('disabled', 'disabled');
            }
        });

        $(document).on('change', ".table_ids", function (e) {
            if ($(".table_ids:checked").length === $(".table_ids").length) {
                $("#select_all").prop("checked", true)
            } else {
                $("#select_all").prop("checked", false)
            }
            $('#delete_btn').attr('data-id', selectedIds().join());
            $('.status_btn').attr('data-id', selectedIds().join());
            console.log(selectedIds().join().length)
            if (selectedIds().join().length) {
                $('#delete_btn').prop('disabled', '');
                $('.status_btn').prop('disabled', '');
            } else {
                $('#delete_btn').prop('disabled', 'disabled');
                $('.status_btn').prop('disabled', 'disabled');
            }
        });
        $('#search_btn').on('click', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#clear_btn').on('click', function (e) {
            e.preventDefault();
            $('#search_form')[0].reset();
            $('select').val("").trigger("change")
            oTable.draw();
        });
        $(document).on("click", ".delete-btn", function (e) {
            e.preventDefault();
            var urls = url + $(this).data('id');
            $.confirm({
                title: '@lang('common.delete_confirmation')',
                content: '@lang('common.confirm_delete')',
                escapeKey: true,
                // autoClose: true,
                closeIcon: true,
                rtl: "{{LaravelLocalization::getCurrentLocaleDirection() == 'rtl'}}",
                buttons: {
                    cancel: {
                        text: '@lang('common.cancel')',
                        btnClass: 'btn-default',
                        action: function () {
                            toastr.info('@lang('common.delete_canceled')')
                        }
                    },
                    confirm: {
                        text: '@lang('common.delete')',
                        btnClass: 'btn-red',
                        action: function () {
                            $.ajax({
                                url: urls,
                                method: 'DELETE',
                                type: 'DELETE',
                                data: {
                                    _token: '{{csrf_token()}}'
                                },
                            }).done(function (data) {
                                if (data.status) {
                                    toastr.success('@lang('common.deleted')');
                                    oTable.draw();
                                } else {
                                    toastr.warning('@lang('common.not_deleted')');
                                }

                            }).fail(function () {
                                toastr.error('@lang('common.something_wrong')');
                            });
                        }
                    }
                }
            });
        });

        $(document).on('submit', '.ajax_form', function (e) {
            // $('.submit_btn').prop('disabled', true);
            e.preventDefault();
            var form = $(this);
            var url = $(this).attr('action');
            var method = $(this).attr('method');
            var reset = $(this).data('reset');
            var Data = new FormData(this);
            $('.submit_btn').attr('disabled', 'disabled');
            $('.fa-spinner.fa-spin').show();
            $.ajax({
                url: url,
                type: method,
                data: Data,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('.invalid-feedback').html('');
                    $('.is-invalid ').removeClass('is-invalid');
                    form.removeClass('was-validated');
                }
            }).done(function (data) {
                if (data.status) {
                    toastr.success('@lang('common.done_successfully')');
                    if (reset === 'true') {
                        form[0].reset();
                    }
                    var url = $('#cancel_btn').attr('href');
                    window.location.replace(url);
                } else {
                    if (data.message) {
                        toastr.error(data.message);
                    } else {
                        toastr.error('@lang('common.something_wrong')');
                    }
                    $('.submit_btn').removeAttr('disabled');
                    $('.fa-spinner.fa-spin').hide();
                }
            }).fail(function (data) {
                if (data.status === 422) {
                    var response = data.responseJSON;
                    $.each(response.errors, function (key, value) {
                        var str = (key.split("."));
                        if (str[1] === '0') {
                            key = str[0] + '[]';
                        }
                        console.log(key);
                        $('[name="' + key + '"], [name="' + key + '[]"]').addClass('is-invalid');
                        $('[name="' + key + '"], [name="' + key + '[]"]').closest('.form-group').find('.invalid-feedback').html(value[0]);
                    });
                } else {
                    toastr.error('@lang('common.something_wrong')');
                }
                $('.submit_btn').removeAttr('disabled');
                $('.fa-spinner.fa-spin').hide();

            });
        });

        $(document).on('click', '.status_btn', function (e) {
            var urls = url + 'update_status';
            var status = $(this).val();
            $.ajax({
                url: urls,
                method: 'PUT',
                type: 'PUT',
                data: {
                    ids: $(this).data('id'),
                    status: status,
                    _token: '{{csrf_token()}}'
                },
                success: function (data) {
                    if (data.status) {
                        toastr.success('@lang('common.done_successfully')');
                        oTable.draw();
                    } else {
                        toastr.error('@lang('common.something_wrong')');
                    }
                }
            });
        });

    });

</script>
<script type="text/javascript">
    feather.replace();
</script>

@yield('scripts')

<!-- END GLOBAL MANDATORY SCRIPTS -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
</body>
</html>
