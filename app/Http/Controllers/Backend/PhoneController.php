<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\PhoneRequest;
use App\Models\Phone;


class PhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_contacts,show_phone')) {
            return redirect('admin/index');
        }

        $phones = Phone::orderBy('id', 'desc')->paginate(10);

        return view('backend.phones.index', compact('phones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_contacts,show_phone')) {
            return redirect('admin/index');
        }

        return view('backend.phones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhoneRequest $request)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_contacts,show_phone')) {
            return redirect('admin/index');
        }

        $input['type']      = $request->type;
        $input['number']      = $request->number;
        $input['status']    = $request->status;

        Phone::create($input);

        return redirect()->route('admin.phones.index')->with([
            'message' => 'Phone Created Successfully',
            'alert-type' => 'success'
        ]);
    }


    public function show($id)
    {
        //
    }

    public function edit(Phone $phone)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_contacts,show_phone')) {
            return redirect('admin/index');
        }

        return view('backend.phones.edit', compact('phone'));
    }

    public function update(PhoneRequest $request, Phone $phone)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_contacts,show_phone')) {
            return redirect('admin/index');
        }

        $input['type']      = $request->type;
        $input['number']      = $request->number;
        $input['status']    = $request->status;

        $phone->update($input);

        return redirect()->route('admin.phones.index')->with([
            'message' => 'Phone Updated Successfully',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Phone $phone)
    {
        if (!\auth()->user()->ability('superAdmin', 'manage_contacts,show_phone')) {
            return redirect('admin/index');
        }

        $phone->delete();

        return redirect()->route('admin.phones.index')->with([
            'message' => 'Phone Deleted Successfully',
            'alert-type' => 'success'
        ]);

    }



}

