<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\City;
use App\Models\Country;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{

    public function index(Request $request)
    {
        return view('admin.users.index');

    }

    public function create(Request $request)
    {
        return view('admin.users.create');

    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'mobile' => 'required|digits_between:8,14|max:255|unique:users',
            'dob' => 'required|string|date',
            'gender' => 'required|string|in:male,female',
            'password' => 'required|string|min:6',
            'image' => 'required|image',
        ];

        $this->validate($request, $rules);

        $data = $request->only('name', 'email', 'mobile', 'gender');
        $data['password'] = bcrypt($request->password);

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('public');
            $data['image'] = $image;
        }
        $user = User::query()->create($data);

        if ($request->ajax()) {
            return response()->json(['status' => true]);
        }
        Session::flash('success_message', __('common.item_added'));

        return redirect('user/users');
    }

    public function edit($id, Request $request)
    {
        $user = User::query()->findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }
    public function show($id, Request $request)
    {
        $user = User::query()->findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function update($id, Request $request)
    {
        $user = User::query()->find($id);
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'string|email|max:255|unique:users,email,' . $id,
            'mobile' => 'string|digits_between:8,14|unique:users,mobile,' . $id,
            'dob' => 'required|string|date',
            'gender' => 'required|string|in:male,female',
            'password' => 'nullable|string|min:6',
            'image' => 'nullable|image',
        ];

        $this->validate($request, $rules);

        $data = $request->only('name', 'email', 'mobile', 'gender');
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('public');
            $data['image'] = $image;
        }
        $user->update($data);
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
            User::query()->whereIn('id', explode(',', $request->ids))->update(['status' => $request->status]);
        } catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
        return response()->json(['status' => true]);
    }
    public function destroy($id, Request $request)
    {
        $users = User::query()->whereIn('id', explode(',', $id))->get();
        foreach ($users as $user) {
            $user->email = 'deleted '.$user->email;
            $user->mobile = 'deleted '.$user->mobile;
            $user->name = 'deleted '.$user->name;
            $user->save();
            $user->delete();
        }
        return response()->json(['status' => true]);
    }

    public function users(Request $request)
    {
        return view('layout.app');

    }


    public function indexTable(Request $request)
    {
        $users = User::query()->orderByDesc('id');
        return Datatables::of($users)
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

//                $request->merge(['length' => -1]);
            })->addColumn('action', function ($user) {
                $string = '';
//                if(auth()->user()->hasAnyPermission(['edit_drivers'])) {
                $string .= '<a  href="' . url('/admin/users/' . $user->id . '/edit') .
                    '" class="btn btn-sm btn-secondary"><i class="fa fa-lg fa-edit"></i></a>';
//                }
                $string .= ' <a  href="' . url('/admin/users/' . $user->id) .
                    '" class="btn btn-sm btn-info"><i class="fa fa-lg fa-eye"></i></a>';

//                if(auth()->user()->hasAnyPermission(['delete_drivers'])) {
                $string .= ' <button type="button" class="btn btn-sm btn-danger delete-btn" data-id="' . $user->id .
                    '"><i class="fa fa-lg fa-trash-o"></i></button>';
//                }
                return $string;
            })
//            ->editColumn('id', 'ID: {{$id}}')

            ->make(true);
    }

}
