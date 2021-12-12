<?php

namespace App\Http\Controllers\Admin;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ContactMessageController extends Controller
{
    public function index()
    {
        return view('admin.contact_messages.index');
    }

    public function show($id, Request $request)
    {
        $contact_message = ContactMessage::query()->find($id);
        return view('admin.contact_messages.show', compact('contact_message'));
    }

    public function edit($id, Request $request)
    {
        $contact_message = ContactMessage::query()->find($id);
        return view('admin.contact_messages.edit', compact('contact_message'));
    }

    public function destroy($id)
    {
        try {
            ContactMessage::query()->whereIn('id', explode(',', $id))->delete();
        } catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
        return response()->json(['status' => true]);
    }

    public function indexTable(Request $request)
    {
        $contact_messages = ContactMessage::query()/*->join('contact_message_translations as t', function ($join) {
            $join->on('t.contact_message_id', '=', 'contact_messages.id')
                ->where('t.locale', '=', app()->getLocale());
        })->groupBy('contact_messages.id')->select('contact_messages.*')*/;
        return Datatables::of($contact_messages)
            ->filter(function ($query) use ($request) {
            })->addColumn('action', function ($contact_message) {
                $string = '';
/*                $string = '<a  href="' . url('/admin/contact_messages/' . $contact_message->id) . '" class="btn btn-sm btn-info">
                        <i class="fa fa-eye"></i> ' . __("common.show") . '</a>';*/
                $string .= ' <button type="button" class="btn btn-sm btn-danger delete-btn" data-id="' . $contact_message->id . '">
                        <i class="fa fa-trash-o"></i>' . __("common.delete") . '</button>';
                return $string;
            })
            ->make(true);
    }

}
