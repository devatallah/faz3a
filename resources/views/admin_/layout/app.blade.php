<!DOCTYPE html>
<html lang="en" dir="{{LaravelLocalization::getCurrentLocaleDirection()}}">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon"
          href="{{asset(LaravelLocalization::getCurrentLocaleDirection().'_admin/assets/img/favicon.ico')}}"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link
        href="{{asset(LaravelLocalization::getCurrentLocaleDirection().'_admin/bootstrap/css/bootstrap.min.css')}}"
        rel="stylesheet" type="text/css"/>
    <link href="{{asset(LaravelLocalization::getCurrentLocaleDirection().'_admin/assets/css/plugins.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{asset(LaravelLocalization::getCurrentLocaleDirection().'_admin/assets/css/color-pallet.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{asset(LaravelLocalization::getCurrentLocaleDirection().'_admin/assets/css/structure.css')}}"
          rel="stylesheet" type="text/css" class="structure"/>
    <link href="{{asset(LaravelLocalization::getCurrentLocaleDirection().'_admin/assets/css/structure.css')}}"
          rel="stylesheet" type="text/css" class="structure"/>
    <!-- END GLOBAL MANDATORY STYLES -->

    {{--    <link rel="stylesheet" href="{{asset('assets/vendor/datatables/datatables.min.css')}}">--}}
    {{--    <link rel="stylesheet" href="{{asset('assets/vendor/datatables/css/dataTables.bootstrap4.min.css')}}">--}}
    <link rel="stylesheet" type="text/css"
          href="{{asset(LaravelLocalization::getCurrentLocaleDirection().'_admin/plugins/table/datatable/datatables.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset(LaravelLocalization::getCurrentLocaleDirection().'_admin/assets/css/forms/theme-checkbox-radio.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset(LaravelLocalization::getCurrentLocaleDirection().'_admin/plugins/table/datatable/dt-global_style.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset(LaravelLocalization::getCurrentLocaleDirection().'_admin/plugins/table/datatable/custom_dt_custom.css')}}">
    {{--    <link rel="stylesheet" type="text/css" href="{{asset(LaravelLocalization::getCurrentLocaleDirection().'_admin/plugins/select2/select2.min.css')}}">--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2/dist/css/select2.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset(LaravelLocalization::getCurrentLocaleDirection().'_admin/assets/css/elements/miscellaneous.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset(LaravelLocalization::getCurrentLocaleDirection().'_admin/assets/css/elements/breadcrumb.css')}}">
    {{--    <link rel="stylesheet" href="{{asset(LaravelLocalization::getCurrentLocaleDirection().'_admin/plugins/font-awesome/css/font-awesome.min.css')}}">--}}
    <script src="https://kit.fontawesome.com/e27bf94107.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastr/build/toastr.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <link href="{{asset(LaravelLocalization::getCurrentLocaleDirection().'_admin/assets/css/apps/mailing-chat.css')}}" rel="stylesheet" type="text/css" />
    @yield('css')

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <style>
        /*
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
  .navbar .navbar-item.navbar-dropdown {
            margin-left: auto;
        }

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
<body class="sidebar-noneoverflow starterkit" style="letter-spacing:normal !important">

<!--  BEGIN NAVBAR  -->
<div class="header-container fixed-top">
    <header class="header navbar navbar-expand-sm">
        <ul class="navbar-item flex-row">
            <li class="nav-item theme-logo">
                <a href="{{url('/admin')}}">
                    <img src="{{asset('assets/images/logo.png')}}" class="navbar-logo" alt="logo">
                </a>
            </li>
        </ul>

        <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="feather feather-list">
                <line x1="8" y1="6" x2="21" y2="6"></line>
                <line x1="8" y1="12" x2="21" y2="12"></line>
                <line x1="8" y1="18" x2="21" y2="18"></line>
                <line x1="3" y1="6" x2="3" y2="6"></line>
                <line x1="3" y1="12" x2="3" y2="12"></line>
                <line x1="3" y1="18" x2="3" y2="18"></line>
            </svg>
        </a>

        <ul class="navbar-item flex-row navbar-dropdown">
            <li class="nav-item dropdown language-dropdown more-dropdown">
                <div class="dropdown  custom-dropdown-icon">
                    <a class="dropdown-toggle btn" href="#" role="button" id="customDropdown" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false"> {{ LaravelLocalization::getCurrentLocaleNative() }}
                        <i class="fa fa-chevron-down"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right animated fadeInUp" aria-labelledby="customDropdown">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <a class="dropdown-item" data-img-value="{{$localeCode}}"
                               data-value="{{ $properties['name'] }}" hreflang="{{ $localeCode }}"
                               href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">{{ $properties['native'] }}</a>
                        @endforeach
                    </div>
                </div>
            </li>

{{--
            @if(auth()->id() == 1)
                @php($complaints = \App\Models\Complaint::query()->where('opened_by', '<>', 1)->where('is_read', 0)->get())
                <li class="nav-item dropdown notification-dropdown">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="notificationDropdown"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-bell">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>@if($complaints->count()) <span class="badge badge-success"></span>@endif
                    </a>
                    <div class="dropdown-menu position-absolute animated fadeInUp"
                         aria-labelledby="notificationDropdown">
                        <div class="notification-scroll">

                            @foreach($complaints as $complaint)
                                <div class="dropdown-item">
                                    <a href="{{url("admin/complaints/$complaint->id/edit")}}">
                                        <div class="media server-log">
                                            <div class="media-body">
                                                <div class="data-info">
                                                    <h6 class="">{{$complaint->complaint}}</h6>
                                                    <p class="">{{$complaint->create_date}}</p>
                                                </div>

                                                <div class="icon-status">
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </li>
            @endif
--}}
            <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{auth()->user()->image}}" alt="admin-profile" class="img-fluid">
                </a>
                <div class="dropdown-menu position-absolute animated fadeInUp" aria-labelledby="userProfileDropdown">
                    <div class="user-profile-section">
                        <div class="media mx-auto">
                            <img src="{{auth()->user()->image}}" class="img-fluid mr-2" alt="avatar">
                            <div class="media-body">
                                <h5>Alan Green</h5>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-item">
                        <a href="{{url('admin/profile')}}">
                            <i class="fa fa-user fa-lg" style="color: #c5c0d8"></i><span> @lang('common.profile')</span>
                        </a>
                        <a href="" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();"><i
                                class="fa fa-sign-out fa-lg"
                                style="color: #c5c0d8"></i><span> @lang('common.logout')</span>
                        </a>
                    </div>
                    <form id="logout-form" action="{{ route('admin_logout') }}" method="POST"
                          style="display: none;">
                        {{ csrf_field() }}
                    </form>

                </div>
            </li>
        </ul>
    </header>
</div>    <!--  END NAVBAR  -->

<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">

    <div class="overlay"></div>
    <div class="search-overlay"></div>

    <!--  BEGIN SIDEBAR  -->
    <div class="sidebar-wrapper sidebar-theme">

        <nav id="compactSidebar">
            <ul class="menu-categories">
                <li class="menu">
                    <a href="#dashboard" data-active="true" class="menu-toggle">
                        <div class="base-menu">
                            <div class="base-icons">
                                <i data-feather="home"></i>
                            </div>
                            <span>@lang('common.dashboard')</span>
                        </div>
                    </a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-chevron-left">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </li>
                <li class="menu {{in_array(@(explode('/',\Request::path())[2]),
                     ['areas', 'branches', 'categories', 'products', 'allowances', 'decorations', 'job_titles']) ? 'active' : '' }}">
                    <a href="#configs" data-active="true" class="menu-toggle">
                        <div class="base-menu">
                            <div class="base-icons">
                                <i data-feather="settings"></i>
                                {{--                                <i class="fa fa-cog fa-3x" style="color: white"></i>--}}
                            </div>
                            <span>@lang('common.configs')</span>
                        </div>
                    </a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-chevron-left">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </li>
                <li class="menu {{in_array(@(explode('/',\Request::path())[2]),
                     ['contracts', 'meetings']) ? 'active' : '' }}">
                    <a href="#meetings_contracts" data-active="true" class="menu-toggle">
                        <div class="base-menu">
                            <div class="base-icons">
                                <i data-feather="briefcase"></i>
                            </div>
                            <span
                                style="font-size: 13px">@lang('common.meetings') @lang('common.and') @lang('common.contracts')</span>
                        </div>
                    </a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-chevron-left">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </li>
                <li class="menu {{in_array(@(explode('/',\Request::path())[2]),
                     ['ratings', 'complaints']) ? 'active' : '' }}">
                    <a href="#quality_control" data-active="true" class="menu-toggle">
                        <div class="base-menu">
                            <div class="base-icons">
                                <i data-feather="clipboard"></i>
                            </div>
                            <span>@lang('common.quality_control')</span>
                        </div>
                    </a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-chevron-left">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </li>
                <li class="menu {{in_array(@(explode('/',\Request::path())[2]),
                     ['invoices', 'transfers']) ? 'active' : '' }}">
                    <a href="#financial_affairs" data-active="true" class="menu-toggle">
                        <div class="base-menu">
                            <div class="base-icons">
                                <i data-feather="dollar-sign"></i>
                            </div>
                            <span>@lang('common.financial_affairs')</span>
                        </div>
                    </a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-chevron-left">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </li>
                <li class="menu {{in_array(@(explode('/',\Request::path())[2]),
                     ['employees', 'salaries']) ? 'active' : '' }}">
                    <a href="#employees_affairs" data-active="true" class="menu-toggle">
                        <div class="base-menu">
                            <div class="base-icons">
                                <i data-feather="users"></i>
                            </div>
                            <span>@lang('common.employees_affairs')</span>
                        </div>
                    </a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-chevron-left">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </li>
                <li class="menu {{in_array(@(explode('/',\Request::path())[2]),
                     ['employees', 'salaries']) ? 'active' : '' }}">
                    <a href="#archive" data-active="true" class="menu-toggle">
                        <div class="base-menu">
                            <div class="base-icons">
                                <i data-feather="archive"></i>
                            </div>
                            <span>@lang('common.other_services')</span>
                        </div>
                    </a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-chevron-left">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </li>
            </ul>
        </nav>

        <div id="compact_submenuSidebar" class="submenu-sidebar">

            <div class="submenu" id="dashboard">
                <ul class="submenu-list" data-parent-element="#dashboard">
                    <li class="{{@(explode('/',\Request::path())[2]) == 'dashboard' ? 'active' : '' }}">
                        <a href="{{url('admin')}}">
                            <i data-feather="grid"></i>
                            @lang('common.dashboard')
                        </a>
                    </li>
                </ul>
            </div>
            <div class="submenu" id="configs">
                <ul class="submenu-list" data-parent-element="#configs">
                        <li class="{{@(explode('/',\Request::path())[2]) == 'areas' ? 'active' : '' }}">
                            <a href="{{url('admin/areas')}}">
                                <i data-feather="map-pin"></i>
                                @lang('common.areas')
                            </a>
                        </li>
                        <li class="{{@(explode('/',\Request::path())[2]) == 'branches' ? 'active' : '' }}">
                            <a href="{{url('admin/branches')}}">
                                <i data-feather="git-pull-request"></i>
                                @lang('common.branches')
                            </a>
                        </li>
                        <li class="{{@(explode('/',\Request::path())[2]) == 'categories' ? 'active' : '' }}">
                            <a href="{{url('admin/categories')}}">
                                <i data-feather="box"></i>
                                @lang('common.categories')
                            </a>
                        </li>
                        <li class="{{@(explode('/',\Request::path())[2]) == 'products' ? 'active' : '' }}">
                            <a href="{{url('admin/products')}}">
                                <i data-feather="coffee"></i>
                                @lang('common.products')
                            </a>
                        </li>
                        <li class="{{@(explode('/',\Request::path())[2]) == 'allowances' ? 'active' : '' }}">
                            <a href="{{url('admin/allowances')}}">
                                <i data-feather="grid"></i>
                                @lang('common.allowances')
                            </a>
                        </li>
                        <li class="{{@(explode('/',\Request::path())[2]) == 'decorations' ? 'active' : '' }}">
                            <a href="{{url('admin/decorations')}}">
                                <i data-feather="award"></i>
                                @lang('common.decorations')
                            </a>
                        </li>
                        <li class="{{@(explode('/',\Request::path())[2]) == 'job_titles' ? 'active' : '' }}">
                            <a href="{{url('admin/job_titles')}}">
                                <i data-feather="grid"></i>
                                @lang('common.job_titles')
                            </a>
                        </li>
                </ul>
            </div>
            <div class="submenu" id="meetings_contracts">
                <ul class="submenu-list" data-parent-element="#meetings_contracts">
                    @if(auth()->user()->hasAnyPermission(['add_meetings', 'edit_meetings', 'delete_meetings', 'show_meetings']))
                        <li class="{{@(explode('/',\Request::path())[2]) == 'meetings' ? 'active' : '' }}">
                            <a href="{{url('admin/meetings')}}">
                                <i data-feather="briefcase"></i>
                                @lang('common.meetings')
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->hasAnyPermission(['add_contracts', 'edit_contracts', 'delete_contracts', 'show_contracts']))
                        <li class="{{@(explode('/',\Request::path())[2]) == 'contracts' ? 'active' : '' }}">
                            <a href="{{url('admin/contracts')}}">
                                <i data-feather="file-text"></i>
                                @lang('common.contracts')
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="submenu" id="quality_control">
                <ul class="submenu-list" data-parent-element="#quality_control">
                    @if(auth()->user()->hasAnyPermission(['add_ratings', 'edit_ratings', 'delete_ratings', 'show_ratings']))
                        <li class="{{@(explode('/',\Request::path())[2]) == 'ratings' ? 'active' : '' }}">
                            <a href="{{url('admin/ratings')}}">
                                <i data-feather="star"></i>
                                @lang('common.ratings')
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->hasAnyPermission(['add_complaints', 'edit_complaints', 'delete_complaints', 'show_complaints']))
                        <li class="{{@(explode('/',\Request::path())[2]) == 'complaints' ? 'active' : '' }}">
                            <a href="{{url('admin/complaints')}}">
                                <i data-feather="alert-triangle"></i>
                                @lang('common.complaints')
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="submenu" id="financial_affairs">
                <ul class="submenu-list" data-parent-element="#financial_affairs">
                    @if(auth()->user()->hasAnyPermission(['add_invoices', 'edit_invoices', 'delete_invoices', 'show_invoices']))
                        <li class="{{@(explode('/',\Request::path())[2]) == 'invoices' ? 'active' : '' }}">
                            <a href="{{url('admin/invoices')}}">
                                <i data-feather="layers"></i>
                                @lang('common.invoices')
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->hasAnyPermission(['add_transfers', 'edit_transfers', 'delete_transfers', 'show_transfers']))
                        <li class="{{@(explode('/',\Request::path())[2]) == 'transfers' ? 'active' : '' }}">
                            <a href="{{url('admin/transfers')}}">
                                <i data-feather="shuffle"></i>
                                @lang('common.transfers')
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->hasAnyPermission(['add_closes', 'edit_closes', 'delete_closes', 'show_closes']))
                        <li class="{{@(explode('/',\Request::path())[2]) == 'closes' ? 'active' : '' }}">
                            <a href="{{url('admin/closes')}}">
                                <i data-feather="grid"></i>
                                @lang('common.closes')
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="submenu" id="employees_affairs">
                <ul class="submenu-list" data-parent-element="#employees_affairs">
                    @if(auth()->user()->hasAnyPermission(['add_employees', 'edit_employees', 'delete_employees', 'show_employees']))
                        <li class="{{@(explode('/',\Request::path())[2]) == 'employees' ? 'active' : '' }}">
                            <a href="{{url('admin/employees')}}">
                                <i data-feather="users"></i>
                                @lang('common.employees')
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->hasAnyPermission(['add_salaries', 'edit_salaries', 'delete_salaries', 'show_salaries']))
                        <li class="{{@(explode('/',\Request::path())[2]) == 'salaries' ? 'active' : '' }}">
                            <a href="{{url('admin/salaries')}}">
                                <i data-feather="dollar-sign"></i>
                                @lang('common.salaries')
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="submenu" id="archive">
                <ul class="submenu-list" data-parent-element="#archive">
                    @if(auth()->user()->hasAnyPermission(['add_campaigns', 'edit_campaigns', 'delete_campaigns', 'show_campaigns']))
                        <li class="{{@(explode('/',\Request::path())[2]) == 'campaigns' ? 'active' : '' }}">
                            <a href="{{url('admin/campaigns')}}">
                                <i data-feather="trending-up"></i>
                                @lang('common.campaigns')
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->hasAnyPermission(['add_maintenances', 'edit_maintenances', 'delete_maintenances', 'show_maintenances']))
                        <li class="{{@(explode('/',\Request::path())[2]) == 'maintenances' ? 'active' : '' }}">
                            <a href="{{url('admin/maintenances')}}">
                                <i data-feather="zap"></i>
                                @lang('common.maintenances')
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->hasAnyPermission(['add_suppliers', 'edit_suppliers', 'delete_suppliers', 'show_suppliers']))
                        <li class="{{@(explode('/',\Request::path())[2]) == 'suppliers' ? 'active' : '' }}">
                            <a href="{{url('admin/suppliers')}}">
                                <i data-feather="truck"></i>
                                @lang('common.suppliers')
                            </a>
                        </li>
                    @endif
                </ul>
            </div>

        </div>

    </div>
    <!--  END SIDEBAR  -->

    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
    @yield('content')


    <!-- CONTENT AREA -->


        <!-- CONTENT AREA -->

        <div class="footer-wrapper">
{{--
            <div class="footer-section f-section-1">
                <p class="">Copyright © 2020 <a target="_blank" href="https://designreset.com">DesignReset</a>, All
                    rights reserved.</p>
            </div>
            <div class="footer-section f-section-2">
                <p class="">Coded with
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-heart">
                        <path
                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                    </svg>
                </p>
            </div>
--}}
        </div>
    </div>
    <!--  END CONTENT AREA  -->

</div>
<!-- END MAIN CONTAINER -->

<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>
{{--    <script src="{{asset(LaravelLocalization::getCurrentLocaleDirection().'_admin/assets/js/libs/jquery-3.1.1.min.js')}}"></script>--}}
<script src="{{asset(LaravelLocalization::getCurrentLocaleDirection().'_admin/bootstrap/js/popper.min.js')}}"></script>
<script
    src="{{asset(LaravelLocalization::getCurrentLocaleDirection().'_admin/bootstrap/js/bootstrap.min.js')}}"></script>
<script
    src="{{asset(LaravelLocalization::getCurrentLocaleDirection().'_admin/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script
    src="{{asset(LaravelLocalization::getCurrentLocaleDirection().'_admin/plugins/font-icons/feather/feather.min.js')}}"></script>
<script src="{{asset(LaravelLocalization::getCurrentLocaleDirection().'_admin/assets/js/app.js')}}"></script>
<script src="{{asset(LaravelLocalization::getCurrentLocaleDirection().'_admin/assets/js/custom.js')}}"></script>

{{--    <script src="{{asset('assets/vendor/datatables/datatables.min.js')}}"></script>--}}
{{--    <script src="{{asset('assets/vendor/datatables/js/dataTables.bootstrap4.min.js')}}"></script>--}}
<script
    src="{{asset(LaravelLocalization::getCurrentLocaleDirection().'_admin/plugins/table/datatable/datatables.js')}}"></script>

<script src="{{asset('assets/vendor/dataTables-checkboxes/dataTables-checkboxes.min.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/select2/dist/js/select2.full.min.js"></script>
@if(app()->isLocale('ar'))
    <script src="https://cdn.jsdelivr.net/npm/select2/dist/js/i18n/ar.js"></script>
@endif
{{--<script src="{{asset(LaravelLocalization::getCurrentLocaleDirection().'_admin/plugins/select2/select2.min.js')}}"></script>--}}
{{--<script src="{{asset(LaravelLocalization::getCurrentLocaleDirection().'_admin/plugins/select2/custom-select2.js')}}"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
<script src="{{asset(LaravelLocalization::getCurrentLocaleDirection().'_admin/assets/js/apps/mailbox-chat.js')}}"></script>

<script>
    $(document).ready(function () {
        App.init();
    });
</script>
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
