@extends('admin.layout.app')
@section('title')
    @lang('common.edit') @lang('common.subscription')
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
                    <h3>@lang('common.subscriptions')</h3>
                </div>
                <br>
                <nav class="breadcrumb-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}"><i class="fa fa-lg fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a
                                href="{{url('/admin/subscriptions')}}">@lang('common.subscriptions')</a></li>
                        <li class="breadcrumb-item active">@lang('common.edit') @lang('common.subscription')</li>
                    </ol>
                </nav>
                <br>
                <br>
                <div class="widget-content-area br-4">
                    <div class="widget-one">

                        <div class="widget-content widget-content-area">
                            <form action="{{url(app()->getLocale()."/admin/subscriptions/$subscription->id")}}" id="basic-form"
                                  method="post"
                                  data-reset="false" class="ajax_form form-horizontal" enctype="multipart/form-data"
                                  novalidate>
                                {{csrf_field()}}
                                {{method_field('PUT')}}
                                <div class="form-body">
                                    <div class="row">
                                        <div class="offset-2 col-md-10">
                                            <div class="form-row">
                                                <div class="form-group col-md-5">
                                                    <label for="plan_id" class="col-form-label">
                                                        @lang('common.plan')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <select name="plan_id" id="plan_id">
                                                        @foreach($plans as $plan)
                                                            <option value="{{$plan->id}}" {{$plan->id == $subscription->plan_id ? 'selected' : ''}}>{{$plan->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="price" class="col-form-label">
                                                        @lang('common.price')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <input type="text" class="form-control" id="price"
                                                           name="price" value="{{$subscription->price}}"
                                                           placeholder="@lang('common.price')">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="days" class="col-form-label">
                                                        @lang('common.days')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <input type="text" class="form-control" id="days"
                                                           name="days" value="{{$subscription->days}}"
                                                           placeholder="@lang('common.days')">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="from" class="col-form-label">
                                                        @lang('common.from')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <input type="date" class="form-control" id="from"
                                                           name="from" value="{{$subscription->from}}"
                                                           placeholder="@lang('common.from')">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="to" class="col-form-label">
                                                        @lang('common.to')
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <input type="date" class="form-control" id="to"
                                                           name="to" value="{{$subscription->to}}"
                                                           placeholder="@lang('common.to')">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-body">
                                    <div class="row">
                                        <div class="offset-2 col-md-10">

                                            <button type="submit" class="submit_btn btn btn-primary">
                                                <i class="fa fa-spinner fa-spin" style="display: none;"></i>
                                                @lang('common.save')
                                            </button>
                                            <a href="{{url('/admin/subscriptions')}}" id="cancel_btn" class="btn btn-default">
                                                @lang('common.cancel')
                                            </a>
                                        </div>
                                    </div>
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
