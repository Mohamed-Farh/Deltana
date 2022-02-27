<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AboutRequest;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //هنا هنعطي لكل واحد الدور بتاعه و صلاحياته
        if (!\auth()->user()->ability('superAdmin', 'manage_about,show_about')) {
            return redirect('admin/index');
        }

        $about = About::first();

        return view('backend.abouts.index', compact('about'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_about,show_about')) {
            return redirect('admin/index');
        }

        return view('backend.abouts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AboutRequest $request)
    {
        DB::beginTransaction();
        try {
            if (!\auth()->user()->ability('superAdmin', 'manage_about,show_about')) {
                return redirect('admin/index');
            }

            $input['main']          = $request->main;
            $input['work']   = $request->work;
            $input['performance']      = $request->performance;
            $input['quality']         = $request->quality;
            $input['maintenance']   = $request->maintenance;

            if ($image = $request->file('image')) {
                $filename = time() . md5(uniqid()) .'.'.$image->getClientOriginalExtension();
                $path = ('public/assets/about/' . $filename);
                $path_data = ('assets/about/' . $filename);
                Image::make($image->getRealPath())->resize(450, 450, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100);
                $input['image']  = $path_data;
            }

            $about = About::create($input);

            if ($request->images && count($request->images) > 0) {
                $i = 1;
                foreach ($request->images as $file) {
                    $filename = time() . md5(uniqid()) .'-'.$i.'.'.$file->getClientOriginalExtension();
                    $file_size = $file->getSize();
                    $file_type = $file->getMimeType();
                    $path = ('public/assets/about/' . $filename);
                    $path_data = ('assets/about/' . $filename);
                    Image::make($file->getRealPath())->resize(450, 450, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path, 100);

                    $about->media()->create([
                        'file_name'     => $path_data,
                        'file_size'     => $file_size,
                        'file_type'     => $file_type,
                        'file_status'   => true,
                        'file_sort'     => $i,
                    ]);
                    $i++;
                }
            }

            DB::commit();
            return redirect()->route('admin.abouts.index')->with([
                'message' => 'About Us Created Successfully',
                'alert-type' => 'success'
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_about,display_about')) {
            return redirect('admin/index');
        }

        return view('backend.abouts.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_about,update_about')) {
            return redirect('admin/index');
        }

        return view('backend.abouts.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AboutRequest $request, About $about)
    {
        DB::beginTransaction();
        try {
            if (!\auth()->user()->ability('superAdmin', 'manage_about,show_about')) {
                return redirect('admin/index');
            }

            $input['main']          = $request->main;
            $input['work']   = $request->work;
            $input['performance']      = $request->performance;
            $input['quality']         = $request->quality;
            $input['maintenance']   = $request->maintenance;

            if ($image = $request->file('image')) {
                if ($about->image != null && is_file('public/'.$about->image)) {
                    unlink('public/'.$about->image);
                }
                $filename = time() . md5(uniqid()) .'.'.$image->getClientOriginalExtension();
                $path = ('public/assets/about/' . $filename);
                $path_data = ('assets/about/' . $filename);
                Image::make($image->getRealPath())->resize(450, 450, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100);
                $input['image']  = $path_data;
            }

            $about->update($input);

            if ($request->images && count($request->images) > 0) {
                $i = $about->media()->count() + 1;
                foreach ($request->images as $file) {
                    $filename = time() . md5(uniqid()) .'-'.$i.'.'.$file->getClientOriginalExtension();
                    $file_size = $file->getSize();
                    $file_type = $file->getMimeType();
                    $path = ('public/assets/about/' . $filename);
                    $path_data = ('assets/about/' . $filename);
                    Image::make($file->getRealPath())->resize(450, 450, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path, 100);

                    $about->media()->create([
                        'file_name'     => $path_data,
                        'file_size'     => $file_size,
                        'file_type'     => $file_type,
                        'file_status'   => true,
                        'file_sort'     => $i,
                    ]);
                    $i++;
                }
            }

            DB::commit();
            return redirect()->route('admin.abouts.index')->with([
                'message' => 'About Us Updated Successfully',
                'alert-type' => 'success'
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        //
    }



    public function removeImages(Request $request)
    {

        if (!\auth()->user()->ability('superAdmin', 'manage_about,show_about')) {
            return redirect('admin/index');
        }

        $about = About::findOrFail($request->about_id);
        $image   = $about->media()->whereId($request->image_id)->first();
        if ($image) {
            if (is_file('public/'.$image->file_name)) {
                unlink('public/'.$image->file_name);
            }
        }
        $image->delete();
        return true;
    }


    public function removeImage(Request $request)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_about,show_about')) {
            return redirect('admin/index');
        }

        $about = About::whereId($request->about_id)->first();
        if ($about) {
            if (is_file('public/'.$about->image)) {
                unlink('public/'.$about->image);

                $about->image = null;
                $about->save();
            }
        }
        return true;
    }


}
