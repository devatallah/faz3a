<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{

    public function index(Request $request)
    {
        return view('admin.admins.index');

    }

    public function create(Request $request)
    {
        $permissions = Permission::all();
        return view('admin.admins.create', compact('permissions'));

    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'mobile' => 'required|digits_between:8,14|max:255|unique:admins',
            'password' => 'required|min:6',
            'permissions' => 'required|array',
        ];

        $this->validate($request, $rules);

        $data = $request->except('image', 'password', 'permissions');
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('public');
            $data['image'] = $image;
        }
        $data['password'] = bcrypt($request->password);

        $admin = Admin::query()->create($data);
        $admin->givePermissionTo($request->permissions);

/*        if ($request->permissions)
            $admin->givePermissionTo($request->permissions);*/
//        return $admin;
        if ($request->ajax()) {
            return response()->json(['status' => true]);
        }
        Session::flash('success_message', __('common.item_added'));

        return redirect('admin/admins');
    }

    public function edit($id, Request $request)
    {
        $admin = Admin::query()->findOrFail($id);
//        dd($admin->getDirectPermissions());
//        dd($admin->getDirectPermissions()->pluck('id')->toArray());
//        dd(compact('brands', 'models', 'years', 'parts', 'suppliers', 'admin', 'admin_items'));
        $permissions = Permission::all();
        return view('admin.admins.edit', compact('permissions', 'admin'));
    }

    public function update($id, Request $request)
    {
        $admin = Admin::query()->find($id);
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'string|email|max:255|unique:admins,email,' . $id,
            'mobile' => 'string|digits_between:8,14|unique:admins,mobile,' . $id,
            'password' => 'nullable|min:6',
            'permissions' => 'required|array',
        ];

        $this->validate($request, $rules);
        $data = $request->except('image', 'password', 'permissions');
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('public');
            $data['image'] = $image;
        }
        $admin->update($data);
/*        if ($request->permissions) {
            $old_permissions = $admin->getAllPermissions()->pluck('name')->toArray();
            $admin->revokePermissionTo($old_permissions);
            $admin->givePermissionTo($request->permissions);
        }*/
        $old_permissions = $admin->getAllPermissions()->pluck('name')->toArray();
        $admin->revokePermissionTo($old_permissions);
        $admin->givePermissionTo($request->permissions);

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
            Admin::query()->whereIn('id', explode(',', $request->ids))->update(['status' => $request->status]);
        } catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
        return response()->json(['status' => true]);
    }
    public function destroy($id, Request $request)
    {
        $admins = Admin::query()->whereIn('id', explode(',', $id))->get();
        foreach ($admins as $admin) {
            $admin->email = 'deleted '.$admin->email;
            $admin->mobile = 'deleted '.$admin->mobile;
            $admin->name = 'deleted '.$admin->name;
            $admin->save();
            $admin->delete();
        }
        return response()->json(['status' => true]);
    }

    public function admins(Request $request)
    {
        return view('layout.app');

    }


    public function indexTable(Request $request)
    {
//        dd($request->get('category_id'));
        $admins = Admin::query()->where('id','<>',1)->orderByDesc('id');
        return Datatables::of($admins)
            ->filter(function ($query) use ($request) {
                if ($request->get('name')) {
                    $query->where('name', 'like', "%{$request->get('name')}%");
                }
                if ($request->get('email')) {
                    $query->where('email', 'like', "%{$request->get('email')}%");
                }
                if ($request->get('mobile')) {
                    $query->where('mobile', 'like', "%{$request->get('mobile')}%");
                }
                if (!is_null($request->status)) {
                    $query->where('status', $request->status);
                }

//                $request->merge(['length' => -1]);
            })->addColumn('action', function ($admin) {
                $string = '';
                    $string .= '<a  href="' . url('/admin/admins/' . $admin->id . '/edit') . '" class="btn btn-sm btn-info">
                    <i class="fa fa-edit"></i>' . __("common.edit") . '</a>';
                    $string .= ' <button type="button" class="btn btn-sm btn-danger delete-btn" data-id="' . $admin->id . '">
                    <i class="fa fa-trash-o"></i>' . __("common.delete") . '</button>';
                return $string;
            })
//            ->editColumn('id', 'ID: {{$id}}')

            ->make(true);
    }

}
