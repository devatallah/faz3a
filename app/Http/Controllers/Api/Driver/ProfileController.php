<?php

namespace App\Http\Controllers\Api\Driver;

use App\Driver;
use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\Verification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function profile(Request $request)
    {
        $driver = \App\Driver::query()/*->with('vehicle')*/ ->find(auth('driver_api')->id());
        $subscription = Subscription::query()->where('driver_id', $driver->id)
            ->where('to', '>', Carbon::now()->format('Y-m-d H:i:s'))->first();
        $driver->setAttribute('current_subscription', $subscription);
        $driver->setAttribute('token', $driver->createToken('api')->accessToken);
        return mainResponse(true, __('ok'), $driver, [], 200);
    }

    public function update(Request $request)
    {
        $driver_id = auth('driver_api')->id();
        $rules = [
            'image' => 'nullable|image',
            'name' => 'nullable|string|max:255',
            'gender' => 'nullable|string|in:male,female',
            'dob' => 'nullable|date|date_format:Y-m-d',
            'mobile' => 'nullable|numeric|unique:drivers,mobile,' . $driver_id,
            'id_no' => 'nullable|unique:drivers,id_no,' . $driver_id,
            'email' => 'nullable|string|email|max:255|unique:drivers,email,' . $driver_id,
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
        if ($request->id_no) {
            $data['id_no'] = $request->id_no;
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('public');
            $data['image'] = $image;
        }
        if ($request->hasFile('id_image')) {
            $id_image = $request->file('id_image')->store('public');
            $data['id_image'] = $id_image;
        }
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $driver = \App\Driver::query()->find($driver_id);
        if (count($data)) {
            $driver->update($data);
        }
        $driver->setAttribute('token', $driver->createToken('api')->accessToken);
        return mainResponse(true, __('ok'), $driver, [], 200);

    }

    public function updateVehicle(Request $request)
    {
        $driver_id = auth('driver_api')->id();
        $driver = \App\Driver::query()->find($driver_id);
        $rules = [
            'driver_licence_image' => 'nullable',
            'driver_licence_expire_date' => 'nullable',
            'trip_type_id' => 'nullable',
            'service_ids' => 'nullable|array',
            'service_ids.*' => 'required',
            'vehicle_type_id' => 'nullable',
            'plate_no' => 'nullable|string|max:255|unique:drivers,plate_no,' . $driver_id,
            'vehicle_licence_image' => 'nullable',
            'vehicle_licence_expire_date' => 'nullable|string|date',
            'passengers' => 'nullable',
            'vehicle_image' => 'nullable',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return mainResponse(false, $validator->errors()->first(), (object)[], $validator->errors()->messages());
        }

        $data = [];

        if ($request->driver_licence_expire_date) {
            $data['driver_licence_expire_date'] = $request->driver_licence_expire_date;
        }
        if ($request->trip_type_id) {
            $data['trip_type_id'] = $request->trip_type_id;
        }
        /*        if ($request->service_id) {
                    $data['service_id'] = $request->service_id;
                }*/
        if ($request->vehicle_type_id) {
            $data['vehicle_type_id'] = $request->vehicle_type_id;
        }
        if ($request->plate_no) {
            $data['plate_no'] = $request->plate_no;
        }
        if ($request->vehicle_licence_expire_date) {
            $data['vehicle_licence_expire_date'] = $request->vehicle_licence_expire_date;
        }
        if ($request->passengers) {
            $data['passengers'] = $request->passengers;
        }
        if ($request->hasFile('driver_licence_image')) {
            $driver_licence_image = $request->file('driver_licence_image')->store('public');
            $data['driver_licence_image'] = $driver_licence_image;
        }
        if ($request->hasFile('vehicle_licence_image')) {
            $vehicle_licence_image = $request->file('vehicle_licence_image')->store('public');
            $data['vehicle_licence_image'] = $vehicle_licence_image;
        }
        if ($request->hasFile('vehicle_image')) {
            $vehicle_image = $request->file('vehicle_image')->store('public');
            $data['vehicle_image'] = $vehicle_image;
        }
        $driver = \App\Driver::query()->find($driver_id);
        if ($request->service_ids) {
            $driver->services()->sync($request->service_ids);
        }
        if (count($data)) {
            $driver->update($data);
        }
        return mainResponse(true, __('ok'), $driver, [], 200);

    }

    public function updatePassword(Request $request)
    {
        $driver = \App\Driver::query()->find(auth('driver_api')->id());
        $rules = [
            'current_password' => 'required|hash_check:' . $driver->getAttribute('password'),
            'password' => 'required|string|min:6',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return mainResponse(false, $validator->errors()->first(), (object)[], $validator->errors()->messages());
        }
        $driver->update(['password' => bcrypt($request->get('password'))]);
        $driver->setAttribute('token', $request->bearerToken());
        return mainResponse(true, __('ok'), $driver, []);
    }

    public function forgotPassword(Request $request)
    {
        $rules = [
            'email' => 'required|email|exists:drivers',
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
            'email' => 'required|email|exists:drivers',
            'code' => 'required|hash_check:' . @$code->code,
            'password' => 'required|string|min:6',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return mainResponse(false, $validator->errors()->first(), (object)[], $validator->errors()->messages());
        }
        \App\Driver::query()->where('email', $request->email)
            ->update(['password' => bcrypt($request->password)]);
        Verification::query()->where('email', $request->email)->delete();
        return mainResponse(true, 'Your password reset successfully, please login', (object)[], [], 200);
    }

    public function verifyCode(Request $request)
    {
        $code = Verification::query()->
        where('email', $request->email)->first();
        $rules = [
            'email' => 'required|email|exists:verifications',
            'code' => 'required|hash_check:' . @$code->code,
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return mainResponse(false, $validator->errors()->first(), (object)[], $validator->errors()->messages());
        }

        Driver::query()->where('email', $request->email)->update(['email_verified_at' => Carbon::now()]);

        return mainResponse(true, __('ok'), 'Your Account Has been verified, you can login now', []);
    }

    public function sendCode(Request $request)
    {
        $rules = [
            'email' => 'required|email|exists:drivers',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return mainResponse(false, $validator->errors()->first(), [], $validator->errors()->messages());
        }
        $this->sendCodes($request->email, 'Your verification code is ');
        return mainResponse(true, 'We sent verification code to your email', [], [], 200);
    }


}
