<?php

namespace App\Http\Controllers\Admin;

use App\Driver;
use App\Models\Plan;
use App\Models\Trip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class TripController extends Controller
{
    public function index()
    {
        $drivers = Driver::query()->withTrashed()->get();
        $plans = Plan::query()->withTrashed()->get();
        return view('admin.trips.index', compact('plans', 'drivers'));
    }
    public function show($id, Request $request)
    {
        $trip = Trip::query()->find($id);
        return view('admin.trips.show', compact('trip'));
    }

    public function indexTable(Request $request)
    {
        $trips = Trip::query()->orderByDesc('id');
        return Datatables::of($trips)
            ->filter(function ($query) use ($request) {
                if ($request->driver_id){
                    dd(33);
                    $query->where('driver_id', $request->driver_id);
                }
                if ($request->user_id){
                    dd(32);
                    $query->where('user_id', $request->user_id);
                }
                if ($request->service_id){
                    dd(31);
                    $query->where('service_id', $request->service_id);
                }
            })->addColumn('action', function ($trip) {
                $string = '';
                $string .= '<a  href="' . url('/admin/trips/' . $trip->id ) . '" class="btn btn-sm btn-info">
                    <i class="fa fa-eye"></i>' . __("common.show") . '</a>';
                $string .= ' <a  href="' . url('/admin/chat?driver_id='. $trip->driver_id.'&user_id='.$trip->user_id) .
                    '" class="btn btn-sm btn-info"><i class="fa fa-lg fa-send"></i></a>';
                return $string;
            })
            ->make(true);
    }

}
