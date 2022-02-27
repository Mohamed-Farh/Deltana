<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProjectDetailsRequest;
use App\Models\ProjectDetail;
use App\Models\ProjectDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class ProjectDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_our_work,project_details')) {
            return redirect('admin/index');
        }

        $projectDetails = ProjectDetails::when(\request()->keyword !=null, function($query){
                $query->search(\request()->keyword);
            })
            ->when(\request()->status !=null, function($query){
                $query->whereStatus(\request()->status);
            })
            ->when(\request()->top !=null, function($query){
                $query->where('top', \request()->top);
            })
            ->orderBy(\request()->sort_by ?? 'id' ,  \request()->order_by ?? 'desc')

            ->paginate(\request()->limit_by ?? 10);

        return view('backend.projectDetails.index', compact('projectDetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_our_work,project_details')) {
            return redirect('admin/index');
        }

        return view('backend.projectDetails.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectDetailsRequest $request)
    {
        DB::beginTransaction();
        try {
            if (!\auth()->user()->ability('superAdmin', 'manage_our_work,project_details')) {
                return redirect('admin/index');
            }

            $input['title']          = $request->title;
            $input['category']   = $request->category;
            $input['text']      = $request->text;
            $input['technology']         = $request->technology;
            $input['link']   = $request->link;
            $input['video']          = $request->video;
            $input['top']   = $request->top;
            $input['status']      = $request->status;

            if ($image = $request->file('image')) {
                $filename = time() . md5(uniqid()) .'.'.$image->getClientOriginalExtension();
                $path = ('public/assets/projectDetails/' . $filename);
                $path_data = ('assets/projectDetails/' . $filename);
                Image::make($image->getRealPath())->resize(800, 550)->save($path, 100);
                $input['image']  = $path_data;
            }

            $projectDetailss = ProjectDetails::create($input);

            if ($request->images && count($request->images) > 0) {
                $i = 1;
                foreach ($request->images as $file) {
                    $filename = time() . md5(uniqid()) .'-'.$i.'.'.$file->getClientOriginalExtension();
                    $file_size = $file->getSize();
                    $file_type = $file->getMimeType();
                    $path = ('public/assets/projectDetails/' . $filename);
                    $path_data = ('assets/projectDetails/' . $filename);
                    Image::make($file->getRealPath())->resize(800, 550)->save($path, 100);
                    $input['image']  = $path_data;

                    $projectDetailss->media()->create([
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
            return redirect()->route('admin.our-work.projectDetails.index')->with([
                'message' => 'Project Details Created Successfully',
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
        if (!\auth()->user()->ability('superAdmin', 'manage_our_work,project_details')) {
            return redirect('admin/index');
        }

        return view('backend.projectDetails.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectDetails $projectDetail)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_our_work,project_details')) {
            return redirect('admin/index');
        }

        return view('backend.projectDetails.edit', compact('projectDetail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectDetailsRequest $request, ProjectDetails $projectDetail)
    {
        DB::beginTransaction();
        try {
            if (!\auth()->user()->ability('superAdmin', 'manage_our_work,project_details')) {
                return redirect('admin/index');
            }

            $input['title']          = $request->title;
            $input['category']   = $request->category;
            $input['text']      = $request->text;
            $input['technology']         = $request->technology;
            $input['link']   = $request->link;
            $input['video']          = $request->video;
            $input['top']   = $request->top;
            $input['status']      = $request->status;

            if ($image = $request->file('image')) {
                if ($projectDetail->image != null && is_file('public/'.$projectDetail->image)) {
                    unlink('public/'.$projectDetail->image);
                }
                $filename = time() . md5(uniqid()) .'.'.$image->getClientOriginalExtension();
                $path = ('public/assets/projectDetails/' . $filename);
                $path_data = ('assets/projectDetails/' . $filename);
                // Image::make($image->getRealPath())->resize(600, 450)->save($path, 100);
                // $input['image']  = $path;

                Image::make($image->getRealPath())->resize(800, 550)->save($path, 100);
                $input['image']  = $path_data;
            }

            $projectDetail->update($input);

            if ($request->images && count($request->images) > 0) {
                $i = $projectDetail->media()->count() + 1;
                foreach ($request->images as $file) {
                    $filename = time() . md5(uniqid()) .'-'.$i.'.'.$file->getClientOriginalExtension();
                    $file_size = $file->getSize();
                    $file_type = $file->getMimeType();
                    $path = ('public/assets/projectDetails/' . $filename);
                    $path_data = ('assets/projectDetails/' . $filename);
                    Image::make($file->getRealPath())->resize(800, 550)->save($path, 100);
                    $input['image']  = $path_data;

                    $projectDetail->media()->create([
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
            return redirect()->route('admin.our-work.projectDetails.index')->with([
                'message' => 'Project Details Updated Successfully',
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
    public function destroy(ProjectDetails $projectDetail)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_our_work,project_details')) {
            return redirect('admin/index');
        }

        if ($projectDetail->image != null && is_file('public/'.$projectDetail->image)) {
            unlink('public/'.$projectDetail->image);
        }

        if($projectDetail->media()->count() > 0 )
        {
            foreach ($projectDetail->media as $media)
            {
                if (is_file('public/'.$media->file_name)) {
                    unlink('public/'.$media->file_name);
                }
                $media->delete();
            }
        }
        $projectDetail->delete();

        return redirect()->route('admin.our-work.projectDetails.index')->with([
            'message' => 'Project Details Deleted Successfully',
            'alert-type' => 'success'
        ]);

    }



    public function removeImages(Request $request)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_our_work,project_details')) {
            return redirect('admin/index');
        }

        $projectDetail = ProjectDetails::findOrFail($request->projectDetail_id);
        $image   = $projectDetail->media()->whereId($request->image_id)->first();
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
        if (!\auth()->user()->ability('superAdmin', 'manage_our_work,project_details')) {
            return redirect('admin/index');
        }

        $projectDetails = projectDetails::whereId($request->projectDetails_id)->first();
        if ($projectDetails) {
            if (is_file('public/'.$projectDetails->image)) {
                unlink('public/'.$projectDetails->image);

                $projectDetails->image = null;
                $projectDetails->save();
            }
        }
        return true;
    }


}
