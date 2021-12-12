@extends('admin.layout.app')
@section('title')
    @lang('common.edit') @lang('common.plan')
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
                <li class="breadcrumb-item"><a href="{{url('/admin')}}"><i class="fa fa-lg fa-home"></i></a>
                </li>
                <li class="breadcrumb-item"><a
                        href="{{url('/admin/plans')}}">@lang('common.plans')</a></li>
                <li class="breadcrumb-item active">@lang('common.edit') @lang('common.plan')</li>
            </ol>
        </nav>
        <div class="row layout-top-spacing layout-spacing">
            <div class="col-lg-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>@lang('common.edit') @lang('common.plan')</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <form action="{{url(app()->getLocale()."/admin/plans/$plan->id")}}" id="basic-form" method="post"
                              data-reset="false" class="ajax_form form-horizontal" enctype="multipart/form-data" novalidate>
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                            <div class="form-body offset-3 col-md-7">
                                <div class="form-row">
                                    @foreach(locales() as $key => $value)
                                        <div class="form-group col-md-5">
                                            <label for="name_{{$key}}" class="col-form-label">
                                                @lang('common.name') @lang("common.$value")                                                    <span class="required"> * </span>
                                            </label>
                                            <input type="text" class="form-control" id="name_{{$key}}"
                                                   value="{{$plan->getTranslation('name', $key)}}"
                                                   required name="name_{{$key}}"
                                                   placeholder="@lang('common.name') @lang("common.$value")">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    @endforeach
                                        <div class="form-group col-md-5">
                                            <label for="for_passengers" class="col-form-label">
                                                @lang('common.for_passengers')
                                                <span class="required"> * </span>
                                            </label>
                                            <select name="for_passengers" id="for_passengers">
                                                <option selected value="">@lang('common.select')</option>
                                                <option value="1" {{$plan->for_passengers == 1 ? 'selected' : ''}}>@lang('common.yes')</option>
                                                <option value="0" {{$plan->for_passengers == 0 ? 'selected' : ''}}>@lang('common.no')</option>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="for_packages" class="col-form-label">
                                                @lang('common.for_packages')
                                                <span class="required"> * </span>
                                            </label>
                                            <select name="for_packages" id="for_packages">
                                                <option selected value="">@lang('common.select')</option>
                                                <option value="1" {{$plan->for_packages == 1 ? 'selected' : ''}}>@lang('common.yes')</option>
                                                <option value="0" {{$plan->for_packages == 0 ? 'selected' : ''}}>@lang('common.no')</option>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                </div>

                                <button type="submit" class="submit_btn btn btn-primary">
                                    <i class="fa fa-spinner fa-spin" style="display: none;"></i>
                                    @lang('common.save')
                                </button>
                                <a href="{{url('/admin/plans')}}" id="cancel_btn" class="btn btn-default">
                                    @lang('common.cancel')
                                </a>
                            </div>
                        </form>
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


    </script>


@endsection
