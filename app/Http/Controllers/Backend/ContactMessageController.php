<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\ContactService;


class ContactMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_contacts,show_contact_messages')) {
            return redirect('admin/index');
        }

        $contactMessages = ContactMessage::when(\request()->keyword !=null, function($query){
            $query->search(\request()->keyword);
        })
        ->when(\request()->status !=null, function($query){
            $query->whereStatus(\request()->status);
        })
        ->orderBy(\request()->sort_by ?? 'id' ,  \request()->order_by ?? 'desc')

        ->paginate(\request()->limit_by ?? 10);

        return view('backend.contact-messages.index', compact('contactMessages'));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactMessage $contactMessage)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_contacts,show_contact_messages')) {
            return redirect('admin/index');
        }

        if($contactMessage)
        {
            ContactService::where('message_id', $contactMessage->id)->delete();
        }
        $contactMessage->delete();

        return redirect()->route('admin.contact-messages.index')->with([
            'message' => 'Contact Messages Deleted Successfully',
            'alert-type' => 'success'
        ]);

    }

    public function numberMessage()
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_contacts,show_contact_messages')) {
            return redirect('admin/index');
        }

        $data = ContactMessage::where('status', false)->count();
        return response()->json($data);
    }

}

