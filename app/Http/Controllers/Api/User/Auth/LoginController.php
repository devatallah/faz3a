<?php

namespace App\Http\Controllers\Api\User\Auth;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Http\Controllers\Controller;
use App\Models\UserToken;
use App\Models\Verification;
use App\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Lcobucci\JWT\Parser;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct ()
    {
        $this->middleware('guest:api')->except('logout');
    }

    protected function guard ()
    {
        return Auth::guard('api-teacher');
    }


    protected function validator (array $data)
    {
        $rules = [
            $this->username() => 'required',
            'password' => 'required|string',
            'token' => 'required|string|max:255',
            'device' => 'required|string|max:255',
        ];

        return Validator::make($data, $rules);
    }

    public function login (Request $request)
    {
        if ($request->social_id && $request->social_type) {
            if ($request->social_type == 'google' && !is_null($request->social_id)) {
                if ($request->email) {
                    $user = User::query()->where('email', $request->email)->first();
                    if ($user) {
                        if (is_null($user->google_id)) {
                            $user->update(['google_id' => $request->social_id, 'email_verified_at' => Carbon::now()]);
                        }
                    }
                }
                if (!$user_ = User::query()->where('google_id', $request->social_id)->first()) {
                    $user = User::query()->create(['google_id' => $request->social_id, 'email' => @$request->email,
                        'name' => @$request->name, 'email_verified_at' => Carbon::now()]);
                }
                $user = User::query()->where('google_id', $request->social_id)->first();

            }
            if ($request->social_type == 'apple' && !is_null($request->social_id)) {
                if ($request->email) {
                    $user = User::query()->where('email', $request->email)->first();
                    if ($user) {
                        if (is_null($user->apple_id)) {
                            $user->update(['apple_id' => $request->social_id, 'email_verified_at' => Carbon::now()]);
                        }
                    }
                }

                if (!$user_ = User::query()->where('apple_id', $request->social_id)->first()) {
                    $user = User::query()->create(['apple_id' => $request->social_id, 'email' => @$request->email,
                        'name' => @$request->name, 'email_verified_at' => Carbon::now()]);
                }
                $user = User::query()->where('apple_id', $request->social_id)->first();

            }
            if ($user) {
                $user->setAttribute('token', $user->createToken('api')->accessToken);
                if ($request->token && $request->device) {
                    UserToken::query()->updateOrCreate(
                        ['user_id' => $user->id, 'token' => $request->token, 'device' => $request->device],
                        ['user_id' => $user->id, 'token' => $request->token, 'device' => $request->device]);
                }
            }
            return mainResponse(true, 'api.ok', $user, []);

        }

        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return mainResponse(false, $validator->errors()->first(), (object)[], $validator->errors()->messages(), 200);
        }

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            $user = auth()->guard()->user();
            $this->clearLoginAttempts($request);
            $user = User::query()->find($user->id);
            UserToken::query()->updateOrCreate(
                ['user_id' => $user->id, 'token' => $request->token, 'device' => $request->device],
                ['user_id' => $user->id, 'token' => $request->token, 'device' => $request->device]);
            if (!is_null($user->email_verified_at)) {
                $user->setAttribute('token', $user->createToken('api')->accessToken);
            }else{
                $code = str_replace('0', '', \Carbon\Carbon::now()->timestamp);
                $code = str_shuffle($code);
                $code = substr($code, 0, 6);
                $code = 123456;
                Verification::query()->where('email', $request->email)->delete();
                Verification::query()->insert(['email' => $request->email, 'code' => bcrypt($code)]);
            }
            return mainResponse(true, __('ok'), $user, [], 200);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function sendLockoutResponse (Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );
        return mainResponse(false, __('auth.throttle', ['seconds' => $seconds]), [], [], 200);
    }

    protected function sendFailedLoginResponse (Request $request)
    {
        return mainResponse(false, __('auth.failed'), (object)[], [], 401);
    }

    public function logout (Request $request)
    {

        $value = $request->bearerToken();
        $id = (new Parser())->parse($value)->getHeader('jti');
        $token = $request->user()->tokens->find($id);
        $token->revoke();
//        UserToken::query()->where('token', $request->token)->delete();
        return mainResponse(true, __('ok'), [], [], 200);
    }

    protected function attemptLogin (Request $request)
    {
        return auth()->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    protected function credentials (\Illuminate\Http\Request $request)
    {
        //return $request->only($this->username(), 'password');
        return [$this->username() => $request->{$this->username()}, 'password' => $request->password, 'deleted_at' => null];
    }

    public function username ()
    {
        return 'email';
    }

}
