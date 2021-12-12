<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SliderController extends Controller
{
    public function index ()
    {
        return view('admin.sliders.index');
    }

    public function create ()
    {
        return view('admin.sliders.create');
    }

    public function store (Request $request)
    {
        $rules = [
            'type' => 'required|in:1,2',
            'image' => 'required|image',
            'product_id' => 'nullable|required_if:type,1|exists:products,id',
            'url' => 'nullable|required_if:type,2|string|url',
            'order' => 'required|numeric|unique:sliders,order'
        ];
        foreach (locales() as $key => $language) {
            $rules['name_' . $key] = 'required|string|max:255';
        }
        $this->validate($request, $rules);
        $data = $request->only('type', 'url', 'product_id', 'order');
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('public');
            $data['image'] = $image;
        }
        foreach (locales() as $key => $language) {
            $data[$key] = ['name' => $request->get('name_' . $key)];
        }
        Slider::query()->create($data);
        if ($request->ajax()) {
            return response()->json(['status' => true]);
        }
        Session::flash('success_message', __('common.item_added'));
        return redirect('admin/sliders');
    }

    public function edit ($id, Request $request)
    {
        $slider = Slider::query()->find($id);
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update ($id, Request $request)
    {
        $slider = Slider::query()->find($id);
        $rules = [
            'type' => 'required|in:1,2',
            'image' => 'nullable|image',
            'product_id' => 'nullable|required_if:type,1|exists:products,id',
            'url' => 'nullable|required_if:type,2|string|url',
            'order' => 'required|numeric|unique:sliders,order,'.$id
        ];
        foreach (locales() as $key => $language) {
            $rules['name_' . $key] = 'required|string|max:255';
        }
        $this->validate($request, $rules);
        $data = $request->only('type', 'url', 'product_id', 'order');
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('public');
            $data['image'] = $image;
        }
        foreach (locales() as $key => $language) {
            if ($request->get('name_' . $key)) {
                $data[$key]['name'] = $request->get('name_' . $key);
            }
        }
        $slider->update($data);
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
            Slider::query()->whereIn('id', explode(',', $request->ids))->update(['status' => $request->status]);
        } catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
        return response()->json(['status' => true]);
    }

    public function destroy ($id)
    {
        try {
            Slider::query()->whereIn('id', explode(',', $id))->update(['order' => null]);
            Slider::query()->whereIn('id', explode(',', $id))->delete();
        } catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
        return response()->json(['status' => true]);
    }

    public function indexTable (Request $request)
    {
        $sliders = Slider::query()->join('slider_translations as t', function ($join) {
            $join->on('t.slider_id', '=', 'sliders.id')->where('t.locale', '=', app()->getLocale());
        })->select('sliders.*');
        return Datatables::of($sliders)
            ->filter(function ($query) use ($request) {
                if ($request->name) {
                    $query->whereTranslationLike('name', "%$request->name%");
                }
                if (!is_null($request->status)) {
                    $query->where('status', $request->status);
                }
            })->addColumn('action', function ($slider) {

                $string = '<a  href="' . url('/admin/sliders/' . $slider->id . '/edit') .
                    '" class="btn btn-sm btn-info"><i class="fa fa-edit"></i>' . __("common.edit") . '</a>';

                $string .= ' <button type="button" class="btn btn-sm btn-danger delete-btn" data-id="' . $slider->id .
                    '"><i class="fa fa-trash-o"></i>' . __("common.delete") . '</button>';

                return $string;
            })->make(true);
    }

}
