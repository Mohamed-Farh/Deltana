@extends('layouts.frontend_app')

@section('title', 'OUR WORK')

@section('content')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> --}}
<style>
    .bs-example{
    	margin: 20px;
    }
    .modal-dialog iframe{
        margin: 0 auto;
        display: block;
    }

    [data-aos][data-aos][data-aos-duration="400"], body[data-aos-duration="400"] [data-aos] {
        transition-duration: 3.4s !important;
    }
    .video-col.text-center.py-3.aos-init.aos-animate {
        background: black !important;
        border-radius: 13px;
        height: 100%;
    }
</style>


    <!-- start main sec -->
    <div class="main-containt">
        <div class="container">

            <!-- start slider sec  -->
            <div class="slider-sec-services">
                <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach ($sliders as $slider)
                            <li data-target="#carouselExampleCaptions" data-slide-to="{{ $loop->index }}"
                                class="{{ $loop->first ? 'active' : '' }}" style="background-color: #4e4b4b;"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach ($sliders as $slider)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <h2>{{ $slider->title }}</h2>
                                        <p style=" text-align: justify !important;">{{ $slider->text }}</p>

                                        <!-- Start modal -->
                                        <button type="button" class="req-serv-3" data-toggle="modal" data-target="#exampleModalCenter{{ $slider->id }}"  title="Make Request">
                                            {{ $slider->button }}
                                        </button>
                                        <div class="modal fade" id="exampleModalCenter{{ $slider->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle" style="color: #EB581A;">{{ $slider->title }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('frontend.send-message') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="type" value="Our-Work" id="Our-Work">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label for="name">Name</label>
                                                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                                                                        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label for="mobile">Mobile</label>
                                                                        <input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control" required>
                                                                        @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label for="address">Address</label>
                                                                        <input type="address" name="address" value="{{ old('address') }}" class="form-control" required>
                                                                        @error('address')<span class="text-danger">{{ $message }}</span>@enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label for="note">Note</label>
                                                                        <textarea name="note" rows="5" class="form-control">{!! old('note') !!}</textarea>
                                                                        @error('note')<span class="text-danger">{{ $message }}</span>@enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End modal -->

                                        <!-- Start Video Modal -->
                                        @if ($slider->video_src != '')
                                            <button type="button" class="req-serv-3" data-toggle="modal" data-target="#myModal{{ $slider->id }}"  title="Watch Video">
                                                <i class="fab fa-youtube"></i>
                                            </button>
                                            <!-- Modal HTML -->
                                            <div id="myModal{{ $slider->id }}" class="modal fade">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Watch Video</h5>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="embed-responsive embed-responsive-16by9">
                                                                <iframe id="cartoonVideo{{ $slider->id }}" class="embed-responsive-item" width="100%" height="100%" src="{{ $slider->video_src }}" allowfullscreen></iframe>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <script>
                                                $('#myModal{{ $slider->id }}').on('hide.bs.modal', function(){
                                                    $('#cartoonVideo{{ $slider->id }}').attr('src', $('#cartoonVideo{{ $slider->id }}').attr('src'));
                                                });

                                                $('video').on('play', function (e) {
                                                    $("#carouselExampleCaptions").carousel('pause');
                                                });
                                                $('video').on('stop pause ended', function (e) {
                                                    $("#carouselExampleCaptions").carousel();
                                                });
                                            </script>
                                            <!-- End Video Modal -->
                                        @endif
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <img src="{{ $slider->image }}" style="width: 90%;" />
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- end slider sec  -->


            <!-- start video sec  -->
            @foreach ($projects as $project)
                @if (($loop->index + 1) % 2 != 0)
                    <!-- start services sec -->
                    <div class="services-sec-1 py-4">
                        <div class="row py-4">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <h4 style="color: #EB581A;">{{ $project->title }}</h4>
                                <p class="description-para mt-1" style="color: white;">{{ $project->text }}</p>
                            </div>
                            @if ($project->image != null)
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="row mb-1">
                                        <div class="col">
                                            <!-- Start modal -->
                                            <button type="button" class="Request-services mt-2" data-toggle="modal"
                                                data-target="#exampleModalCenter{{ $project->id }}"
                                                title="Make Request">
                                                {{ $project->button }}
                                            </button>
                                            <div class="modal fade" id="exampleModalCenter{{ $project->id }}"
                                                tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle" style="color: #EB581A;">{{ $project->title }}</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('frontend.send-message') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="type" value="Our-Work" id="Our-Work">
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="name">Name</label>
                                                                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                                                                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="mobile">Mobile</label>
                                                                            <input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control" required>
                                                                            @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="address">Address</label>
                                                                            <input type="address" name="address" value="{{ old('address') }}" class="form-control" required>
                                                                            @error('address')<span class="text-danger">{{ $message }}</span>@enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="note">Note</label>
                                                                            <textarea name="note" rows="5" class="form-control">{!! old('note') !!}</textarea>
                                                                            @error('note')<span class="text-danger">{{ $message }}</span>@enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End modal -->
                                        </div>
                                    </div>
                                    <img src="{{ $project->image }}" style="width: 80%;" data-aos="flip-right"
                                        data-aos-duration="3000">
                                </div>
                            @else
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="row mb-1">
                                        <div class="col">
                                            <!-- Start modal -->
                                            <button type="button" class="Request-services mt-2" data-toggle="modal"
                                                data-target="#exampleModalCenter{{ $project->id }}"
                                                title="Make Request">
                                                {{ $project->button }}
                                            </button>
                                            <div class="modal fade" id="exampleModalCenter{{ $project->id }}"
                                                tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle" style="color: #EB581A;">{{ $project->title }}</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('frontend.send-message') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="type" value="Our-Work" id="Our-Work">
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="name">Name</label>
                                                                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                                                                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="mobile">Mobile</label>
                                                                            <input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control" required>
                                                                            @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="address">Address</label>
                                                                            <input type="address" name="address" value="{{ old('address') }}" class="form-control" required>
                                                                            @error('address')<span class="text-danger">{{ $message }}</span>@enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="note">Note</label>
                                                                            <textarea name="note" rows="5" class="form-control">{!! old('note') !!}</textarea>
                                                                            @error('note')<span class="text-danger">{{ $message }}</span>@enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End modal -->
                                        </div>
                                    </div>
                                    <div class="video-col text-center py-3"
                                        style="background: white;border-radius: 13px; height: 100%;" data-aos="flip-right">
                                        <iframe width="100%" height="100%" src="{{ $project->video_src }}"
                                                frameborder="0" allowfullscreen></iframe>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- end services sec -->
                @else
                    <!-- start services sec -->
                    <div class="services-sec-1 py-4">
                        <div class="row py-4">
                            @if ($project->image != null)
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="row mb-1">
                                        <div class="col">
                                            <!-- Start modal -->
                                            <button type="button" class="Request-services mt-2" data-toggle="modal"
                                                data-target="#exampleModalCenter{{ $project->id }}"
                                                title="Make Request">
                                                {{ $project->button }}
                                            </button>
                                            <div class="modal fade" id="exampleModalCenter{{ $project->id }}"
                                                tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle" style="color: #EB581A;">{{ $project->title }}</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('frontend.send-message') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="type" value="Our-Work" id="Our-Work">
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="name">Name</label>
                                                                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                                                                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="mobile">Mobile</label>
                                                                            <input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control" required>
                                                                            @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="address">Address</label>
                                                                            <input type="address" name="address" value="{{ old('address') }}" class="form-control" required>
                                                                            @error('address')<span class="text-danger">{{ $message }}</span>@enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="note">Note</label>
                                                                            <textarea name="note" rows="5" class="form-control">{!! old('note') !!}</textarea>
                                                                            @error('note')<span class="text-danger">{{ $message }}</span>@enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End modal -->
                                        </div>
                                    </div>
                                    <img src="{{ $project->image }}" style="width: 80%;" data-aos="flip-right"
                                        data-aos-duration="3000">
                                </div>
                            @else
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="row mb-1">
                                        <div class="col">
                                            <!-- Start modal -->
                                            <button type="button" class="Request-services mt-2" data-toggle="modal"
                                                data-target="#exampleModalCenter{{ $project->id }}"
                                                title="Make Request">
                                                {{ $project->button }}
                                            </button>
                                            <div class="modal fade" id="exampleModalCenter{{ $project->id }}"
                                                tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle" style="color: #EB581A;">{{ $project->title }}</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('frontend.send-message') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="type" value="Our-Work" id="Our-Work">
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="name">Name</label>
                                                                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                                                                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="mobile">Mobile</label>
                                                                            <input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control" required>
                                                                            @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="address">Address</label>
                                                                            <input type="address" name="address" value="{{ old('address') }}" class="form-control" required>
                                                                            @error('address')<span class="text-danger">{{ $message }}</span>@enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="note">Note</label>
                                                                            <textarea name="note" rows="5" class="form-control">{!! old('note') !!}</textarea>
                                                                            @error('note')<span class="text-danger">{{ $message }}</span>@enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End modal -->
                                        </div>
                                    </div>
                                    <div class="video-col text-center py-3"
                                        style="background: white;border-radius: 13px; height: 100%;" data-aos="flip-right">
                                        <iframe width="100%" height="100%" src="{{ $project->video_src }}"
                                                frameborder="0" allowfullscreen></iframe>
                                    </div>
                                </div>
                            @endif
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <h4 style="color: #EB581A;">{{ $project->title }}</h4>
                                <p class="description-para mt-1" style="color: white;">{{ $project->text }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- end services sec -->
                @endif
            @endforeach
            <!-- end video sec -->



            <!-- start top project sec -->
            <div class="top-projects-sec py-4 ">
                <h1 class="top-projects-title" data-aos="fade-down" data-aos-duration="3000">Our Projects</h1>
                <!-- Start PageTile -->
                @php
                    $pageTitles = \App\Models\PageTitle::whereStatus(1)->wherePage('Our Projects')->get();
                @endphp
                @if ($pageTitles->count() > 0)
                    @foreach ($pageTitles as $pageTitle)
                        <p class="text-center">{{ $pageTitle->title }}</p>
                    @endforeach
                @endif
                <!-- End PageTile -->
                <div class="row">
                    @foreach ($allProjects as $allProject)
                        <div class="col-xs-12 col-sm-12 col-md-4 mt-3">
                            <div class="card">
                                <img src="{{ asset($allProject->image) }}" class="card-img-top" width="100%" height="220px">
                                <div class="card-body">
                                    <h6><a href="/project-details/{{ $allProject->id }}">{{ $allProject->title }}</a></h6>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- end top project sec -->


            <!-- start circle sec -->
            <div class="circle-sec py-4 text-center">
                <h1 data-aos="fade-up" data-aos-duration="3000">Why Deltana?</h1>
                <!-- Start PageTile -->
                @php
                    $pageTitles = \App\Models\PageTitle::whereStatus(1)->wherePage('Why Deltana?')->get();
                @endphp
                @if ($pageTitles->count() > 0)
                    @foreach ($pageTitles as $pageTitle)
                        <p class="text-center">{{ $pageTitle->title }}</p>
                    @endforeach
                @endif
                <!-- End PageTile -->
                <div class="row">
                    @foreach ($services as $service)
                        <div class="col-xs-12 col-sm-12 col-md-4 mt-3">
                            <img src="{{ $service->image }}" style="width: 40%;" />
                            <h3>{{ $service->title }}</h3>
                            <p style=" text-align: justify !important;">{{ $service->text }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- end circle sec -->



            <!-- start Technologies We Provide -->
            <div class="Technologies-We-Provide py-4 text-center">
                <h5 class="techno-title">Technologies We Provide</h5>
                <!-- Start PageTile -->
                @php
                    $pageTitles = \App\Models\PageTitle::whereStatus(1)->wherePage('Technologies We Provide')->get();
                @endphp
                @if ($pageTitles->count() > 0)
                    @foreach ($pageTitles as $pageTitle)
                        <p class="text-center">{{ $pageTitle->title }}</p>
                    @endforeach
                @endif
                <!-- End PageTile -->
                <div class="row ">
                    <div class="col-xs-12 col-sm-12 col-md-3">
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="row">
                            @foreach ($technologies as $technology)
                                <div class="col">
                                    <img src="{{ $technology->icon }}" style="width: 40%;" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-3">
                    </div>
                </div>
            </div>
            <!-- end Technologies We Provide -->
        </div>
    </div>


@endsection
