<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProcessRequest;
use App\Models\Process;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_settings,show_processes')) {
            return redirect('admin/index');
        }

        $processes = Process::orderBy('id', 'desc')->paginate(10);

        return view('backend.processes.index', compact('processes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_settings,show_processes')) {
            return redirect('admin/index');
        }

        return view('backend.processes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProcessRequest $request)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_settings,show_processes')) {
            return redirect('admin/index');
        }

        $input['step_no']      = $request->step_no;
        $input['step_title']    = $request->step_title;
        $input['title']      = $request->title;
        $input['text']    = $request->text;

        if ($image = $request->file('image')) {
            $filename = time() . md5(uniqid()) .'.'.$image->getClientOriginalExtension();
            $path = ('public/assets/processes/' . $filename);
            $path_data = ('assets/processes/' . $filename);
            Image::make($image->getRealPath())->resize(450, null, function ($constraint) {
                $constraint->aspectRatio();  //لتنسيق العرض مع الطول
            })->save($path, 100);  //الجودة و درجة الوضوح تكون 100%
            $input['image']  = $path_data;
        }

        Process::create($input);

        return redirect()->route('admin.processes.index')->with([
            'message' => 'Process Created Successfully',
            'alert-type' => 'success'
        ]);
    }


    public function show($id)
    {
        //
    }

    public function edit(Process $process)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_settings,show_processes')) {
            return redirect('admin/index');
        }

        return view('backend.processes.edit', compact('process'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProcessRequest $request, Process $process)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_settings,show_processes')) {
            return redirect('admin/index');
        }

        $input['step_title']    = $request->step_title;
        $input['title']      = $request->title;
        $input['text']    = $request->text;

        if ($image = $request->file('image')) {

            if ($process->image != null && is_file('public/'.$process->image)) {
                unlink('public/'.$process->image);
            }

            $filename = time() . md5(uniqid()) .'.'.$image->getClientOriginalExtension();
            $path = ('public/assets/processes/' . $filename);
            $path_data = ('assets/processes/' . $filename);
            Image::make($image->getRealPath())->resize(450, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);
            $input['image']  = $path_data;
        }

        $process->update($input);

        return redirect()->route('admin.processes.index')->with([
            'message' => 'Process Updated Successfully',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Process $process)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_settings,show_processes')) {
            return redirect('admin/index');
        }

        if ($process->image != null && is_file('public/'.$process->image)) {
            unlink('public/'.$process->image);
        }
        $process->delete();

        return redirect()->route('admin.processes.index')->with([
            'message' => 'Process Deleted Successfully',
            'alert-type' => 'success'
        ]);

    }

    public function removeImage(Request $request)
    {
        // dd($request->all());

        if (!\auth()->user()->ability('superAdmin', 'manage_settings,show_processes')) {
            return redirect('admin/index');
        }

        $process = Process::whereId($request->process_id)->first();
        if ($process) {
            if (is_file('public/'.$process->image)) {
                unlink('public/'.$process->image);

                $process->image = null;
                $process->save();
            }
        }
        return true;
    }

}

