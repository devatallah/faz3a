<?php

namespace App\Http\Controllers\Api\Driver;

use App\bookeey;
use App\Driver;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Page;
use App\Models\Plan;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Subscription;
use App\Models\Trip;
use App\Models\TripType;
use App\Models\UserToken;
use App\Models\VehicleType;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{

    public function plans()
    {
        $plans = Plan::query()->get();
        return mainResponse(true, __('api.ok'), $plans, []);
    }

    public function subscribe(Request $request)
    {
        $subcriptions = Subscription::query()->where('driver_id', auth('driver_api')->id())
            ->where('to', '>=', Carbon::now()->format('Y-m-d H:i:s'))->count();
        if ($subcriptions) {
            return mainResponse(false, __('common.you_have_active_subscription'), [], []);
        }
        $rules = [
            'transaction_id' => 'required|unique:subscriptions',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return mainResponse(false, $validator->errors()->first(), [], $validator->errors()->messages());
        }
        $plan = Plan::query()->find($request->plan_id);

        $bookeeyPipe = new bookeey();
        $bookeeyPipe->setMerchantID('mer1900091');
        $bookeeyPipe->setSecretKey('0222916');
        $orderIds = [$request->transaction_id];
        $transactionData = $bookeeyPipe->getPaymentStatus($orderIds);
        $status = @$transactionData[0]['tranStatus'];

        if ($status === 1) {
            Subscription::query()->create(['driver_id' => auth('driver_api')->id(),
                'plan_id' => $request->plan_id, 'price' => $plan->price, 'days' => $plan->days,
                'from' => Carbon::now()->format('Y-m-d H:i:s'), 'transaction_id' => $request->transaction_id,
                'to' => Carbon::now()->addDays($plan->days)->format('Y-m-d H:i:s')]);
        }
        return mainResponse(true, __('api.ok'), [], []);
    }
    public function subscriptions(Request $request)
    {
        $subscriptions = Subscription::query()->orderByDesc('id')->where('driver_id', auth('driver_api')->id())->get();
        return mainResponse(true, __('api.ok'), $subscriptions, []);
    }

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

    public function createTrip(Request $request)
    {
        $rules = [
            'from_lat' => 'required|string|max:255',
            'from_lng' => 'required|string|max:255',
            'from_address' => 'required|string|max:255',
            'to_lat' => 'required|string|max:255',
            'to_lng' => 'required|string|max:255',
            'to_address' => 'required|string|max:255',
            'trip_type_id' => 'required|exists:trip_types,id',
            'service_id' => 'required|exists:services,id',
            'user_id' => 'required|exists:users,id',
            'price' => 'required|numeric',
            'time' => 'required',
            'date' => 'required|date',
            'passengers' => 'nullable|numeric',
            'package_details' => 'nullable|string|min:3',
            'package_weight' => 'nullable|numeric',
            'note' => 'required|string|min:3',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return mainResponse(false, $validator->errors()->first(), [], $validator->errors()->messages());
        }
        $data = $request->only([
            'from_lat',
            'from_lng',
            'from_address',
            'to_lat',
            'to_lng',
            'to_address',
            'trip_type_id',
            'service_id',
            'user_id',
            'price',
            'time',
            'date',
            'passengers',
            'package_details',
            'package_weight',
            'note'
        ]);
        $data['driver_id'] = auth('driver_api')->id();
        $data['vehicle_id'] = auth('driver_api')->user()->id;
        $data['vehicle_type_id'] = auth('driver_api')->user()->vehicle_type_id;
        $trip = Trip::query()->create($data);

        $data = [
            'fromLat' => $request->from_lat,
            'fromLng' => $request->from_lng,
            'fromAddress' => $request->from_address,
            'toLat' => $request->to_lat,
            'toLng' => $request->to_lng,
            'toAddress' => $request->to_address,
            'tripTypeId' => $request->trip_type_id,
            'serviceId' => $request->service_id,
            'userId' => $request->user_id,
            'DriverId' => auth('driver_api')->id(),
            'vehicleId' => auth('driver_api')->user()->id,
            'vehicleTypeId' => auth('driver_api')->user()->vehicle_type_id,
            'price' => $request->price,
            'time' => $request->time,
            'date' => $request->date,
            'dateTime' => $request->date . ' ' . $request->time,
            'passengers' => $request->passengers,
            'packageDetails' => $request->package_details,
            'packageWeight' => $request->package_weight,
            'status' => 'pending',
            'note' => $request->note,
            'conversationId' => auth('driver_api')->id() . "_" . $request->user_id,
            'tripId' => $trip->id,
        ];
        $server_output = parseServer("http://198.12.252.234:1337/parse/classes/Contracts", $data, 'POST');
        $contractId = $server_output['objectId'];
        $trip->update(['contract_id' => $contractId]);
        $data = [
            "msg_id" => Carbon::now()->timestamp,
            "sender" => auth('driver_api')->id(),
            "client" => (int)$request->user_id,
            "conv_id" => auth('driver_api')->id() . "_" . $request->user_id,
            "text" => "",
            "type" => "contract",
            "contractId" => $contractId,
            "trip_id" => $trip->id,
            'status' => 'pending',
            "agent" => auth('driver_api')->id(),
        ];
        $server_output = parseServer("http://198.12.252.234:1337/parse/classes/Messages", $data, 'POST');
        $messageId = $server_output['objectId'];
        $trip->update(['contract_id' => $contractId, 'message_id' => $messageId]);

        return mainResponse(true, __('api.ok'), $trip, []);
    }

    public function reorder(Request $request)
    {
        $trip = Trip::query()->find($request->trip_id);
        $data = $trip->only(
            [
                'from_lat',
                'from_lng',
                'from_address',
                'to_lat',
                'to_lng',
                'to_address',
                'trip_type_id',
                'service_id',
                'user_id',
                'price',
                'passengers',
                'package_details',
                'package_weight',
                'driver_id',
                'vehicle_id',
                'vehicle_type_id',
                'note'
            ]
        );

        $data['time'] = $request->time;
        $data['date'] = $request->date;
        $trip = Trip::query()->create($data);

        $data = [
            'fromLat' => $trip->from_lat,
            'fromLng' => $trip->from_lng,
            'fromAddress' => $trip->from_address,
            'toLat' => $trip->to_lat,
            'toLng' => $trip->to_lng,
            'toAddress' => $trip->to_address,
            'tripTypeId' => $trip->trip_type_id,
            'serviceId' => $trip->service_id,
            'userId' => $trip->user_id,
            'DriverId' => auth('driver_api')->id(),
            'vehicleId' => (int)$trip->vehicle_id,
            'vehicleTypeId' => $trip->vehicle_type_id,
            'price' => $trip->price,
            'dateTime' => $trip->date . ' ' . $trip->time,
            'passengers' => $trip->passengers,
            'packageDetails' => $trip->package_details,
            'packageWeight' => $trip->package_weight,
            'status' => 'pending',
            'note' => $trip->note,
            'conversationId' => auth('driver_api')->id() . "_" . $trip->user_id,
            'tripId' => $trip->id,
        ];
        $data['time'] = $request->time;
        $data['date'] = $request->date;

        $server_output = parseServer("http://198.12.252.234:1337/parse/classes/Contracts", $data, 'POST');
//        dd($server_output);
        $contractId = $server_output['objectId'];
        $trip->update(['contract_id' => $contractId]);
        $data = [
            "msg_id" => Carbon::now()->timestamp,
            "sender" => auth('driver_api')->id(),
            "client" => (int)$trip->user_id,
            "conv_id" => auth('driver_api')->id() . "_" . $trip->user_id,
            "text" => "",
            "type" => "contract",
            "contractId" => $contractId,
            "trip_id" => $trip->id,
            'status' => 'pending',
            "agent" => auth('driver_api')->id(),
        ];
        $server_output = parseServer("http://198.12.252.234:1337/parse/classes/Messages", $data, 'POST');
        $messageId = $server_output['objectId'];
        $trip->update(['contract_id' => $contractId, 'message_id' => $messageId]);

        return mainResponse(true, __('api.ok'), $trip, []);
    }

    public function trips(Request $request)
    {
        $trips = Trip::query()->where('driver_id', auth('driver_api')->id());
        if ($request->status == 'next') {
            $trips->where('status', 'pending');
        }
        if ($request->status == 'current') {
            $trips->where('status', 'started');
        }
        if ($request->status == 'previous') {
            $trips->whereIn('status', ['completed', 'canceled']);
        }
        $trips = $trips->paginate();
        return mainResponse(true, __('api.ok'), $trips, []);
    }

    public function changStatus(Request $request)
    {
        $driver = Driver::query()->find(auth('driver_api')->id());
        $status = !$driver->is_available;
        $driver->is_available = $status;
        $driver->save();

        $data = [
            "is_available" => $status,
        ];
        $driverID = parseServer('http://198.12.252.234:1337/parse/classes/Driver?where={"driverId":' . $driver->id . '}', null, 'GET');
        $driverID = @$driverID['results'][0]['objectId'];
        if ($driverID) {
            parseServer("http://198.12.252.234:1337/parse/classes/Driver/" . $driverID, $data, 'PUT');
        }
        return mainResponse(true, __('api.ok'), [], []);
    }

    public function startTrip(Request $request)
    {
        $trip = Trip::query()->where('status', 'accepted')
            ->where('driver_id', auth('driver_api')->id())->find($request->trip_id);
        if ($trip) {
            $data = [
                "status" => 'started',
            ];
            $trip->update($data);
            parseServer("http://198.12.252.234:1337/parse/classes/Contracts/" . $trip->contract_id, $data, 'PUT');
            parseServer("http://198.12.252.234:1337/parse/classes/Messages/" . $trip->message_id, $data, 'PUT');
        }
        return mainResponse(true, __('api.ok'), [], []);
    }

    public function endTrip(Request $request)
    {
        $trip = Trip::query()->where('status', 'started')
            ->where('driver_id', auth('driver_api')->id())->find($request->trip_id);
        if ($trip) {
            $data = [
                "status" => 'completed',
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
            $res = parseServer("http://198.12.252.234:1337/parse/classes/Contracts/" . $trip->contract_id, $data, 'PUT');
            parseServer("http://198.12.252.234:1337/parse/classes/Messages/" . $trip->message_id, $data, 'PUT');
        }
        return mainResponse(true, __('api.ok'), [], []);
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
        $user = Driver::query()->find(auth('driver_api')->id());
        $notifications = $user->notifications()->get();
        return mainResponse(true, __('api.ok'), $notifications, []);
    }

    public function getUser($id)
    {
        $user = User::query()->select('id', 'name', 'image')->find($id);
        return mainResponse(true, __('api.ok'), $user, []);
    }

    public function appDetails()
    {
        $trip_types = TripType::query()->with('services.vehicleTypes')->get();
        $services = Service::query()->with('vehicleTypes')->get();
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
        return mainResponse(true, __('api.ok'), compact('trip_types', 'services', 'statuses',
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
        $data['complainable_id'] = auth('driver_api')->id();
        $data['complainable_type'] = Driver::class;
//        ContactMessage::query()->create($data);
        return mainResponse(true, __('api.ok'), [], []);

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
        $trip = Trip::query()->where('driver_id', auth('driver_api')->id())
            ->where('id', $request->trip_id)->where('status', 'confirmed')->first();
        if ($trip) {
            $trip->update(['user_rating' => $request->rating, 'to_user_feedback' => $request->feedback]);
            $avg = Trip::query()->where('user_id', $trip->user_id)
                ->where('user_rating', '<>', 0)->avg('user_rating');
            User::query()->find($trip->user_id)->update(['rating' => $avg]);
        }
        return mainResponse(true, __('api.ok'), [], []);
    }

    public function ratings(Request $request)
    {
        $ratings = Trip::query()->select('driver_rating', 'to_driver_feedback', 'user_id')
            ->where('user_id', $request->user_id)
            ->whereNotNull('user_rating')->get()->makeHidden(['driver_name', 'driver_image', 'trip_type_name', 'service_name', 'vehicle_type_name']);
        return mainResponse(true, __('api.ok'), $ratings, []);
    }
    public function sendMessageNotification(Request $request)
    {
        $android_tokens = UserToken::query()->where('user_id', $request->user_id)
            ->where('device', 'android')->pluck('token')->toArray();
        $ios_tokens = UserToken::query()->where('user_id', $request->user_id)
            ->where('device', 'ios')->pluck('token')->toArray();
        $android_fcm = fcmNotification($android_tokens, 'new Message', $request->message, $request->message, 'messages', $request->chat_id, 'android');
        $ios_fcm = fcmNotification($ios_tokens, 'new Message', $request->message, $request->message, 'messages', $request->chat_id, 'ios');
        return mainResponse(true, __('api.ok'), [], []);
    }

}
