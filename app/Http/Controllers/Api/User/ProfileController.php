<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Verification;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function profile(Request $request)
    {
        $user = \App\User::query()->find(auth('api')->id());
        $user->setAttribute('token', $user->createToken('api')->accessToken);
        return mainResponse(true, __('ok'), $user, [], 200);
    }

    public function update(Request $request)
    {
        $user_id = auth('api')->id();
        $rules = [
            'image' => 'nullable|image',
            'name' => 'nullable|string|max:255',
            'gender' => 'nullable|string|in:male,female',
            'dob' => 'nullable|date|date_format:Y-m-d',
            'mobile' => 'nullable|numeric|unique:users,mobile,' . $user_id,
            'country_id' => 'nullable|numeric'/*|exists:countries,id'*/,
            'city_id' => 'nullable|numeric'/*|exists:cities,id'*/,
            'email' => 'nullable|string|email|max:255|unique:users,email,' . $user_id,
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return mainResponse(false, $validator->errors()->first(), (object)[], $validator->errors()->messages());
        }

        $data = [];

        if ($request->name) {
            $data['name'] = $request->name;
        }
        if ($request->email) {
            $data['email'] = $request->email;
        }
        if ($request->mobile) {
            $data['mobile'] = $request->mobile;
        }
        if ($request->country_id) {
            $data['country_id'] = $request->country_id;
        }
        if ($request->city_id) {
            $data['city_id'] = $request->city_id;
        }
        if ($request->gender) {
            $data['gender'] = $request->gender;
        }
        if ($request->dob) {
            $data['dob'] = $request->dob;
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('public');
            $data['image'] = $image;
        }
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $user = \App\User::query()->find($user_id);
        if (count($data)) {
            $user->update($data);
        }
        $user->setAttribute('token', $user->createToken('api')->accessToken);
        return mainResponse(true, __('ok'), $user, [], 200);
    }

    public function updatePassword(Request $request)
    {
        $user = \App\User::query()->find(auth('api')->id());
        $rules = [
            'current_password' => 'required|hash_check:' . $user->getAttribute('password'),
            'password' => 'required|string|min:6',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return mainResponse(false, $validator->errors()->first(), (object)[], $validator->errors()->messages());
        }
        $user->update(['password' => bcrypt($request->get('password'))]);
        $user->setAttribute('token', $request->bearerToken());
        return mainResponse(true, __('ok'), $user, []);
    }

    public function forgotPassword(Request $request)
    {
        $rules = [
            'email' => 'required|email|exists:users',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return mainResponse(false, $validator->errors()->first(), (object)[], $validator->errors()->messages());
        }
        $this->sendCodes($request->email, 'Your reset password code is ');
        return mainResponse(true, 'We sent reset code to your email', (object)[], [], 200);
    }

    public function sendCodes($email, $message)
    {
        $code = str_replace('0', '1', \Carbon\Carbon::now()->timestamp);
        $code = str_shuffle($code);
        $code = substr($code, 0, 6);
        $code = 123456;
        Verification::query()->where('email', $email)->delete();
        Verification::query()->insert(['email' => $email, 'code' => bcrypt($code)]);
        return mainResponse(true, __('ok'), (object)[], []);
    }

    public function resetPassword(Request $request)
    {
        $code = Verification::query()->
        where('email', $request->email)->first();
        $rules = [
            'email' => 'required|digits_between:8,14|exists:users',
            'code' => 'required|hash_check:' . @$code->code,
            'password' => 'required|string|min:6',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return mainResponse(false, $validator->errors()->first(), (object)[], $validator->errors()->messages());
        }
        \App\User::query()->where('email', $request->email)
            ->update(['password' => bcrypt($request->password)]);
        Verification::query()->where('email', $request->email)->delete();
        return mainResponse(true, 'Your password reset successfully, please login', (object)[], [], 200);
    }

    public function verifyCode(Request $request)
    {
        $email_code = Verification::query()->
        where('email', $request->email)->first();
        $rules = [
            'email' => 'required|email|exists:verifications',
            'code' => 'required|hash_check:' . @$email_code->code,
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return mainResponse(false, $validator->errors()->first(), (object)[], $validator->errors()->messages());
        }

        User::query()->where('email', $request->email)->update(['email_verified_at' => Carbon::now()]);

        return mainResponse(true, __('ok'), 'Your Account Has been verified, you can login now', []);
    }

    public function sendCode(Request $request)
    {
        $rules = [
            'email' => 'required|email|exists:users',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return mainResponse(false, $validator->errors()->first(), [], $validator->errors()->messages());
        }
        $this->sendCodes($request->email, 'Your verification code is ');
        return mainResponse(true, 'We sent verification code to your email', [], [], 200);
    }


}
