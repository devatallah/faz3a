<?php

namespace App\Http\Controllers\Admin;

use App\Driver;
use App\Models\Plan;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class SubscriptionController extends Controller
{
    public function index()
    {
        $drivers = Driver::query()->withTrashed()->get();
        $plans = Plan::query()->withTrashed()->get();
        return view('admin.subscriptions.index', compact('plans', 'drivers'));
    }
    public function edit($id, Request $request)
    {
        $subscription = Subscription::query()->findOrFail($id);
        $plans = Plan::query()->get();
        return view('admin.subscriptions.edit', compact('subscription', 'plans'));
    }

    public function update($id, Request $request)
    {
        $subscription = Subscription::query()->find($id);
        $rules = [
            'plan_id' => 'required',
            'price' => 'required',
            'days' => 'required',
            'from' => 'required|string|date',
            'to' => 'required|string|date',
        ];

        $this->validate($request, $rules);

        $data = $request->only('plan_id',
            'price',
            'days',
            'from',
            'to');

        $subscription->update($data);
        if ($request->ajax()) {
            return response()->json(['status' => true]);
        }
        Session::flash('success_message', __('common.item_edited'));

        return redirect()->back();
    }

    public function indexTable(Request $request)
    {
        $subscriptions = Subscription::query()->orderByDesc('id');
        return Datatables::of($subscriptions)
            ->filter(function ($query) use ($request) {
                if ($request->driver_id){
                    $query->where('driver_id', $request->driver_id);
                }
                if ($request->plan_id){
                    $query->where('plan_id', $request->plan_id);
                }
                if ($request->status == 'active'){
                    $query->where('to', '>', Carbon::now());
                }
                if ($request->status == 'expired'){
                    $query->where('to', '<', Carbon::now());
                }
            })->addColumn('action', function ($subscription) {
                $string = '<a  href="' . url('/admin/subscriptions/' . $subscription->id . '/edit') .
                    '" class="btn btn-sm btn-secondary"><i class="fa fa-lg fa-edit"></i></a>';
                return $string;
            })
            ->make(true);
    }

}
