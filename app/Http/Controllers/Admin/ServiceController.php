<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Models\TripType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ServiceController extends Controller
{
    public function index()
    {
        $trip_types = TripType::query()->get();
        return view('admin.services.index', compact('trip_types'));
    }

    public function create()
    {
        $trip_types = TripType::query()->get();
        return view('admin.services.create', compact('trip_types'));
    }

    public function store(Request $request)
    {
        $rules = [
//            'for_passengers' => 'required|in:1,0',
//            'for_packages' => 'required|in:1,0',
            'trip_type_ids' => 'required|array',
            'trip_type_ids.*' => 'required|exists:trip_types,id',
        ];
        foreach (locales() as $key => $language) {
            $rules['name_' . $key] = 'required|string|max:255';
        }
        $this->validate($request, $rules);
        $data = [];
//        $data = $request->only('for_passengers', 'for_packages');
        foreach (locales() as $key => $language) {
            $data['name'][$key] = $request->get('name_' . $key);
        }
        $service = Service::query()->create($data);
        $service->tripTypes()->sync($request->trip_type_ids);
        if ($request->ajax()) {
            return response()->json(['status' => true]);
        }
        Session::flash('success_message', __('common.item_added'));
        return redirect('admin/services');
    }

    public function edit($id, Request $request)
    {
        $service = Service::query()->find($id);
        $trip_types = TripType::query()->get();
        $trip_type_ids = $service->tripTypes()->pluck('trip_types.id')->toArray();
        return view('admin.services.edit', compact('service', 'trip_types', 'trip_type_ids'));
    }

    public function show($id, Request $request)
    {
        $service = Service::query()->find($id);
        return view('admin.services.show', compact('service'));
    }

    public function update($id, Request $request)
    {
        $service = Service::query()->find($id);
        $rules = [
//            'for_passengers' => 'required|in:1,0',
//            'for_packages' => 'required|in:1,0',
            'trip_type_ids' => 'required|array',
            'trip_type_ids.*' => 'required|exists:trip_types,id',
        ];
        foreach (locales() as $key => $language) {
            $rules['name_' . $key] = 'required|string|max:255';
        }
        $this->validate($request, $rules);
        $data = [];
//        $data = $request->only('for_passengers', 'for_packages');
        foreach (locales() as $key => $language) {
            if ($request->get('name_' . $key)) {
                $data['name'][$key] = $request->get('name_' . $key);
            }
        }
        $service->update($data);
        $service->tripTypes()->sync($request->trip_type_ids);
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
            Service::query()->whereIn('id', explode(',', $request->ids))
                ->update(['status' => $request->status]);
        } catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
        return response()->json(['status' => true]);
    }

    public function destroy($id)
    {
        try {
            Service::query()->whereIn('id', explode(',', $id))->delete();
        } catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
        return response()->json(['status' => true]);
    }

    public function indexTable(Request $request)
    {
        $services = Service::query()->orderByDesc('id');
        return Datatables::of($services)
            ->filter(function ($query) use ($request) {
                if ($request->name) {
                    $locale = app()->getLocale();
                    $query->where("name->$locale", 'Like', "%" . $request->name . "%");
                }
            })->addColumn('action', function ($service) {

                $string = '';
//                if(auth()->user()->hasAnyPermission(['edit_services'])) {
                $string .= '<a  href="' . url('/admin/services/' . $service->id . '/edit') .
                    '" class="btn btn-sm btn-secondary"><i class="fa fa-lg fa-edit"></i></a>';
//                }
/*                $string .= ' <a  href="' . url('/admin/services/' . $service->id) .
                    '" class="btn btn-sm btn-info"><i class="fa fa-lg fa-eye"></i></a>';*/
//                if(auth()->user()->hasAnyPermission(['delete_services'])) {
                $string .= ' <button type="button" class="btn btn-sm btn-danger delete-btn" data-id="' . $service->id .
                    '"><i class="fa fa-lg fa-trash-o"></i></button>';
//                }
                return $string;
            })->make(true);
    }


}
