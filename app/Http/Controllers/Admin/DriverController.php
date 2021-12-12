<?php

namespace App\Http\Controllers\Admin;

use App\Driver;
use App\Models\Service;
use App\Models\TripType;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class DriverController extends Controller
{
    public function track()
    {
        return view('admin.drivers.track');
    }
    public function index()
    {
        $vehicle_types = VehicleType::all();
        $trip_types = TripType::all();
        return view('admin.drivers.index', compact('vehicle_types', 'trip_types'));
    }

    public function create()
    {
        $vehicle_types = VehicleType::all();
        $trip_types = TripType::all();
        return view('admin.drivers.create', compact('vehicle_types', 'trip_types'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:drivers',
            'mobile' => 'required|digits_between:8,14|max:255|unique:drivers',
            'password' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'id_no' => 'required',
            'plate_no' => 'required',
            'passengers' => 'required',
            'trip_type_id' => 'required',
            'service_ids' => 'required',
            'service_ids.*' => 'required',
            'vehicle_type_id' => 'required',
            'driver_licence_expire_date' => 'required',
            'vehicle_licence_expire_date' => 'required',
            'image' => 'required',
            'id_image' => 'required',
            'driver_licence_image' => 'required',
            'vehicle_licence_image' => 'required',
            'vehicle_image' => 'required',
        ];
        $this->validate($request, $rules);
        $data = $request->only('name', 'email','mobile','password','dob','gender','id_no', 'plate_no','passengers','trip_type_id','vehicle_type_id','driver_licence_expire_date',
            'vehicle_licence_expire_date');
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('public');
            $data['image'] = $image;
        }
        if ($request->hasFile('id_image')) {
            $id_image = $request->file('id_image')->store('public');
            $data['id_image'] = $id_image;
        }

        if ($request->hasFile('driver_licence_image')) {
            $driver_licence_image = $request->file('driver_licence_image')->store('public');
            $data['driver_licence_image'] = $driver_licence_image;
        }
        if ($request->hasFile('vehicle_licence_image')) {
            $vehicle_licence_image = $request->file('vehicle_licence_image')->store('public');
            $data['vehicle_licence_image'] = $vehicle_licence_image;
        }
        if ($request->hasFile('vehicle_licence_image')) {
            $vehicle_licence_image = $request->file('vehicle_licence_image')->store('public');
            $data['vehicle_licence_image'] = $vehicle_licence_image;
        }
        if ($request->hasFile('vehicle_image')) {
            $vehicle_image = $request->file('vehicle_image')->store('public');
            $data['vehicle_image'] = $vehicle_image;
        }
        $driver = Driver::query()->create($data);
        $driver->services()->sync($request->service_ids);
        if ($request->ajax()) {
            return response()->json(['status' => true]);
        }
        Session::flash('success_message', __('common.item_added'));
        return redirect('admin/drivers');
    }

    public function edit($id, Request $request)
    {
        $driver = Driver::query()->find($id);
        $vehicle_types = VehicleType::all();
        $services = Service::all();
        $trip_types = TripType::all();
        $current_services = Service::query()->whereHas('vehicleTypes', function ($q) use ($driver){
            $q->where('vehicle_type_id', $driver->vehicle_type_id);
        })->get();

        return view('admin.drivers.edit', compact('driver', 'services', 'trip_types', 'vehicle_types', 'current_services'));
    }
    public function show($id, Request $request)
    {
        $driver = Driver::query()->find($id);
        $vehicle_types = VehicleType::all();
        $services = Service::all();
        $trip_types = TripType::all();
        $current_services = Service::query()->whereHas('vehicleTypes', function ($q) use ($driver){
            $q->where('vehicle_type_id', $driver->vehicle_type_id);
        })->get();

        return view('admin.drivers.show', compact('driver', 'services', 'trip_types', 'vehicle_types', 'current_services'));
    }


    public function update($id, Request $request)
    {
        $driver = Driver::query()->find($id);
        $rules = [
            'name' => 'required',
            'email' => 'string|email|max:255|unique:drivers,email,' . $id,
            'mobile' => 'string|digits_between:8,14|unique:drivers,mobile,' . $id,
            'password' => 'nullable',
            'dob' => 'required',
            'gender' => 'required',
            'status' => 'required|in:1,0',
            'id_no' => 'required',
            'plate_no' => 'required',
            'passengers' => 'required',
            'trip_type_id' => 'required',
            'service_ids' => 'required',
            'service_ids.*' => 'required',
            'vehicle_type_id' => 'required',
            'driver_licence_expire_date' => 'required',
            'vehicle_licence_expire_date' => 'required',
            'image' => 'nullable|image',
            'id_image' => 'nullable|image',
            'driver_licence_image' => 'nullable|image',
            'vehicle_licence_image' => 'nullable|image',
            'vehicle_image' => 'nullable|image',
        ];
        $this->validate($request, $rules);
        $data = $request->only('name', 'email','mobile','password','dob','status','gender','id_no', 'plate_no','passengers','trip_type_id','service_id','vehicle_type_id','driver_licence_expire_date',
            'vehicle_licence_expire_date');
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('public');
            $data['image'] = $image;
        }
        if ($request->hasFile('id_image')) {
            $id_image = $request->file('id_image')->store('public');
            $data['id_image'] = $id_image;
        }

        $data = $request->only('plate_no','passengers','trip_type_id','service_id','vehicle_type_id','driver_licence_expire_date',
            'vehicle_licence_expire_date');
        if ($request->hasFile('driver_licence_image')) {
            $driver_licence_image = $request->file('driver_licence_image')->store('public');
            $data['driver_licence_image'] = $driver_licence_image;
        }
        if ($request->hasFile('vehicle_licence_image')) {
            $vehicle_licence_image = $request->file('vehicle_licence_image')->store('public');
            $data['vehicle_licence_image'] = $vehicle_licence_image;
        }
        if ($request->hasFile('vehicle_licence_image')) {
            $vehicle_licence_image = $request->file('vehicle_licence_image')->store('public');
            $data['vehicle_licence_image'] = $vehicle_licence_image;
        }
        if ($request->hasFile('vehicle_image')) {
            $vehicle_image = $request->file('vehicle_image')->store('public');
            $data['vehicle_image'] = $vehicle_image;
        }
        $driver->update($data);
        $driver->services()->sync($request->service_ids);
        if ($request->ajax()) {
            return response()->json(['status' => true]);
        }
        Session::flash('success_message', __('common.item_edited'));
        return redirect()->back();
    }


    public function updateStatus(Request $request)
    {
        $rules = [
            'ids' => 'required',
            'status' => 'required|in:0,1',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false]);
        }
        try {
            Driver::query()->whereIn('id', explode(',', $request->ids))
                ->update(['status' => $request->status]);
        } catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
        return response()->json(['status' => true]);
    }

    public function destroy($id)
    {
        try {
            Driver::query()->whereIn('id', explode(',', $id))->delete();
        } catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
        return response()->json(['status' => true]);
    }

    public function indexTable(Request $request)
    {
        $drivers = Driver::query()->orderByDesc('id');
        return Datatables::of($drivers)
            ->filter(function ($query) use ($request) {
                if ($request->name) {
                    $query->where("name", 'Like', "%" . $request->name . "%");
                }
                if ($request->email) {
                    $query->where("email", 'Like', "%" . $request->email . "%");
                }
                if ($request->mobile) {
                    $query->where("mobile", 'Like', "%" . $request->mobile . "%");
                }
                if ($request->gender) {
                    $query->where("gender", 'Like', "%" . $request->gender . "%");
                }
                if ($request->id_no) {
                    $query->where("id_no", 'Like', "%" . $request->id_no . "%");
                }
                if ($request->plate_no) {
                    $query->where("plate_no", 'Like', "%" . $request->plate_no . "%");
                }
                if ($request->trip_type_id) {
                    $query->where("trip_type_id", $request->trip_type_id);
                }
                if ($request->service_id) {
                    $query->where("service_id", $request->service_id);
                }
                if ($request->vehicle_type_id) {
                    $query->where("vehicle_type_id", $request->vehicle_type_id);
                }
                if ($request->is_available == 'yes') {
                    $query->where("is_available", 1);
                }
                if ($request->is_available == 'no') {
                    $query->where("is_available", 0);
                }
            })->addColumn('action', function ($driver) {

                $string = '';
//                if(auth()->user()->hasAnyPermission(['edit_drivers'])) {
                $string .= '<a  href="' . url('/admin/drivers/' . $driver->id . '/edit') .
                    '" class="btn btn-sm btn-secondary"><i class="fa fa-lg fa-edit"></i></a>';
//                }
                $string .= ' <a  href="' . url('/admin/drivers/' . $driver->id) .
                    '" class="btn btn-sm btn-info"><i class="fa fa-lg fa-eye"></i></a>';
//                if(auth()->user()->hasAnyPermission(['delete_drivers'])) {
                $string .= ' <button type="button" class="btn btn-sm btn-danger delete-btn" data-id="' . $driver->id .
                    '"><i class="fa fa-lg fa-trash-o"></i></button>';
//                }
                return $string;
            })->make(true);
    }


}
