<?php

namespace App\Http\Controllers\Admin;

use App\Models\TripType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class TripTypeController extends Controller
{
    public function index()
    {
        return view('admin.trip_types.index');
    }

    public function create()
    {
        return view('admin.trip_types.create');
    }

    public function store(Request $request)
    {
        $rules = [];
        foreach (locales() as $key => $language) {
            $rules['name_' . $key] = 'required|string|max:255';
        }
        $this->validate($request, $rules);
        $data = [];
        foreach (locales() as $key => $language) {
            $data['name'][$key] = $request->get('name_' . $key);
        }
        TripType::query()->create($data);
        if ($request->ajax()) {
            return response()->json(['status' => true]);
        }
        Session::flash('success_message', __('common.item_added'));
        return redirect('admin/trip_types');
    }

    public function edit($id, Request $request)
    {
        $trip_type = TripType::query()->find($id);
        return view('admin.trip_types.edit', compact('trip_type'));
    }

    public function show($id, Request $request)
    {
        $trip_type = TripType::query()->find($id);
        return view('admin.trip_types.show', compact('trip_type'));
    }

    public function update($id, Request $request)
    {
        $trip_type = TripType::query()->find($id);
        $rules = [];
        foreach (locales() as $key => $language) {
            $rules['name_' . $key] = 'required|string|max:255';
        }
        $this->validate($request, $rules);
        $data = [];
        foreach (locales() as $key => $language) {
            if ($request->get('name_' . $key)) {
                $data['name'][$key] = $request->get('name_' . $key);
            }
        }
        $trip_type->update($data);
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
            TripType::query()->whereIn('id', explode(',', $request->ids))
                ->update(['status' => $request->status]);
        } catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
        return response()->json(['status' => true]);
    }

    public function destroy($id)
    {
        try {
            TripType::query()->whereIn('id', explode(',', $id))->delete();
        } catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
        return response()->json(['status' => true]);
    }

    public function indexTable(Request $request)
    {
        $trip_types = TripType::query()->orderByDesc('id');
        return Datatables::of($trip_types)
            ->filter(function ($query) use ($request) {
                if ($request->name) {
                    $locale = app()->getLocale();
                    $query->where("name->$locale", 'Like', "%" . $request->name . "%");
                }
            })->addColumn('action', function ($trip_type) {

                $string = '';
//                if(auth()->user()->hasAnyPermission(['edit_trip_types'])) {
                $string .= '<a  href="' . url('/admin/trip_types/' . $trip_type->id . '/edit') .
                    '" class="btn btn-sm btn-secondary"><i class="fa fa-lg fa-edit"></i></a>';
//                }
/*                $string .= ' <a  href="' . url('/admin/trip_types/' . $trip_type->id) .
                    '" class="btn btn-sm btn-info"><i class="fa fa-lg fa-eye"></i></a>';*/
//                if(auth()->user()->hasAnyPermission(['delete_trip_types'])) {
                $string .= ' <button type="button" class="btn btn-sm btn-danger delete-btn" data-id="' . $trip_type->id .
                    '"><i class="fa fa-lg fa-trash-o"></i></button>';
//                }
                return $string;
            })->make(true);
    }


}
