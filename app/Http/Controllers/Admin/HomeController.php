<?php

namespace App\Http\Controllers\Admin;

use App\Driver;
use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Service;
use App\Models\Subscription;
use App\Models\Trip;
use App\Models\TripType;
use App\User;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function home()
    {
        $period = CarbonPeriod::create(Carbon::now()->subDays(6)->format('Y-m-d'), Carbon::now()->format('Y-m-d'));
        $days_dates = [];
        foreach ($period as $item) {
            $days_dates[] = $item->format('Y-m-d');
        }
        $first_day = $days_dates[0];
        $last_day = end($days_dates);
        $trips = Trip::query()->whereBetween('date', [$first_day, $last_day])
            ->selectRaw("COUNT(*) as count, DATE_FORMAT(date, '%Y-%m-%d') date")
            ->groupBy(['date'])->get()->pluck('count', 'date')->toArray();
        $trips_earnings = Trip::query()->whereBetween('date', [$first_day, $last_day])
            ->selectRaw("SUM(price) as sum, DATE_FORMAT(date, '%Y-%m-%d') date")
            ->groupBy(['date'])->get()->pluck('sum', 'date')->toArray();
        foreach ($days_dates as $days_date) {
            $trips_arr[] = @$trips[$days_date] ?? 0;
            $trips_earnings_arr[] = @$trips_earnings[$days_date] ?? 0;
        }


        $drivers = Driver::query();
        $users = User::query();
        $trips = Trip::query();
        $subscriptions = Subscription::query();
        return view('admin.home', compact('drivers', 'users', 'trips', 'subscriptions', 'trips_arr', 'days_dates', 'trips_earnings_arr'));

    }
    public function chat(Request $request)
    {
        $driver = Driver::query()->find($request->driver_id);
        $user = Driver::query()->find($request->user_id);
        $trip_types = TripType::query()->pluck('name', 'id');
        $vehicle_types = \App\Models\VehicleType::query()->pluck('name', 'id');
        $services = Service::query()->with('vehicleTypes')->pluck('name', 'id');
        $statuses = ['pending' => 'pending', 'accepted' => 'accepted', 'started' => 'started',
            'canceled' => 'canceled', 'rejected' => 'rejected', 'completed' => 'completed', 'confirmed' => 'confirmed'];
        return view('admin.chats.index', compact('driver', 'user', 'trip_types', 'vehicle_types', 'services', 'statuses'));
    }


    public function getUsers(Request $request)
    {
        $users = \App\User::query()->where('mobile', 'like', '%' . $request->q . '%')
            ->orWhere('email', 'like', '%' . $request->q . '%');
        $users = $users->get();
        $json = [];
        foreach ($users as $user) {
            $json[] = [
                'id' => $user->id,
                'text' => $user->email . " ($user->mobile)",
            ];
        }
        return json_encode($json);
    }
    public function testCode(Request $request)
    {
        dd(333);
        symlink(storage_path('app/public'), public_path('/storage'));

        $bookeeyPipe = new bookeey();
        $bookeeyPipe->setMerchantID('mer1900091');
        $bookeeyPipe->setSecretKey('0222916');
        $orderIds = ['1602410977667'];
        $transactionData = $bookeeyPipe->getPaymentStatus($orderIds);

        dd($transactionData[0]['tranStatus']);

        $data = [
            "lat" => 35.000675,
            "lng" =>  32.008826,
        ];
        $driverID = parseServer('http://198.12.252.234:1337/parse/classes/Driver?where={"driverId":3}', null, 'GET');
        $driverID = @$driverID['results'][0]['objectId'];
        if ($driverID){
            $driverID = parseServer("http://198.12.252.234:1337/parse/classes/Driver/" . $driverID, $data, 'PUT');
        }

        dd('done');
        $driver = Driver::query()->find(21);
        $status = '1';
        $driver->status = $status;
        $driver->save();

        $data = [
            "status" => $status,
        ];
        $driverID = parseServer('http://198.12.252.234:1337/parse/classes/Driver?where={"driverId":'.$driver->id.'}', null, 'GET');
        $driverID = @$driverID['results'][0]['objectId'];
        if ($driverID){
            parseServer("http://198.12.252.234:1337/parse/classes/Driver/" . $driverID, $data, 'PUT');
        }
        $driverID = parseServer('http://198.12.252.234:1337/parse/classes/Driver?where={"driverId":'.$driver->id.'}', null, 'GET');

        dd($driverID);
    }

}
