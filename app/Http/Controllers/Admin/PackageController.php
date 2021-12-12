<?php

namespace App\Http\Controllers\Admin;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PackageController extends Controller
{
    public function index()
    {
        return view('admin.packages.index');
    }

    public function create()
    {
        return view('admin.packages.create');
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
        Package::query()->create($data);
        if ($request->ajax()) {
            return response()->json(['status' => true]);
        }
        Session::flash('success_message', __('common.item_added'));
        return redirect('admin/packages');
    }

    public function edit($id, Request $request)
    {
        $package = Package::query()->find($id);
        return view('admin.packages.edit', compact('package'));
    }

    public function show($id, Request $request)
    {
        $package = Package::query()->find($id);
        return view('admin.packages.show', compact('package'));
    }

    public function update($id, Request $request)
    {
        $package = Package::query()->find($id);
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
        $package->update($data);
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
            Package::query()->whereIn('id', explode(',', $request->ids))
                ->update(['status' => $request->status]);
        } catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
        return response()->json(['status' => true]);
    }

    public function destroy($id)
    {
        try {
            Package::query()->whereIn('id', explode(',', $id))->delete();
        } catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
        return response()->json(['status' => true]);
    }

    public function indexTable(Request $request)
    {
        $packages = Package::query()->orderByDesc('id');
        return Datatables::of($packages)
            ->filter(function ($query) use ($request) {
                if ($request->name) {
                    $locale = app()->getLocale();
                    $query->where("name->$locale", 'Like', "%" . $request->name . "%");
                }
            })->addColumn('action', function ($package) {

                $string = '';
//                if(auth()->user()->hasAnyPermission(['edit_packages'])) {
                $string .= '<a  href="' . url('/admin/packages/' . $package->id . '/edit') .
                    '" class="btn btn-sm btn-secondary"><i class="fa fa-lg fa-edit"></i></a>';
//                }
/*                $string .= ' <a  href="' . url('/admin/packages/' . $package->id) .
                    '" class="btn btn-sm btn-info"><i class="fa fa-lg fa-eye"></i></a>';*/
//                if(auth()->user()->hasAnyPermission(['delete_packages'])) {
                $string .= ' <button type="button" class="btn btn-sm btn-danger delete-btn" data-id="' . $package->id .
                    '"><i class="fa fa-lg fa-trash-o"></i></button>';
//                }
                return $string;
            })->make(true);
    }


}
