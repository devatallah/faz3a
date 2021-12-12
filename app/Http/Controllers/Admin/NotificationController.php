<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\MobileToken;
use App\Models\Notification;
use App\Models\Service;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class NotificationController extends Controller
{
    public function index ()
    {
        return view('admin.notifications.index');
    }

    public function create ()
    {
        return view('admin.notifications.create');
    }

    public function store (Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'message' => 'required|string|max:255',
        ];
        $this->validate($request, $rules);
        $data = $request->only('name', 'message');
        $notification = Notification::query()->create($data);
        $user_ids = $request->user_ids ?? User::query()->select(['id'])->pluck('id')->toArray();
        if ($request->type == 1) {
            TopicNotification($request->name, $request->message);
            $notification->users()->sync($user_ids);
        } elseif ($request->type == 2) {
            $android_token = MobileToken::query()->where('device', 'android')->whereIn('user_id', $user_ids)->pluck('token')->toArray();
            $ios_token = MobileToken::query()->where('device', 'ios')->whereIn('user_id', $user_ids)->pluck('token')->toArray();
            $test1 = fcmNotification($android_token, $request->name, $request->message, $request->message,
                0, 'android');
            $test2 = fcmNotification($ios_token, $request->name, $request->message, $request->message,
                0, 'ios');
            $notification->users()->sync($user_ids);
        }
        if ($request->ajax()) {
            return response()->json(['status' => true]);
        }
        Session::flash('success_message', __('common.item_added'));
        return redirect('admin/service_passengers');
    }

    public function destroy ($id)
    {
        try {
            Notification::query()->whereIn('id', explode(',', $id))->delete();
        } catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
        return response()->json(['status' => true]);
    }

    public function indexTable (Request $request)
    {
        $notifications = Notification::query();
        return Datatables::of($notifications)
            ->filter(function ($query) use ($request) {
                if (!is_null($request->status)) {
                    $query->where('status', $request->status);
                }
            })->addColumn('action', function ($notifications) {

                $string = ' <button type="button" class="btn btn-sm btn-danger delete-btn" data-id="' . $notifications->id .
                    '"><i class="fa fa-trash-o"></i>' . __("common.delete") . '</button>';

                return $string;
            })->make(true);
    }

}
