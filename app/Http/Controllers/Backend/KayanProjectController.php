<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProjectRequest;
use App\Models\Project;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class KayanProjectController extends Controller
{

    public function index()
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_kayan,Kayan_project')) {
            return redirect('admin/index');
        }

        $projects = Project::whereType('project')->whereShowIn('kayan_project')->orderBy('id' ,'desc')->paginate(10);
        $head = 'Kayan Project';
        $route = '.kayan.projects.';

        return view('backend.projects.index', compact('projects', 'head', 'route'));
    }


    public function create()
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_kayan,Kayan_project')) {
            return redirect('admin/index');
        }

        $head = 'Kayan Project';
        $route = '.kayan.projects.';
        return view('backend.projects.create', compact('head', 'route'));
    }


    public function store(ProjectRequest $request)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_kayan,Kayan_project')) {
            return redirect('admin/index');
        }

        $input['title']     = $request->title;
        $input['text']      = $request->text;
        $input['button']    = $request->button;
        $input['video_src'] = $request->video_src;
        $input['status']    = $request->status;
        $input['show_in']   = 'kayan_project';
        $input['type']      = 'project';

        if ($image = $request->file('image')) {
            $filename = time() . md5(uniqid()) .'.'.$image->getClientOriginalExtension();
            $path = ('public/assets/kayan_project/' . $filename);
            $path_data = ('assets/kayan_project/' . $filename);
            Image::make($image->getRealPath())->resize(450, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);
            $input['image']  = $path_data;
        }

        Project::create($input);

        return redirect()->route('admin.kayan.projects.index')->with([
            'message' => 'Kayan Project Created Successfully',
            'alert-type' => 'success'
        ]);
    }


    public function show($id)
    {
        //
    }

    public function edit(Project $project)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_kayan,Kayan_project')) {
            return redirect('admin/index');
        }

        $head = 'Kayan Project';
        $route = '.kayan.projects.';
        $project = $project;
        return view('backend.projects.edit', compact('project','head', 'route','project'));
    }


    public function update(ProjectRequest $request, Project $project)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_kayan,Kayan_project')) {
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
            $path = ('public/assets/kayan_project/' . $filename);
            $path_data = ('assets/kayan_project/' . $filename);
            Image::make($image->getRealPath())->resize(450, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);
            $input['image']  = $path_data;
        }

        $project->update($input);

        return redirect()->route('admin.kayan.projects.index')->with([
            'message' => 'Kayan Project Updated Successfully',
            'alert-type' => 'success'
        ]);
    }


    public function destroy(Project $project)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_kayan,Kayan_project')) {
            return redirect('admin/index');
        }

        if ($project->image != null && is_file('public/'.$project->image)) {
            unlink('public/'.$project->image);
        }
        $project->delete();

        return redirect()->route('admin.kayan.projects.index')->with([
            'message' => 'Kayan Project Deleted Successfully',
            'alert-type' => 'success'
        ]);

    }


    public function removeImage(Request $request)
    {

        if (!\auth()->user()->ability('superAdmin', 'manage_kayan,Kayan_project')) {
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


