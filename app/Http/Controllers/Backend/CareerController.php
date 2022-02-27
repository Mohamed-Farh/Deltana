<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CareerRequest;
use App\Models\Apply;
use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class CareerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_careers,show_careers')) {
            return redirect('admin/index');
        }

        $careers = Career::when(\request()->keyword !=null, function($query){
            $query->search(\request()->keyword);
        })
        ->when(\request()->status !=null, function($query){
            $query->whereStatus(\request()->status);
        })
        ->orderBy(\request()->sort_by ?? 'id' ,  \request()->order_by ?? 'desc')

        ->paginate(\request()->limit_by ?? 10);

        return view('backend.careers.index', compact('careers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_careers,show_careers')) {
            return redirect('admin/index');
        }

        return view('backend.careers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CareerRequest $request)
    {
        DB::beginTransaction();
        try {
            if (!\auth()->user()->ability('superAdmin', 'manage_careers,show_careers')) {
                return redirect('admin/index');
            }

            $input['title']          = $request->title;
            $input['location']   = $request->location;
            $input['type']      = $request->type;
            $input['exp_year']         = $request->exp_year;
            $input['description']   = $request->description;
            $input['requirements']   = $request->requirements;
            $input['status']   = $request->status;

            if ($image = $request->file('image')) {
                $filename = time() . md5(uniqid()) .'.'.$image->getClientOriginalExtension();
                $path = ('public/assets/careers/' . $filename);
                $path_data = ('assets/careers/' . $filename);
                Image::make($image->getRealPath())->resize(450, 450, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100);
                $input['image']  = $path_data;
            }

            Career::create($input);

            DB::commit();
            return redirect()->route('admin.careers.index')->with([
                'message' => 'Career Created Successfully',
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Career $career)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_careers,show_careers')) {
            return redirect('admin/index');
        }

        return view('backend.careers.edit', compact('career'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CareerRequest $request, Career $career)
    {
        DB::beginTransaction();
        try {
            if (!\auth()->user()->ability('superAdmin', 'manage_careers,show_careers')) {
                return redirect('admin/index');
            }

            $input['title']          = $request->title;
            $input['location']   = $request->location;
            $input['type']      = $request->type;
            $input['exp_year']         = $request->exp_year;
            $input['description']   = $request->description;
            $input['requirements']   = $request->requirements;
            $input['status']   = $request->status;

            if ($image = $request->file('image')) {
                if ($career->image != null && is_file('public/'.$career->image)) {
                    unlink('public/'.$career->image);
                }
                $filename = time() . md5(uniqid()) .'.'.$image->getClientOriginalExtension();
                $path = ('public/assets/careers/' . $filename);
                $path_data = ('assets/careers/' . $filename);
                Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100);
                $input['image']  = $path_data;
            }

            $career->update($input);

            DB::commit();
            return redirect()->route('admin.careers.index')->with([
                'message' => 'Career Updated Successfully',
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
    public function destroy(Career $career)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_careers,show_careers')) {
            return redirect('admin/index');
        }

        if ($career->image != null && is_file('public/'.$career->image)) {
            unlink('public/'.$career->image);
        }
        $career->delete();

        return redirect()->route('admin.careers.index')->with([
            'message' => 'Career Deleted Successfully',
            'alert-type' => 'success'
        ]);

    }



    public function removeImage(Request $request)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_careers,show_careers')) {
            return redirect('admin/index');
        }

        $career = Career::whereId($request->career_id)->first();
        if ($career) {
            if (is_file('public/'.$career->image)) {
                unlink('public/'.$career->image);

                $career->image = null;
                $career->save();
            }
        }
        return true;
    }


    public function numberMessage()
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_careers,show_careers')) {
            return redirect('admin/index');
        }

        $data = Apply::where('status', false)->count();
        return response()->json($data);
    }


}
