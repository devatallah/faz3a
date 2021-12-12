<?php

namespace App\Http\Controllers\Api\Driver\Auth;

use App\Driver;
use App\Http\Controllers\Controller;
use App\Models\DriverToken;
use App\Models\Vehicle;
use App\Models\Verification;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new drivers as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect drivers after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:api');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:drivers',
            'name' => 'nullable|string|max:255',
            'token' => 'required|string|max:255',
            'device' => 'required|string|max:255',
            'mobile' => 'nullable|digits_between:8,14|max:255|unique:drivers',
            'password' => 'required|string|min:6',
            'dob' => 'nullable|string|date',
            'gender' => 'nullable|string|in:male,female',
            'id_no' => 'nullable|digits_between:8,14|max:255|unique:drivers',
            'image' => ' nullable|image',
            'id_image' => ' nullable|image',


            'driver_licence_image' => 'nullable',
            'driver_licence_expire_date' => 'nullable',
            'trip_type_id' => 'nullable',
            'service_ids' => 'nullable|array',
            'service_ids.*' => 'nullable',
            'vehicle_type_id' => 'nullable',
            'plate_no' => 'nullable|string|max:255|unique:drivers',
            'vehicle_licence_image' => 'nullable',
            'vehicle_licence_expire_date' => 'nullable|string|date',
            'passengers' => 'nullable',
        ]);
    }

    public function register(Request $request)
    {
        $data = $request->all();
        $validator = $this->validator($data);
        if ($validator->fails()) {
            return mainResponse(false, $validator->errors()->first(), (object)[], $validator->errors()->messages(), 200);
        }
        if ($request->hasFile('id_image')) {
            $image = $request->file('id_image')->store('public');
            $data['id_image'] = $image;
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('public');
            $data['image'] = $image;
        }
        if ($request->hasFile('driver_licence_image')) {
            $image = $request->file('driver_licence_image')->store('public');
            $data['driver_licence_image'] = $image;
        }
        if ($request->hasFile('vehicle_licence_image')) {
            $image = $request->file('vehicle_licence_image')->store('public');
            $data['vehicle_licence_image'] = $image;
        }
        if ($request->hasFile('vehicle_image')) {
            $image = $request->file('vehicle_image')->store('public');
            $data['vehicle_image'] = $image;
        }
        event(new Registered($driver = $this->create($data)));
        $driver = Driver::query()->find($driver->id);
        DriverToken::query()->updateOrCreate(
            ['driver_id' => $driver->id, 'token' => $request->token, 'device' => $request->device],
            ['driver_id' => $driver->id, 'token' => $request->token, 'device' => $request->device]);
        $driver->setAttribute('token', $driver->createToken('api')->accessToken);
        $code = str_replace('0', '', \Carbon\Carbon::now()->timestamp);
        $code = str_shuffle($code);
        $code = substr($code, 0, 6);
        $code = 123456;
        Verification::query()->where('email', $request->email)->delete();
        Verification::query()->insert(['email' => $request->email, 'code' => bcrypt($code)]);
        return mainResponse(true, 'We sent verification code to your email', [], [], 200);
    }

    /**
     * Create a new driver instance after a valid registration.
     *
     * @param array $data
     * @return \App\Driver
     */
    protected function create(array $data)
    {
//        $country_id = City::query()->find($data['city_id'])->country_id;
        $driver = Driver::create([
            'name' => @$data['name'],
            'email' => @$data['email'],
            'mobile' => @$data['mobile'],
            'dob' => @$data['dob'],
            'gender' => @$data['gender'],
            'id_no' => @$data['id_no'],
            'id_image' => @$data['id_image'],
            'image' => @$data['id_image'],
            'password' => bcrypt(@$data['password']),
            'driver_licence_image' => @$data['driver_licence_image'],
            'driver_licence_expire_date' => @$data['driver_licence_expire_date'],
            'trip_type_id' => @$data['trip_type_id'],
            'vehicle_type_id' => @$data['vehicle_type_id'],
            'plate_no' => @$data['plate_no'],
            'vehicle_licence_image' => @$data['vehicle_licence_image'],
            'vehicle_licence_expire_date' => @$data['vehicle_licence_expire_date'],
            'passengers' => @$data['passengers'],
        ]);
        $driver->services()->toggle(@$data['service_ids']);

        return $driver;
    }
}
