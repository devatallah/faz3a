<?php

namespace App\Http\Controllers\Merchant;

use App\Models\ContactMessage;
use App\Models\Country;
use App\Models\Order;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function orders()
    {
        $countries = Country::query()->with('cities')->get();
        $payment_methods = PaymentMethod::query()->get();
        return view('merchant.orders.index', compact('countries', 'payment_methods'));
    }
    public function orderItems()
    {
        return view('merchant.orders.order_items');
    }

    public function updateStatus (Request $request)
    {
        $rules = [
            'ids' => 'required',
            'status' => 'required|in:0,1',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false]);
        }
        try {
            Order::query()->whereIn('id', explode(',', $request->ids))->update(['status' => $request->status]);
        } catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
        return response()->json(['status' => true]);
    }
    public function ordersTable(Request $request)
    {
        $orders = Order::query()->whereHas('product', function ($q){
            $q->where('merchant_id', auth()->id());
        })/*->groupBy('order_no')
            ->select('*',
                DB::raw('sum(total) as order_total'))*/;
        return Datatables::of($orders)
            ->filter(function ($query) use ($request) {
                if ($request->user_id) {
                    $query->where('user_id', $request->user_id);
                }
                if ($request->country_id) {
                    $query->where('country_id', $request->country_id);
                }
                if ($request->city_id) {
                    $query->where('city_id', $request->city_id);
                }
                if ($request->status) {
                    $query->where('status', $request->status);
                }
                if ($request->payment_method_id) {
                    $query->where('payment_method_id', $request->payment_method_id);
                }
                if ($request->order_no) {
                    $query->where('order_no', 'like', "%$request->order_no%");
                }
                if ($request->from_date && $request->to_date) {
                    $query->whereBetween('created_at', [$request->from_date.' 00:00:00', $request->to_date.' 23:59:59']);
                }
            })->addColumn('action', function ($order) {
                $string = '<a  href="' . url('/merchant/products/' . $order->product_id.'/edit') . '" class="btn btn-sm btn-info">
                        <i class=""></i> ' . __("common.product") . '</a>';
                $string .= ' <a  href="' . url('/merchant/users/' . $order->user_id.'/edit') . '" class="btn btn-sm btn-info">
                        <i class=""></i> ' . __("common.user") . '</a>';
                return $string;
            })
            ->make(true);
    }
    public function orderItemsTable(Request $request)
    {
        $orders = Order::query()->whereHas('product', function ($q){
            $q->where('merchant_id', auth()->id());
        });
        if ($request->order_no){
            $orders->where('order_no', $request->order_no);
        }
        return Datatables::of($orders)
            ->filter(function ($query) use ($request) {

            })->addColumn('action', function ($order) {
                    $string = '<a  href="' . url('/merchant/products/' . $order->product_id.'/edit') . '" class="btn btn-sm btn-info">
                        <i class="fa fa-eye"></i> ' . __("common.product") . '</a>';
                return $string;
            })
            ->make(true);
    }

}
