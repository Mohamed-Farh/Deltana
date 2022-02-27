<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Apply;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;

class ApplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_careers,show_applies')) {
            return redirect('admin/index');
        }

        $applies = Apply::when(\request()->keyword !=null, function($query){
            $query->search(\request()->keyword);
        })
        ->when(\request()->status !=null, function($query){
            $query->whereStatus(\request()->status);
        })
        ->orderBy(\request()->sort_by ?? 'id' ,  \request()->order_by ?? 'desc')

        ->paginate(\request()->limit_by ?? 10);

        return view('backend.applies.index', compact('applies'));
    }


    public function destroy(Apply $apply)
    {
        if($apply->file)
        {
            if (is_file('public/files/uploads/'.$apply->file) ) {
                unlink('public/files/uploads/'.$apply->file);
            }
        }
        $apply->delete();

        return redirect()->route('admin.applies.index')->with([
            'message' => 'Request Deleted Successfully',
            'alert-type' => 'success'
        ]);
    }

}
