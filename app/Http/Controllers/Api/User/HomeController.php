<?php

namespace App\Http\Controllers\Api\User;

use App\Driver;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\DriverToken;
use App\Models\Page;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Trip;
use App\Models\TripType;
use App\Models\Vehicle;
use App\Models\VehicleType;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{

    public function tripTypes()
    {
        $trip_types = TripType::query()->get();
        return mainResponse(true, __('api.ok'), $trip_types, []);
    }

    public function services()
    {
        $services = Service::query()->get();
        return mainResponse(true, __('api.ok'), $services, []);
    }

    public function vehicleTypes(Request $request)
    {
        $vehicle_types = VehicleType::query();
        if ($request->service_id) {
            $vehicle_types->whereHas('services', function ($q) use ($request) {
                $q->where('service_id', $request->service_id);
            });
        }
        $vehicle_types = $vehicle_types->get();
        return mainResponse(true, __('api.ok'), $vehicle_types, []);
    }

    public function drivers(Request $request)
    {
//        $vehicle = Vehicle::query()->where('status', 'active');
/*        if ($request->trip_type_id) {
            $vehicle->where('trip_type_id', $request->trip_type_id);
        }*/
/*        if ($request->service_id) {
            $vehicle->whereHas('services', function ($q) use ($request){
                $q->where('service_id', $request->service_id);
            });
        }*/
/*        if ($request->vehicle_type_id) {
            $vehicle->where('vehicle_type_id', $request->vehicle_type_id);
        }*/
/*        if ($request->passengers) {
            $vehicle->where('passengers', $request->passengers);
        }*/
//        $driver_ids = $vehicle->get()->pluck('driver_id')->toArray();
//        dd($request->all());
        $drivers = Driver::query()/*->whereIn('id', $driver_ids)*/;
        if ($request->trip_type_id) {
            $drivers->where('trip_type_id', $request->trip_type_id);
        }
        if ($request->service_id) {
            $drivers->whereHas('services', function ($q) use ($request){
                $q->where('service_id', $request->service_id);
            });
        }
        if ($request->vehicle_type_id) {
            $drivers->where('vehicle_type_id', $request->vehicle_type_id);
        }
        if ($request->passengers) {
            $drivers->where('passengers', $request->passengers);
        }
        if ($request->name) {
            $drivers->where('name', 'like', "%$request->name%");
        }
        if ($request->status == 'available') {
            $drivers->where('is_available', 1);
        }
        if ($request->status == 'not_available') {
            $drivers->where('is_available', 0);
        }
        $drivers = $drivers->paginate();
        return mainResponse(true, __('api.ok'), $drivers, []);
    }

    public function trips(Request $request)
    {
        $trips = Trip::query()->where('user_id', auth('user_api')->id());
        if ($request->status == 'next') {
            $trips->where('status', 'pending', 'accepted','started');
        }
        if ($request->status == 'current') {
            $trips->whereIn('status', ['accepted','started']);
        }
        if ($request->status == 'previous') {
            $trips->whereIn('status', ['completed', 'rejected', 'canceled']);
        }
        $trips = $trips->paginate();
        return mainResponse(true, __('api.ok'), $trips, []);
    }

    public function acceptTrip(Request $request)
    {
        $trip = Trip::query()
            ->where('status', 'pending')
            ->where('user_id', auth('user_api')->id())->find($request->trip_id);
        if ($trip) {
            $data = [
                "status" => 'accepted',
            ];
            $trip->update($data);
            parseServer("http://198.12.252.234:1337/parse/classes/Contracts/" . $trip->contract_id, $data, 'PUT');
            parseServer("http://198.12.252.234:1337/parse/classes/Messages/" . $trip->message_id, $data, 'PUT');
        }
        return mainResponse(true, __('api.ok'), [], []);
    }

    public function rejectTrip(Request $request)
    {
        $trip = Trip::query()
            ->where('status', 'pending')
            ->where('user_id', auth('user_api')->id())->find($request->trip_id);
        if ($trip) {
            $data = [
                "status" => 'rejected',
            ];
            $trip->update($data);
            parseServer("http://198.12.252.234:1337/parse/classes/Contracts/" . $trip->contract_id, $data, 'PUT');
            parseServer("http://198.12.252.234:1337/parse/classes/Messages/" . $trip->message_id, $data, 'PUT');
        }
        return mainResponse(true, __('api.ok'), [], []);
    }

    public function cancelTrip(Request $request)
    {
        $trip = Trip::query()
            ->whereNotIn('status', ['canceled', 'rejected', 'completed'])
            ->where('driver_id', auth('driver_api')->id())->find($request->trip_id);
        if ($trip) {
            $data = [
                "status" => 'canceled',
            ];
            $trip->update($data);
            parseServer("http://198.12.252.234:1337/parse/classes/Contracts/" . $trip->contract_id, $data, 'PUT');
            parseServer("http://198.12.252.234:1337/parse/classes/Messages/" . $trip->message_id, $data, 'PUT');
        }
        return mainResponse(true, __('api.ok'), [], []);
    }

    public function confirmTrip(Request $request)
    {
        $trip = Trip::query()
            ->where('status', 'completed')
            ->where('driver_id', auth('driver_api')->id())->find($request->trip_id);
        if ($trip) {
            $data = [
                "status" => 'confirmed',
            ];
            $trip->update($data);
            parseServer("http://198.12.252.234:1337/parse/classes/Contracts/" . $trip->contract_id, $data, 'PUT');
            parseServer("http://198.12.252.234:1337/parse/classes/Messages/" . $trip->message_id, $data, 'PUT');
        }
        return mainResponse(true, __('api.ok'), [], []);
    }


    public function getDriver($id)
    {
        $driver = Driver::query()->select('id', 'name', 'image', 'mobile', 'rating')->find($id);
        return mainResponse(true, __('api.ok'), $driver, []);
    }

    public function countries(Request $request)
    {
        $countries = Country::query();
        if ($request->with_cities) {
            $countries->with(['cities' => function ($q) {
                $q->where('status', 1);
            }]);
        }
        $countries = $countries->where('status', 1)->get();
        return mainResponse(true, __('ok'), $countries, [], 200);
    }

    public function cities(Request $request)
    {
        $cities = City::query()->where('status', 1);
        if ($request->with_cities) {
            $cities->where('country_id', $request->country_id);
        }
        $cities = $cities->get();
        return mainResponse(true, __('ok'), $cities, [], 200);
    }

    public function notifications(Request $request)
    {
        $user = User::query()->find(auth('user_api')->id());
        $notifications = $user->notifications()->get();
        return mainResponse(true, __('api.ok'), $notifications, []);
    }

    public function rating(Request $request)
    {
        $rules = [
            'trip_id' => 'required|exists:trips,id',
            'rating' => 'required|in:1,2,3,4,5',
            'feedback' => 'string',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return mainResponse(false, $validator->errors()->first(), [], $validator->errors()->messages());
        }
        $trip = Trip::query()->where('user_id', auth('user_api')->id())
            ->where('id', $request->trip_id)->where('status', 'confirmed')->first();
        if ($trip) {
            $trip->update(['driver_rating' => $request->rating, 'to_driver_feedback' => $request->feedback]);

            $avg = Trip::query()->where('driver_id', $trip->driver_id)
                ->where('driver_rating', '<>', 0)->avg('driver_rating');
            Driver::query()->find($trip->driver_id)->update(['rating' => $avg]);
        }
        return mainResponse(true, __('api.ok'), [], []);
    }

    public function appDetails()
    {
        $trip_types = TripType::query()->get()->transform(function ($trip_type){
            $services = Service::query()->whereHas('tripTypes', function ($q) use ($trip_type){
                $q->where('trip_type_id', $trip_type->id);
            })->get()->transform(function ($service) use ($trip_type){
                $vehicles = VehicleType::query()->with('packages')->whereHas('services', function ($q) use ($service){
                    $q->where('service_id', $service->id);
                })->whereHas('tripTypes', function ($q) use ($trip_type){
                    $q->where('trip_type_id', $trip_type->id);
                })->get();
                $service->vehicles = $vehicles;
                return $service;
            });
            $trip_type->services = $services;

            return $trip_type;
        });
        $statuses = ['pending' => 'pending', 'accepted' => 'accepted', 'started' => 'started',
            'canceled' => 'canceled', 'rejected' => 'rejected', 'completed' => 'completed'];

        $about = @Page::query()->find(1)->page_content;
        $terms_use = @Page::query()->find(2)->page_content;
        $privacy_policy = @Page::query()->find(3)->page_content;
        $setting = Setting::query()->find(1);
        $email = $setting->email;
        $mobile = $setting->mobile;
        $website = $setting->website;
        $facebook = $setting->facebook;
        $twitter = $setting->twitter;
        $instagram = $setting->instagram;
        $address = $setting->address;
        return mainResponse(true, __('api.ok'), compact('trip_types', 'statuses',
            'about', 'terms_use', 'privacy_policy',
            'email', 'mobile', 'website', 'address', 'facebook', 'twitter', 'instagram'), []);
    }

    public function sendMessage(Request $request)
    {
        $rules = [
            'message' => 'required|string|min:3',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return mainResponse(false, $validator->errors()->first(), [], $validator->errors()->messages());
        }
        $data = $request->only('message');
        $data['complainable_id'] = auth('user_api')->id();
        $data['complainable_type'] = User::class;
//        ContactMessage::query()->create($data);
        return mainResponse(true, __('api.ok'), [], []);

    }

    public function ratings(Request $request)
    {
        $ratings = Trip::query()->select('user_rating', 'to_user_feedback', 'driver_id')
            ->where('driver_id', $request->driver_id)
            ->whereNotNull('driver_rating')->get()->makeHidden(['user_name', 'user_image', 'trip_type_name', 'service_name', 'vehicle_type_name']);
        return mainResponse(true, __('api.ok'), $ratings, []);
    }

    public function sendMessageNotification(Request $request)
    {
        $android_tokens = DriverToken::query()->where('driver_id', $request->driver_id)
            ->where('device', 'android')->pluck('token')->toArray();
        $ios_tokens = DriverToken::query()->where('driver_id', $request->driver_id)
            ->where('device', 'ios')->pluck('token')->toArray();
        $android_fcm = fcmNotification($android_tokens, 'new Message', $request->message, $request->message, 'messages', $request->chat_id, 'android');
        $ios_fcm = fcmNotification($ios_tokens, 'new Message', $request->message, $request->message, 'messages', $request->chat_id, 'ios');
        return mainResponse(true, __('api.ok'), [], []);
    }


}
