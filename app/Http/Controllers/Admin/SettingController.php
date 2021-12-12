<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ad;
use App\Models\ImageTool;
use App\Models\Sett;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SettingController extends Controller
{


    public function edit(Request $request)
    {
        $setting = Setting::query()->firstOrFail();
        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::query()->firstOrFail();
        $rules = [
            'logo' => 'nullable|image',
            'email' => 'required|email',
            'mobile' => 'required|digits_between:8,14',
            'facebook' => 'required|string|url',
            'twitter' => 'required|string|url',
            'instagram' => 'required|string|url',
            'apple_store' => 'required|string|url',
            'google_store' => 'required|string|url',
            'lat' => 'required|string',
            'lng' => 'required|string',
            'address' => 'required|string',
        ];
        $this->validate($request, $rules);
        $data = $request->except('logo');
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo')->store('public');
            $data['logo'] = $logo;
        }
        $setting->update($data);
        if ($request->ajax()) {
            return response()->json(['status' => true]);
        }
        Session::flash('success_message', __('common.item_edited'));
        return redirect()->back();
    }

}
