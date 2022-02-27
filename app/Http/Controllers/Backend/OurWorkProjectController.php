<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProjectRequest;
use App\Models\Project;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class OurWorkProjectController extends Controller
{

    public function index()
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_our_work,our_work_project')) {
            return redirect('admin/index');
        }

        $projects = Project::whereType('project')->whereShowIn('our_work_project')->orderBy('id' ,'desc')->paginate(10);
        $head = 'Our Work Project';
        $route = '.our-work.projects.';

        return view('backend.projects.index', compact('projects', 'head', 'route'));
    }


    public function create()
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_our_work,our_work_project')) {
            return redirect('admin/index');
        }

        $head = 'Our Work Project';
        $route = '.our-work.projects.';
        return view('backend.projects.create', compact('head', 'route'));
    }


    public function store(ProjectRequest $request)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_our_work,our_work_project')) {
            return redirect('admin/index');
        }

        $input['title']     = $request->title;
        $input['text']      = $request->text;
        $input['button']    = $request->button;
        $input['video_src'] = $request->video_src;
        $input['status']    = $request->status;
        $input['show_in']   = 'our_work_project';
        $input['type']      = 'project';

        if ($image = $request->file('image')) {
            $filename = time() . md5(uniqid()) .'.'.$image->getClientOriginalExtension();
            $path = ('public/assets/our_work_project/' . $filename);
            $path_data = ('assets/our_work_project/' . $filename);
            Image::make($image->getRealPath())->resize(450, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);
            $input['image']  = $path_data;
        }

        Project::create($input);

        return redirect()->route('admin.our-work.projects.index')->with([
            'message' => 'Our Work Project Created Successfully',
            'alert-type' => 'success'
        ]);
    }


    public function show($id)
    {
        //
    }

    public function edit(Project $project)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_our_work,our_work_project')) {
            return redirect('admin/index');
        }

        $head = 'Our Work Project';
        $route = '.our-work.projects.';
        $project = $project;
        return view('backend.projects.edit', compact('project','head', 'route','project'));
    }


    public function update(ProjectRequest $request, Project $project)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_our_work,our_work_project')) {
            return redirect('admin/index');
        }

        $input['title']     = $request->title;
        $input['text']      = $request->text;
        $input['button']    = $request->button;
        $input['video_src'] = $request->video_src;
        $input['status']    = $request->status;

        if ($image = $request->file('image')) {

            if ($project->image != null && is_file('public/'.$project->image)) {
                unlink('public/'.$project->image);
            }

            $filename = time() . md5(uniqid()) .'.'.$image->getClientOriginalExtension();
            $path = ('public/assets/our_work_project/' . $filename);
            $path_data = ('assets/our_work_project/' . $filename);
            Image::make($image->getRealPath())->resize(450, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);
            $input['image']  = $path_data;
        }

        $project->update($input);

        return redirect()->route('admin.our-work.projects.index')->with([
            'message' => 'Our Work Project Updated Successfully',
            'alert-type' => 'success'
        ]);
    }


    public function destroy(Project $project)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_our_work,our_work_project')) {
            return redirect('admin/index');
        }

        if ($project->image != null && is_file('public/'.$project->image)) {
            unlink('public/'.$project->image);
        }
        $project->delete();

        return redirect()->route('admin.our-work.projects.index')->with([
            'message' => 'Our Work Project Deleted Successfully',
            'alert-type' => 'success'
        ]);

    }


    public function removeImage(Request $request)
    {

        if (!\auth()->user()->ability('superAdmin', 'manage_our_work,our_work_project')) {
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


