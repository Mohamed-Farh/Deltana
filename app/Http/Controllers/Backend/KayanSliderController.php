<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProjectRequest;
use App\Models\Project;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class KayanSliderController extends Controller
{

    public function index()
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_kayan,kayan_slider')) {
            return redirect('admin/index');
        }

        $projects = Project::whereType('slider')->whereShowIn('kayan_slider')->orderBy('id' ,'desc')->paginate(10);
        $head = 'Kayan Slider';
        $route = '.kayan.sliders.';

        return view('backend.projects.index', compact('projects', 'head', 'route'));
    }


    public function create()
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_kayan,kayan_slider')) {
            return redirect('admin/index');
        }

        $head = 'Kayan Slider';
        $route = '.kayan.sliders.';
        return view('backend.projects.create', compact('head', 'route'));
    }


    public function store(ProjectRequest $request)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_kayan,kayan_slider')) {
            return redirect('admin/index');
        }

        $input['title']     = $request->title;
        $input['text']      = $request->text;
        $input['button']    = $request->button;
        $input['video_src'] = $request->video_src;
        $input['status']    = $request->status;
        $input['show_in']   = 'kayan_slider';
        $input['type']      = 'slider';

        if ($image = $request->file('image')) {
            $filename = time() . md5(uniqid()) .'.'.$image->getClientOriginalExtension();
            $path = ('public/assets/kayan_slider/' . $filename);
            $path_data = ('assets/kayan_slider/' . $filename);
            // Image::make($image->getRealPath())->resize(600, 450, function ($constraint) {
            //     $constraint->aspectRatio();
            //     $constraint->upsize();
            // })->save($path, 100);

            Image::make($image->getRealPath())->resize(800, 550)->save($path, 100);
            $input['image']  = $path_data;
        }

        Project::create($input);

        return redirect()->route('admin.kayan.sliders.index')->with([
            'message' => 'Kayan Slider Created Successfully',
            'alert-type' => 'success'
        ]);
    }


    public function show($id)
    {
        //
    }

    public function edit(Project $slider)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_kayan,kayan_slider')) {
            return redirect('admin/index');
        }

        $head = 'Kayan Slider';
        $route = '.kayan.sliders.';
        $project = $slider;
        return view('backend.projects.edit', compact('project','head', 'route','project'));
    }


    public function update(ProjectRequest $request, Project $slider)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_kayan,kayan_slider')) {
            return redirect('admin/index');
        }

        $input['title']     = $request->title;
        $input['text']      = $request->text;
        $input['button']    = $request->button;
        $input['video_src'] = $request->video_src;
        $input['status']    = $request->status;

        if ($image = $request->file('image')) {

            if ($slider->image != null && is_file('public/'.$slider->image)) {
                unlink('public/'.$slider->image);
            }

            $filename = time() . md5(uniqid()) .'.'.$image->getClientOriginalExtension();
            $path = ('public/assets/kayan_slider/' . $filename);
            $path_data = ('assets/kayan_slider/' . $filename);
            // Image::make($image->getRealPath())->resize(600, 450, function ($constraint) {
            //     $constraint->aspectRatio();
            //     $constraint->upsize();
            // })->save($path, 100);

            Image::make($image->getRealPath())->resize(800, 550)->save($path, 100);
            $input['image']  = $path_data;
        }

        $slider->update($input);

        return redirect()->route('admin.kayan.sliders.index')->with([
            'message' => 'Kayan Slider Updated Successfully',
            'alert-type' => 'success'
        ]);
    }


    public function destroy(Project $slider)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_kayan,kayan_slider')) {
            return redirect('admin/index');
        }

        if ($slider->image != null && is_file('public/'.$slider->image)) {
            unlink('public/'.$slider->image);
        }
        $slider->delete();

        return redirect()->route('admin.kayan.sliders.index')->with([
            'message' => 'Kayan Slider Deleted Successfully',
            'alert-type' => 'success'
        ]);

    }


    public function removeImage(Request $request)
    {

        if (!\auth()->user()->ability('superAdmin', 'manage_kayan,kayan_slider')) {
            return redirect('admin/index');
        }

        $project = Project::whereId($request->project_id)->first();
        if ($project) {
            if (is_file('public/'.$project->image)) {
                unlink('public/'.$project->image);

                $project->image = null;
                $project->save();
            }
        }
        return true;
    }

}

