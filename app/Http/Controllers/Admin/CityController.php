<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Country;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CityController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return view('admin.cities.index', compact('countries'));
    }

    public function create()
    {
        $countries = Country::all();
        return view('admin.cities.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $rules = [
            'country_id' => 'required|exists:countries,id',
        ];
        foreach (locales() as $key => $language) {
            $rules['name_' . $key] = 'required|string|max:255';
        }
        $this->validate($request, $rules);
        $data = $request->only('country_id');
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('public');
            $data['image'] = $image;
        }
        foreach (locales() as $key => $language) {
            $data[$key] = ['name' => $request->get('name_' . $key)];
        }
        City::query()->create($data);
        if ($request->ajax()) {
            return response()->json(['status' => true]);
        }
        Session::flash('success_message', __('common.item_added'));
        return redirect('admin/cities');
    }

    public function edit($id, Request $request)
    {
        $city = City::query()->find($id);
        $countries = Country::all();
        return view('admin.cities.edit', compact('city', 'countries'));
    }

    public function update($id, Request $request)
    {
        $city = City::query()->find($id);
        $rules = [
            'country_id' => 'required|exists:countries,id',
        ];
        foreach (locales() as $key => $language) {
            $rules['name_' . $key] = 'required|string|max:255';
        }
        $this->validate($request, $rules);
        $data = $request->only('country_id');
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('public');
            $data['image'] = $image;
        }
        foreach (locales() as $key => $language) {
            if ($request->get('name_' . $key)) {
                $data[$key]['name'] = $request->get('name_' . $key);
            }
        }
        $city->update($data);
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
            City::query()->whereIn('id', explode(',', $request->ids))
                ->update(['status' => $request->status]);
        } catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
        return response()->json(['status' => true]);
    }

    public function destroy($id)
    {
        try {
            City::query()->whereIn('id', explode(',', $id))->delete();
        } catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
        return response()->json(['status' => true]);
    }

    public function indexTable(Request $request)
    {
        $cities = City::query()->
        join('city_translations as t', function ($join) {
            $join->on('t.city_id', '=', 'cities.id')->where('t.locale', '=', app()->getLocale());
        })->select('cities.*');
        return Datatables::of($cities)
            ->filter(function ($query) use ($request) {
                if ($request->name) {
                    $query->whereTranslationLike('name', "%$request->name%");
                }
                if ($request->country_id) {
                    $query->where('country_id', $request->country_id);
                }
                if (!is_null($request->status)) {
                    $query->where('status', $request->status);
                }
            })->addColumn('action', function ($city) {

                $string = '<a  href="' . url('/admin/cities/' . $city->id . '/edit') .
                    '" class="btn btn-sm btn-info"><i class="fa fa-edit"></i>' . __("common.edit") . '</a>';

                $string .= ' <button type="button" class="btn btn-sm btn-danger delete-btn" data-id="' . $city->id .
                    '"><i class="fa fa-trash-o"></i>' . __("common.delete") . '</button>';

                return $string;
            })->make(true);
    }

}
