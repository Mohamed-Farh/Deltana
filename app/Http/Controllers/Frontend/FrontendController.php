<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ApplyNowRequest;
use App\Models\About;
use App\Models\Apply;
use App\Models\Career;
use App\Models\ContactMessage;
use App\Models\ContactService;
use App\Models\Message;
use App\Models\Process;
use App\Models\Project;
use App\Models\ProjectDetails;
use App\Models\Service;
use App\Models\Technology;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FrontendController extends Controller
{


    public function index()
    {
        $sliders = Project::whereType('slider')->whereShowIn('home_slider')->whereStatus(1)->orderBy('id' ,'desc')->get();

        $services = Service::whereType('services')->whereStatus(1)->orderBy('id' ,'desc')->get();

        $projects = Project::whereType('project')->whereShowIn('home_project')->whereStatus(1)->orderBy('id' ,'desc')->get();

        $technologies = Technology::whereStatus(1)->orderBy('id' ,'desc')->get();

        $topProjects = ProjectDetails::whereStatus(1)->whereTop(1)->orderBy('id' ,'desc')->get();

        return view('frontend.index', compact('sliders','services', 'projects', 'technologies', 'topProjects'));
    }

    public function kayan()
    {
        $sliders = Project::whereType('slider')->whereShowIn('kayan_slider')->whereStatus(1)->orderBy('id' ,'desc')->get();

        $projects = Project::whereType('project')->whereShowIn('kayan_project')->whereStatus(1)->orderBy('id' ,'desc')->get();

        $technologies = Technology::whereStatus(1)->orderBy('id' ,'desc')->get();

        return view('frontend.kayan', compact('sliders', 'projects', 'technologies'));
    }

    public function infinity()
    {
        $sliders = Project::whereType('slider')->whereShowIn('infinity_slider')->whereStatus(1)->orderBy('id' ,'desc')->get();

        $projects = Project::whereType('project')->whereShowIn('infinity_project')->whereStatus(1)->orderBy('id' ,'desc')->get();

        $technologies = Technology::whereStatus(1)->orderBy('id' ,'desc')->get();

        return view('frontend.infinity', compact('sliders', 'projects', 'technologies'));
    }

    public function ourWork()
    {
        $sliders = Project::whereType('slider')->whereShowIn('our_work_slider')->whereStatus(1)->orderBy('id' ,'desc')->get();

        $services = Service::whereType('our_wok')->whereStatus(1)->orderBy('id' ,'desc')->get();

        $projects = Project::whereType('project')->whereShowIn('our_work_project')->whereStatus(1)->orderBy('id' ,'desc')->get();

        $technologies = Technology::whereStatus(1)->orderBy('id' ,'desc')->get();

        $allProjects = ProjectDetails::whereStatus(1)->orderBy('id' ,'desc')->get();

        return view('frontend.ourWork', compact('sliders', 'projects', 'technologies', 'services', 'allProjects'));
    }

    public function aboutUs()
    {
        $about = About::first();

        return view('frontend.aboutUs', compact('about'));
    }

    public function projectDetails(ProjectDetails $projectDetail)
    {
        return view('frontend.projectDetails', compact('projectDetail'));
    }

    public function process()
    {
        $processes = Process::whereStatus(1)->orderBy('id' ,'desc')->get();

        return view('frontend.process', compact('processes'));
    }

    ////////////////////////////////////////////////////////////////
    public function careers()
    {
        $careers = Career::whereStatus(1)->orderBy('id' ,'desc')->get();

        return view('frontend.career', compact('careers'));
    }

    public function applyNow(ApplyNowRequest $request)
    {
        DB::beginTransaction();
        try {
            $input['first_name']    = $request->first_name;
            $input['last_name']     = $request->last_name;
            $input['email']         = $request->email;
            $input['mobile']        = $request->mobile;

            if($request->file('file'))
            {
                $file = $request->file('file');
                $filename = time() . '.' . $request->file('file')->extension();
                $filePath ='files/uploads/';
                $file->move($filePath, $filename);
                $input['file']  = $filename;
            }

            Apply::create($input);

            DB::commit();
            Alert::success('Success', 'Your Form Sent Successfully');
            return redirect()->back();

        }catch (\Exception $e) {
            DB::rollback();
            Alert::error('Error Message', 'SomeThing Wrong, Please Try Again');
            return redirect()->back();
        }
    }


    ///////////////////////////////////////////////////////////////
    public function contact()
    {
        return view('frontend.contact');
    }

    public function sendContactMessage(Request $request)
    {
        DB::beginTransaction();
        try {
            $input['full_name'] = $request->full_name;
            $input['company']   = $request->company;
            $input['country']      = $request->country;
            $input['mobile']         = $request->mobile;
            $input['note']   = $request->note;

            $contactMessage = ContactMessage::create($input);

            foreach($request->services as $service){
                ContactService::create([
                    'message_id' => $contactMessage->id,
                    'service' => $service,
                ]);
            }

            DB::commit();
            Alert::success('Success', 'Your Form Sent Successfully');
            return redirect()->back();

        }catch (\Exception $e) {
            DB::rollback();
            Alert::error('Error Message', 'SomeThing Wrong, Please Try Again');
            return redirect()->back();
        }
    }


    public function sendMessage(Request $request)
    {
        try {
            $input['name']    = $request->name;
            $input['mobile']     = $request->mobile;
            $input['speciality']         = $request->speciality;
            $input['address']        = $request->address;
            $input['note']         = $request->note;
            $input['type']        = $request->type;

            Message::create($input);

            Alert::success('Success', 'Your Message Sent Successfully');
            return redirect()->back();

        }catch (\Exception $e) {
            Alert::error('Error Message', 'SomeThing Wrong, Please Try Again');
            return redirect()->back();
        }
    }



}
