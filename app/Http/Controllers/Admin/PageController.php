<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use App\Models\Offer;
use App\Models\ServiceRequest;
use App\Models\ServiceRequestTool;
use App\Models\Tool;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PageController extends Controller
{
    public function index()
    {
        return view('admin.pages.index');
    }

    public function edit($id, Request $request)
    {
        $page = Page::query()->find($id);
        return view('admin.pages.edit', compact('page'));
    }

    public function update($id, Request $request)
    {
        $page = Page::query()->find($id);
        $rules = [];
        foreach (locales() as $key => $language) {
            $rules['title_' . $key] = 'required|string|max:255';
            $rules['content_' . $key] = 'required|string';
        }
        $this->validate($request, $rules);
        foreach (locales() as $key => $language) {
            if ($request->get('title_' . $key)) {
                $data['title'][$key] = $request->get('title_' . $key);
            }
            if ($request->get('content_' . $key)) {
                $data['content'][$key] = $request->get('content_' . $key);
            }
        }
        $page->update($data);
        if ($request->ajax()) {
            return response()->json(['status' => true]);
        }
        Session::flash('success_message', __('common.item_edited'));
        return redirect()->back();
    }

    public function indexTable(Request $request)
    {
        $pages = Page::query();
        return Datatables::of($pages)
            ->filter(function ($query) use ($request) {
            })->addColumn('action', function ($page) {
                $string = '<a  href="' . url('/admin/pages/' . $page->id . '/edit') . '" class="btn btn-sm btn-info">
                    <i class="fa fa-edit"></i>' . __("common.edit") . '</a>';
                return $string;
            })
            ->make(true);
    }

}
