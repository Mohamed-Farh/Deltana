<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\TechnologyRequest;
use App\Models\Technology;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_about,show_technology')) {
            return redirect('admin/index');
        }

        $technologies = Technology::when(\request()->keyword !=null, function($query){
                $query->search(\request()->keyword);
            })
            ->when(\request()->status !=null, function($query){
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id' ,  \request()->order_by ?? 'desc')

            ->paginate(\request()->limit_by ?? 10);

        return view('backend.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_about,show_technology')) {
            return redirect('admin/index');
        }

        return view('backend.technologies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TechnologyRequest $request)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_about,show_technology')) {
            return redirect('admin/index');
        }

        $input['name']      = $request->name;
        $input['status']    = $request->status;

        if ($image = $request->file('icon')) {
            $filename = time() . md5(uniqid()) .'.'.$image->getClientOriginalExtension();
            $path = ('public/assets/technologies/' . $filename);
            $path_data = ('assets/technologies/' . $filename);
            Image::make($image->getRealPath())->resize(300, 200)->save($path, 100);
            $input['icon']  = $path_data;
        }

        Technology::create($input);

        return redirect()->route('admin.technologies.index')->with([
            'message' => 'Technology Created Successfully',
            'alert-type' => 'success'
        ]);
    }


    public function show($id)
    {
        //
    }

    public function edit(Technology $technology)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_about,show_technology')) {
            return redirect('admin/index');
        }

        return view('backend.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TechnologyRequest $request, Technology $technology)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_about,show_technology')) {
            return redirect('admin/index');
        }

        $input['name']      = $request->name;
        $input['status']    = $request->status;

        if ($image = $request->file('icon')) {

            if ($technology->icon != null && is_file('public/'.$technology->icon)) {
                unlink('public/'.$technology->icon);
            }

            $filename = time() . md5(uniqid()) .'.'.$image->getClientOriginalExtension();
            $path = ('public/assets/technologies/' . $filename);
            $path_data = ('assets/technologies/' . $filename);
            Image::make($image->getRealPath())->resize(300, 200)->save($path, 100);
            $input['icon']  = $path_data;
        }

        $technology->update($input);

        return redirect()->route('admin.technologies.index')->with([
            'message' => 'Technology Updated Successfully',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technology)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_about,show_technology')) {
            return redirect('admin/index');
        }

        if ($technology->icon != null && is_file('public/'.$technology->icon)) {
            unlink('public/'.$technology->icon);
        }
        $technology->delete();

        return redirect()->route('admin.technologies.index')->with([
            'message' => 'Technology Deleted Successfully',
            'alert-type' => 'success'
        ]);

    }

    public function removeImage(Request $request)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_about,show_technology')) {
            return redirect('admin/index');
        }

        $technology = Technology::whereId($request->technology_id)->first();
        if ($technology) {
            if (is_file('public/'.$technology->icon)) {
                unlink('public/'.$technology->icon);

                $technology->icon = null;
                $technology->save();
            }
        }
        return true;
    }

}
