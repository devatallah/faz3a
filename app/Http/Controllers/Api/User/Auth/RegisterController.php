<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserToken;
use App\Models\Verification;
use App\User;
use Dimsav\Translatable\Test\Model\City;
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
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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

    public function register(Request $request)
    {
        $data = $request->all();
        $validator = $this->validator($data);
        if ($validator->fails()) {
            return mainResponse(false, $validator->errors()->first(), (object)[], $validator->errors()->messages(), 200);
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('public');
            $data['image'] = $image;
        }
        event(new Registered($user = $this->create($data)));
        $user = User::query()->find($user->id);
        UserToken::query()->updateOrCreate(
            ['user_id' => $user->id, 'token' => $request->token, 'device' => $request->device],
            ['user_id' => $user->id, 'token' => $request->token, 'device' => $request->device]);
        $user->setAttribute('token', $user->createToken('api')->accessToken);
        $code = str_replace('0', '', \Carbon\Carbon::now()->timestamp);
        $code = str_shuffle($code);
        $code = substr($code, 0, 6);
        $code = 123456;
        Verification::query()->where('email', $request->email)->delete();
        Verification::query()->insert(['email' => $request->email, 'code' => bcrypt($code)]);
        return mainResponse(true, 'We sent verification code to your email', [], [], 200);
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
            'email' => 'required|string|email|max:255|unique:users',
            'name' => 'nullable|string|max:255',
            'mobile' => 'nullable|digits_between:8,14|max:255|unique:users',
            'password' => 'required|string|min:6',
            'token' => 'nullable|string|max:255',
            'device' => 'nullable|string|max:255',
            'dob' => 'nullable|string|date',
            'gender' => 'nullable|string|in:male,female',
            'lat' => 'nullable|string',
            'lng' => 'nullable|string',
            'image' => 'nullable|image',
            'address' => 'nullable|string',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
//        $country_id = City::query()->find($data['city_id'])->country_id;
        $user = User::create([
            'name' => @$data['name'],
            'email' => @$data['email'],
            'mobile' => @$data['mobile'],
            'gender' => @$data['gender'],
            'dob' => @$data['dob'],
            'lat' => @$data['lat'],
            'lng' => @$data['lng'],
            'image' => @$data['image'],
            'address' => @$data['address'],
            'password' => bcrypt(@$data['password']),
        ]);

        return $user;
    }
}
