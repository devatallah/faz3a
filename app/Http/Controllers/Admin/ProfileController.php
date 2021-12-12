<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function update(Request $request){
        $user_id = auth()->id();
        $user = Admin::query()->find($user_id);

        $rules = [
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:admins,email,' . $user_id,
            'mobile' => 'string|digits_between:8,14|max:255|unique:admins,mobile,' . $user_id,
        ];
        $this->validate($request, $rules);
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('public');
            $data['image'] = $image;
        }
//        dd($data);
        $user->update($data);

        if ($request->ajax()) {
            return response()->json(['status' => true]);
        }
        Session::flash('success_message', 'تم التعديل');
        return redirect('admin/profile');

    }

    public function changePassword(Request $request)
    {
        $user = Admin::query()->find(auth()->id());
        $rules = [
            'current_password' => 'required|hash_check:' . $user->getAttribute('password'),
            'password' => 'required|confirmed|string|min:6',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('profile#change_password')->withErrors($validator->errors()->messages());
        }

        $user->update(['password' => bcrypt($request->get('password'))]);

        if ($request->ajax()) {
            return response()->json(['status' => true]);
        }
        Session::flash('success_message', 'تم التعديل');

        return redirect('admin/profile#change_password');
    }

}
