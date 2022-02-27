@extends('layouts.frontend_app')

@section('title', 'JOBS')

@section('content')

<style>
    button {
        background: #EB581A;
        color: #fff;
        border: none;
        position: relative;
        height: 41px;
        font-size: 16px;
        padding: 0 2em;
        cursor: pointer;
        transition: 800ms ease all;
        outline: none;
        border-radius: 4px;
    }
    .neww {
        box-shadow: 0 5px 10px 5px rgb(204 163 84 / 50%);
        padding: 10px;
    }
    .neww p{
        padding: 20px;
    }
</style>

    <!-- start main sec -->
    <div class="main-containt">
        <div class="container">
            <div data-aos="fade-down">
                <h4 style="padding-top:9%; padding-bottom: 0%;">Deltana Careers</h4>
                <h4 style="padding-top:0%; padding-bottom: 0%;">Join Us</h4>
                <h4 style="padding-top:0%; padding-bottom: 2%;">Apply for a job</h4>
                <!-- Start PageTile -->
                @php
                    $pageTitles = \App\Models\PageTitle::whereStatus(1)->wherePage('Deltana Careers')->get();
                @endphp
                @if ($pageTitles->count() > 0)
                    @foreach ($pageTitles as $pageTitle)
                        <p class="text-center">{{ $pageTitle->title }}</p>
                    @endforeach
                @endif
                <!-- End PageTile -->
            </div>


            <!-- start images sec -->
            <div class="images-sec-1 py-3">
                <div class="container">
                    @foreach ($careers as $career)
                        @if ( ($loop->index+1) % 2 != 0)
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-4 ">
                                    <p class="we-are-hiring1 text-left">
                                        <span class="ui-ux-title">{{ $career->title }}</span><br>
                                        Location: {{ $career->location }}<br>
                                        Job Type: {{ $career->type }}<br>
                                        Years of experience: ( +{{ $career->exp_year }} )<br>
                                    </p>
                                    <!-- Start Description modal -->
                                    <button type="button" class="req-serv-3" data-toggle="modal" data-target="#exampleModalCenter{{ $career->id }}"  title="More Details">
                                        More Details
                                    </button>
                                    <div class="modal fade" id="exampleModalCenter{{ $career->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle"  style="color: #EB581A;">{{ $career->title }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: black" >
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="neww">
                                                        <h2 style="color: #EB581A;">Description</h2>
                                                        <p>{{ $career->description }}</p>
                                                    </div>
                                                    <div class="neww">
                                                        <h2 style="color: #EB581A;">Requirements</h2>
                                                        <p>{{ $career->requirements }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Description modal -->

                                    <!-- Start Apply Now modal -->
                                    <button type="button" class="req-serv-3" data-toggle="modal" data-target="#exampleModalCenter1{{ $career->id }}"  title="Apply Now">
                                        Apply Now
                                    </button>
                                    <div class="modal fade" id="exampleModalCenter1{{ $career->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle"  style="color: #EB581A;">{{ $career->title }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('frontend.apply-now') }}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="first_name">First Name</label>
                                                                    <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control">
                                                                    @error('first_name')<span class="text-danger">{{ $message }}</span>@enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="last_name">Last Name</label>
                                                                    <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control">
                                                                    @error('last_name')<span class="text-danger">{{ $message }}</span>@enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="email">E-Mail</label>
                                                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                                                                    @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="mobile">Mobile</label>
                                                                    <input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control">
                                                                    @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="file">CV</label>
                                                                    <input type="file" name="file" class="form-control">
                                                                    @error('file')<span class="text-danger">{{ $message }}</span>@enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: #eb581a">Close</button>
                                                            <button type="submit" name="submit" class="btn btn-primary" style="background-color: #eb581a">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Apply Now modal -->
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4 text-center">
                                    <img src="images/Mask Group 3.png" class="progress-bar-img" />
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    @if ($career->image != null)
                                        <img src="{{ $career->image }} " class="second-img1"
                                        data-aos="flip-left">
                                    @else
                                        <img src="images/job.png" class="second-img1" data-aos="flip-left">
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    @if ($career->image != null)
                                        <img src="{{ $career->image }} " class="second-img1"
                                        data-aos="flip-left">
                                    @else
                                        <img src="images/job.png" class="second-img1" data-aos="flip-left">
                                    @endif
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4 text-center">
                                    <img src="images/Mask Group 3.png" class="progress-bar-img" />
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4 ">
                                    <p class="we-are-hiring1 text-left">
                                        <span class="ui-ux-title">{{ $career->title }}</span><br>
                                        Location: {{ $career->location }}<br>
                                        Job Type: {{ $career->type }}<br>
                                        Years of experience: ( +{{ $career->exp_year }} )<br>
                                    </p>
                                    <!-- Start modal -->
                                    <button type="button" class="req-serv-3" data-toggle="modal" data-target="#exampleModalCenter{{ $career->id }}"  title="More Details">
                                        More Details
                                    </button>
                                    <div class="modal fade" id="exampleModalCenter{{ $career->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle"  style="color: #EB581A;">{{ $career->title }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: black" >
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="neww">
                                                        <h2 style="color: #EB581A;">Description</h2>
                                                        <p>{{ $career->description }}</p>
                                                    </div>
                                                    <div class="neww">
                                                        <h2 style="color: #EB581A;">Requirements</h2>
                                                        <p>{{ $career->requirements }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End modal -->
                                    <!-- Start Apply Now modal -->
                                    <button type="button" class="req-serv-3" data-toggle="modal" data-target="#exampleModalCenter1{{ $career->id }}"  title="Apply Now">
                                        Apply Now
                                    </button>
                                    <div class="modal fade" id="exampleModalCenter1{{ $career->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle"  style="color: #EB581A;">{{ $career->title }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('frontend.apply-now') }}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="first_name">First Name</label>
                                                                    <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control">
                                                                    @error('first_name')<span class="text-danger">{{ $message }}</span>@enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="last_name">Last Name</label>
                                                                    <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control">
                                                                    @error('last_name')<span class="text-danger">{{ $message }}</span>@enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="email">E-Mail</label>
                                                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                                                                    @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="mobile">Mobile</label>
                                                                    <input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control">
                                                                    @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="file">CV</label>
                                                                    <input type="file" name="file" class="form-control">
                                                                    @error('file')<span class="text-danger">{{ $message }}</span>@enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: #eb581a">Close</button>
                                                            <button type="submit" name="submit" class="btn btn-primary" style="background-color: #eb581a">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Apply Now modal -->
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <!-- end images sec -->
        </div>
    </div>
    <!-- end main sec -->


@endsection
