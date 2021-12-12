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

        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
                <div class="widget-header">
                    <h3>@lang('common.plans')</h3>
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
                <br>
                <br>
                <div class="widget-content-area br-4">
                    <div class="widget-one">

                        <div class="widget-content widget-content-area">
                            <form action="{{url(app()->getLocale()."/admin/trips/$trip->id")}}" id="basic-form" method="post"
                                  data-reset="false" class="ajax_form form-horizontal" enctype="multipart/form-data" novalidate>
                                {{csrf_field()}}
                                {{method_field('PUT')}}
                                <div class="form-body offset-2 col-md-10">
                                    <div class="form-row">
                                        <div class="form-group col-md-5">
                                            <label for="user" class="col-form-label">
                                                @lang('common.user')
                                                <span class="required"> * </span>
                                            </label>
                                            <input disabled type="text" class="form-control" id="user"
                                                   required name="user" value="{{@$trip->user->name}}"
                                                   placeholder="@lang('common.user')">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="driver" class="col-form-label">
                                                @lang('common.driver')
                                                <span class="required"> * </span>
                                            </label>
                                            <input disabled type="text" class="form-control" id="driver"
                                                   required name="driver" value="{{@$trip->driver->name}}"
                                                   placeholder="@lang('common.driver')">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="from_address" class="col-form-label">
                                                @lang('common.from_address')
                                                <span class="required"> * </span>
                                            </label>
                                            <input disabled type="text" class="form-control" id="from_address"
                                                   required name="from_address" value="{{$trip->from_address}}"
                                                   placeholder="@lang('common.from_address')">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="to_address" class="col-form-label">
                                                @lang('common.to_address')
                                                <span class="required"> * </span>
                                            </label>
                                            <input disabled type="text" class="form-control" id="to_address"
                                                   required name="to_address" value="{{$trip->to_address}}"
                                                   placeholder="@lang('common.to_address')">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="status" class="col-form-label">
                                                @lang('common.status')
                                                <span class="required"> * </span>
                                            </label>
                                            <input disabled type="text" class="form-control" id="trip_type"
                                                   required name="status" value="{{@$trip->status}}"
                                                   placeholder="@lang('common.status')">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="trip_type" class="col-form-label">
                                                @lang('common.trip_type')
                                                <span class="required"> * </span>
                                            </label>
                                            <input disabled type="text" class="form-control" id="trip_type"
                                                   required name="trip_type" value="{{@$trip->tripType->name}}"
                                                   placeholder="@lang('common.trip_type')">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="vehicle_type" class="col-form-label">
                                                @lang('common.vehicle_type')
                                                <span class="required"> * </span>
                                            </label>
                                            <input disabled type="text" class="form-control" id="vehicle_type"
                                                   required name="vehicle_type" value="{{@$trip->vehicleType->name}}"
                                                   placeholder="@lang('common.vehicle_type')">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="service" class="col-form-label">
                                                @lang('common.service')
                                                <span class="required"> * </span>
                                            </label>
                                            <input disabled type="text" class="form-control" id="service"
                                                   required name="service" value="{{@$trip->service->name}}"
                                                   placeholder="@lang('common.service')">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="passengers" class="col-form-label">
                                                @lang('common.passengers')
                                                <span class="required"> * </span>
                                            </label>
                                            <input disabled type="text" class="form-control" id="passengers"
                                                   required name="passengers" value="{{$trip->passengers}}"
                                                   placeholder="@lang('common.passengers')">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="package_details" class="col-form-label">
                                                @lang('common.package_details')
                                                <span class="required"> * </span>
                                            </label>
                                            <input disabled type="text" class="form-control" id="package_details"
                                                   required name="package_details" value="{{$trip->package_details}}"
                                                   placeholder="@lang('common.package_details')">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="package_weight" class="col-form-label">
                                                @lang('common.package_weight')
                                                <span class="required"> * </span>
                                            </label>
                                            <input disabled type="text" class="form-control" id="package_weight"
                                                   required name="package_weight" value="{{$trip->package_weight}}"
                                                   placeholder="@lang('common.package_weight')">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="note" class="col-form-label">
                                                @lang('common.note')
                                                <span class="required"> * </span>
                                            </label>
                                            <input disabled type="text" class="form-control" id="note"
                                                   required name="note" value="{{$trip->note}}"
                                                   placeholder="@lang('common.note')">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>

                                    <button type="submit" class="submit_btn btn btn-primary">
                                        <i class="fa fa-spinner fa-spin" style="display: none;"></i>
                                        @lang('common.save')
                                    </button>
                                    <a href="{{url('/admin/trips')}}" id="cancel_btn" class="btn btn-default">
                                        @lang('common.cancel')
                                    </a>
                                </div>
                            </form>
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
@endsection
