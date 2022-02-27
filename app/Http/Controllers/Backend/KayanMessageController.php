<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Message;

class KayanMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_kayan,Kayan_messages')) {
            return redirect('admin/index');
        }

        $messages = Message::where('type', 'Kayan')
        ->when(\request()->keyword !=null, function($query){
            $query->search(\request()->keyword);
        })
        ->when(\request()->status !=null, function($query){
            $query->whereStatus(\request()->status);
        })
        ->orderBy(\request()->sort_by ?? 'id' ,  \request()->order_by ?? 'desc')

        ->paginate(\request()->limit_by ?? 10);

        $title = 'Kayan';
        $filter = 'kayan';

        return view('backend.messages.kayan.index', compact('messages', 'title', 'filter'));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_kayan,Kayan_messages')) {
            return redirect('admin/index');
        }

        $message->delete();

        return redirect()->route('admin.messages.index')->with([
            'message' => 'Messages Deleted Successfully',
            'alert-type' => 'success'
        ]);

    }

    public function numberMessage()
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_kayan,Kayan_messages')) {
            return redirect('admin/index');
        }

        $data = Message::where('type', 'Kayan')->where('status', false)->count();

        return response()->json($data);
    }

}

