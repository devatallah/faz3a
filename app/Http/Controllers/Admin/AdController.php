<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AdController extends Controller
{
    public function index ()
    {
        return view('admin.ads.index');
    }

    public function create ()
    {
        return view('admin.ads.create');
    }

    public function store (Request $request)
    {
        $rules = [
            'image' => 'required|image',
            'url' => 'required|url',
            'order' => 'required|numeric|unique:ads,order'
        ];
        foreach (locales() as $key => $language) {
            $rules['name_' . $key] = 'required|string|max:255';
        }
        $this->validate($request, $rules);
        $data = $request->only('url', 'order');
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('public');
            $data['image'] = $image;
        }
        foreach (locales() as $key => $language) {
            $data[$key] = ['name' => $request->get('name_' . $key)];
        }
        Ad::query()->create($data);
        if ($request->ajax()) {
            return response()->json(['status' => true]);
        }
        Session::flash('success_message', __('common.item_added'));
        return redirect('admin/ads');
    }

    public function edit ($id, Request $request)
    {
        $ad = Ad::query()->find($id);
        return view('admin.ads.edit', compact('ad'));
    }

    public function update ($id, Request $request)
    {
        $ad = Ad::query()->find($id);
        $rules = [
            'image' => 'nullable|image',
            'url' => 'required|url',
            'order' => 'required|numeric|unique:ads,order,'.$id
        ];
        foreach (locales() as $key => $language) {
            $rules['name_' . $key] = 'required|string|max:255';
        }
        $this->validate($request, $rules);
        $data = $request->only('url', 'order');
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('public');
            $data['image'] = $image;
        }
        foreach (locales() as $key => $language) {
            if ($request->get('name_' . $key)) {
                $data[$key]['name'] = $request->get('name_' . $key);
            }
        }
        $ad->update($data);
        if ($request->ajax()) {
            return response()->json(['status' => true]);
        }
        Session::flash('success_message', __('common.item_edited'));
        return redirect()->back();
    }


    public function updateStatus (Request $request)
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
            Ad::query()->whereIn('id', explode(',', $request->ids))->update(['status' => $request->status]);
        } catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
        return response()->json(['status' => true]);
    }

    public function destroy ($id)
    {
        try {
            Ad::query()->whereIn('id', explode(',', $id))->update(['order' => null]);
            Ad::query()->whereIn('id', explode(',', $id))->delete();
        } catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
        return response()->json(['status' => true]);
    }

    public function indexTable (Request $request)
    {
        $ads = Ad::query()->join('ad_translations as t', function ($join) {
            $join->on('t.ad_id', '=', 'ads.id')->where('t.locale', '=', app()->getLocale());
        })->select('ads.*');
        return Datatables::of($ads)
            ->filter(function ($query) use ($request) {
                if ($request->name) {
                    $query->whereTranslationLike('name', "%$request->name%");
                }
                if (!is_null($request->status)) {
                    $query->where('status', $request->status);
                }
            })->addColumn('action', function ($ad) {

                $string = '<a  href="' . url('/admin/ads/' . $ad->id . '/edit') .
                    '" class="btn btn-sm btn-info"><i class="fa fa-edit"></i>' . __("common.edit") . '</a>';

                $string .= ' <button type="button" class="btn btn-sm btn-danger delete-btn" data-id="' . $ad->id .
                    '"><i class="fa fa-trash-o"></i>' . __("common.delete") . '</button>';

                return $string;
            })->make(true);
    }

}
