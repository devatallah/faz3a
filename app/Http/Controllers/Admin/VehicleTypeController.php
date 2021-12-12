<?php

namespace App\Http\Controllers\Admin;

use App\Models\Package;
use App\Models\Service;
use App\Models\TripType;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class VehicleTypeController extends Controller
{
    public function index()
    {
        $trip_types = TripType::query()->get();
        $services = Service::query()->get();
        $packages = Package::query()->get();
        return view('admin.vehicle_types.index', compact('trip_types', 'services', 'packages'));
    }

    public function create()
    {
        $trip_types = TripType::query()->get();
        $services = Service::query()->get();
        $packages = Package::query()->get();
        return view('admin.vehicle_types.create', compact('trip_types', 'services', 'packages'));
    }

    public function store(Request $request)
    {
        $rules = [
            'service_ids' => 'required|array',
            'service_ids.*' => 'required|exists:services,id',
            'package_ids' => 'array',
            'package_ids.*' => 'required|exists:packages,id',
            'trip_type_ids' => 'required|array',
            'trip_type_ids.*' => 'required|exists:trip_types,id',
            'for_passengers' => 'required|in:1,0',
            'for_packages' => 'required|in:1,0',
        ];
        foreach (locales() as $key => $language) {
            $rules['name_' . $key] = 'required|string|max:255';
        }
        $this->validate($request, $rules);
        $data = $request->only('for_passengers', 'for_packages');
        foreach (locales() as $key => $language) {
            $data['name'][$key] = $request->get('name_' . $key);
        }
        $vehicle_type = VehicleType::query()->create($data);
        $vehicle_type->services()->sync($request->service_ids);
        $vehicle_type->packages()->sync($request->package_ids);
        $vehicle_type->tripTypes()->sync($request->trip_type_ids);
        if ($request->ajax()) {
            return response()->json(['status' => true]);
        }
        Session::flash('success_message', __('common.item_added'));
        return redirect('admin/vehicle_types');
    }

    public function edit($id, Request $request)
    {
        $vehicle_type = VehicleType::query()->find($id);
        $trip_types = TripType::query()->get();
        $trip_type_ids = $vehicle_type->tripTypes()->pluck('trip_types.id')->toArray();
        $services = Service::query()->get();
        $service_ids = $vehicle_type->services()->pluck('services.id')->toArray();
        $packages = Package::query()->get();
        $package_ids = $vehicle_type->packages()->pluck('packages.id')->toArray();
        return view('admin.vehicle_types.edit', compact('trip_types', 'trip_type_ids', 'vehicle_type', 'services', 'service_ids',
            'packages', 'package_ids'));
    }

    public function show($id, Request $request)
    {
        $vehicle_type = VehicleType::query()->find($id);
        return view('admin.vehicle_types.show', compact('vehicle_type'));
    }

    public function update($id, Request $request)
    {
        $vehicle_type = VehicleType::query()->find($id);
        $rules = [
            'service_ids' => 'required|array',
            'service_ids.*' => 'required|exists:services,id',
            'package_ids' => 'array',
            'package_ids.*' => 'required|exists:packages,id',
            'trip_type_ids' => 'required|array',
            'trip_type_ids.*' => 'required|exists:trip_types,id',
            'for_passengers' => 'required|in:1,0',
            'for_packages' => 'required|in:1,0',
        ];
        foreach (locales() as $key => $language) {
            $rules['name_' . $key] = 'required|string|max:255';
        }
        $this->validate($request, $rules);
        $data = $request->only('for_passengers', 'for_packages');
        foreach (locales() as $key => $language) {
            if ($request->get('name_' . $key)) {
                $data['name'][$key] = $request->get('name_' . $key);
            }
        }
        $vehicle_type->update($data);
        $vehicle_type->services()->sync($request->service_ids);
        $vehicle_type->packages()->sync($request->package_ids);
        $vehicle_type->tripTypes()->sync($request->trip_type_ids);
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
            VehicleType::query()->whereIn('id', explode(',', $request->ids))
                ->update(['status' => $request->status]);
        } catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
        return response()->json(['status' => true]);
    }

    public function destroy($id)
    {
        try {
            VehicleType::query()->whereIn('id', explode(',', $id))->delete();
        } catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
        return response()->json(['status' => true]);
    }

    public function indexTable(Request $request)
    {
        $vehicle_types = VehicleType::query()->orderByDesc('id');
        return Datatables::of($vehicle_types)
            ->filter(function ($query) use ($request) {
                if ($request->name) {
                    $locale = app()->getLocale();
                    $query->where("name->$locale", 'Like', "%" . $request->name . "%");
                }
                if ($request->service_id) {
                    $query->whereHas('services',function ($q) use ($request){
                        $q->where('service_id', $request->service_id);
                    });
                }
            })->addColumn('action', function ($vehicle_type) {

                $string = '';
//                if(auth()->user()->hasAnyPermission(['edit_vehicle_types'])) {
                $string .= '<a  href="' . url('/admin/vehicle_types/' . $vehicle_type->id . '/edit') .
                    '" class="btn btn-sm btn-secondary"><i class="fa fa-lg fa-edit"></i></a>';
//                }
/*                $string .= ' <a  href="' . url('/admin/vehicle_types/' . $vehicle_type->id) .
                    '" class="btn btn-sm btn-info"><i class="fa fa-lg fa-eye"></i></a>';*/
//                if(auth()->user()->hasAnyPermission(['delete_vehicle_types'])) {
                $string .= ' <button type="button" class="btn btn-sm btn-danger delete-btn" data-id="' . $vehicle_type->id .
                    '"><i class="fa fa-lg fa-trash-o"></i></button>';
//                }
                return $string;
            })->make(true);
    }


}
