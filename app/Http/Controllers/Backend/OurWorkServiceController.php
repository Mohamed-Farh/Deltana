<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ServiceRequest;
use App\Models\Service;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class OurWorkServiceController extends Controller
{

    public function index()
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_our_work,our_work_services')) {
            return redirect('admin/index');
        }

        $services = Service::whereType('our_wok')->orderBy('id' ,'desc')->paginate(10);
        $head = 'Our Work Service';
        $route = '.our-work.services.';

        return view('backend.services.index', compact('services', 'head', 'route'));
    }


    public function create()
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_our_work,our_work_services')) {
            return redirect('admin/index');
        }

        $head = 'Our Work Service';
        $route = '.our-work.services.';
        return view('backend.services.create', compact('head', 'route'));
    }


    public function store(ServiceRequest $request)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_our_work,our_work_services')) {
            return redirect('admin/index');
        }

        $input['title']     = $request->title;
        $input['text']      = $request->text;
        $input['status']    = $request->status;
        $input['type']      = 'our_wok';

        if ($image = $request->file('image')) {
            $filename = time() . md5(uniqid()) .'.'.$image->getClientOriginalExtension();
            $path = ('public/assets/our_work_services/' . $filename);
            $path_data = ('assets/our_work_services/' . $filename);
            Image::make($image->getRealPath())->resize(450, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);
            $input['image']  = $path_data;
        }

        Service::create($input);

        return redirect()->route('admin.our-work.services.index')->with([
            'message' => 'Our Work Service Created Successfully',
            'alert-type' => 'success'
        ]);
    }


    public function show($id)
    {
        //
    }

    public function edit(Service $service)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_our_work,our_work_services')) {
            return redirect('admin/index');
        }

        $head = 'Our Work Service';
        $route = '.our-work.services.';
        $service = $service;
        return view('backend.services.edit', compact('service','head', 'route','service'));
    }


    public function update(ServiceRequest $request, Service $service)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_our_work,our_work_services')) {
            return redirect('admin/index');
        }

        $input['title']     = $request->title;
        $input['text']      = $request->text;
        $input['status']    = $request->status;

        if ($image = $request->file('image')) {

            if ($service->image != null && is_file('public/'.$service->image)) {
                unlink('public/'.$service->image);
            }

            $filename = time() . md5(uniqid()) .'.'.$image->getClientOriginalExtension();
            $path = ('public/assets/our_work_services/' . $filename);
            $path_data = ('assets/our_work_services/' . $filename);
            Image::make($image->getRealPath())->resize(450, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);
            $input['image']  = $path_data;
        }

        $service->update($input);

        return redirect()->route('admin.our-work.services.index')->with([
            'message' => 'Our Work Service Updated Successfully',
            'alert-type' => 'success'
        ]);
    }


    public function destroy(Service $service)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_our_work,our_work_services')) {
            return redirect('admin/index');
        }

        if ($service->image != null && is_file('public/'.$service->image)) {
            unlink('public/'.$service->image);
        }
        $service->delete();

        return redirect()->route('admin.our-work.services.index')->with([
            'message' => 'Our Work Service Deleted Successfully',
            'alert-type' => 'success'
        ]);

    }


    public function removeImage(Request $request)
    {

        if (!\auth()->user()->ability('superAdmin', 'manage_our_work,our_work_services')) {
            return redirect('admin/index');
        }

        $service = Service::whereId($request->service_id)->first();
        if ($service) {
            if (is_file('public/'.$service->image)) {
                unlink('public/'.$service->image);

                $service->image = null;
                $service->save();
            }
        }
        return true;
    }

}

