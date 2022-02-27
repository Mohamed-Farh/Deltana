@extends('layouts.frontend_app')

@section('title', 'HOME')

@section('content')

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
                                        <p>{{ $slider->text }}</p>

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
                                                        <input type="hidden" name="type" value="Home" id="Home">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label for="name">Name</label>
                                                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                                                                        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
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
                                                                        <label for="address">Address</label>
                                                                        <input type="address" name="address" value="{{ old('address') }}" class="form-control">
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
                                        <img src="{{ asset($slider->image) }}" style="width: 100%;" />
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- end slider sec  -->

            <!-- start services sec -->
            <div class="services-sec-1 py-4" style="padding-top: 4.5rem!important;">
                <h5 data-aos="fade-up" data-aos-duration="3000">Services</h5>
                <!-- Start PageTile -->
                @php
                    $pageTitles = \App\Models\PageTitle::whereStatus(1)->wherePage('Home Services')->get();
                @endphp
                @if ($pageTitles->count() > 0)
                    @foreach ($pageTitles as $pageTitle)
                        <p class="text-center">{{ $pageTitle->title }}</p>
                    @endforeach
                @endif
                <!-- End PageTile -->
                <div class="row py-4 text-center">
                    @foreach ($services as $service)
                        <div class="col-xsw-12 col-sm-12 col-md-4 mt-1 mb-2">
                            <img src="{{ $service->image }}" style="width: 50%;" />
                            <h3>{{ $service->title }}</h3>
                            <p>{{ $service->text }}</p>
                        </div>
                    @endforeach
                </div>


                @foreach ($projects as $project)
                    @if ( ($loop->index+1) % 2 != 0)
                        <div class="row py-4">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <h6 class="servicess-title-1">{{ $project->title }}</h6>
                                <p class="servicess-para-1">{{ $project->text }}</p>
                                <!-- Start modal -->
                                <button type="button" class="Request-services mr-2 mt-2" data-toggle="modal" data-target="#exampleModalCenter{{ $project->id }}"  title="Make Request">
                                    {{ $project->button }}
                                </button>
                                <div class="modal fade" id="exampleModalCenter{{ $project->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                <input type="hidden" name="type" value="Home" id="Home">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="name">Name</label>
                                                                <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                                                                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
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
                                                                <label for="address">Address</label>
                                                                <input type="address" name="address" value="{{ old('address') }}" class="form-control">
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
                                @if ($project->video_src != '')
                                <button type="button" class="mt-2 Request-services" data-toggle="modal" data-target="#myModal{{ $project->id }}"  title="Watch Video">
                                    <i class="fab fa-youtube"></i>
                                </button>
                                <!-- Modal HTML -->
                                <div id="myModal{{ $project->id }}" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Watch Video</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="embed-responsive embed-responsive-16by9">
                                                    <iframe id="cartoonVideo{{ $project->id }}" class="embed-responsive-item" width="560" height="315" src="{{ $project->video_src }}" allowfullscreen></iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $('#myModal{{ $project->id }}').on('hide.bs.modal', function(){
                                        $('#cartoonVideo{{ $project->id }}').attr('src', $('#cartoonVideo{{ $project->id }}').attr('src'));
                                    });

                                    $('video').on('play', function (e) {
                                        $("#carouselExampleCaptions").carousel('pause');
                                    });
                                    $('video').on('stop pause ended', function (e) {
                                        $("#carouselExampleCaptions").carousel();
                                    });
                                </script>
                                @endif
                                <!-- End Video Modal -->

                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <img src="{{ asset($project->image) }}" style="width: 80%;" data-aos="flip-left"
                                    data-aos-duration="3000" />
                            </div>
                        </div>
                    @else
                        <div class="row py-4">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <img src="{{ asset($project->image) }}" style="width: 80%;" data-aos="flip-left"
                                    data-aos-duration="3000" />
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <h6 class="servicess-title-1">{{ $project->title }}</h6>
                                <p class="servicess-para-1">{{ $project->text }}</p>
                                <!-- Start modal -->
                                <button type="button" class="Request-services mr-2 mt-2" data-toggle="modal" data-target="#exampleModalCenter{{ $project->id }}"  title="Make Request">
                                    {{ $project->button }}
                                </button>
                                <div class="modal fade" id="exampleModalCenter{{ $project->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                <input type="hidden" name="type" value="Home" id="Home">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="name">Name</label>
                                                                <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                                                                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
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
                                                                <label for="address">Address</label>
                                                                <input type="address" name="address" value="{{ old('address') }}" class="form-control">
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
                                @if ($project->video_src != '')
                                <button type="button" class="mt-2 Request-services" data-toggle="modal" data-target="#myModal{{ $project->id }}"  title="Watch Video">
                                    <i class="fab fa-youtube"></i>
                                </button>
                                <!-- Modal HTML -->
                                <div id="myModal{{ $project->id }}" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Watch Video</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="embed-responsive embed-responsive-16by9">
                                                    <iframe id="cartoonVideo{{ $project->id }}" class="embed-responsive-item" width="560" height="315" src="{{ $project->video_src }}" allowfullscreen></iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $('#myModal{{ $project->id }}').on('hide.bs.modal', function(){
                                        $('#cartoonVideo{{ $project->id }}').attr('src', $('#cartoonVideo{{ $project->id }}').attr('src'));
                                    });

                                    $('video').on('play', function (e) {
                                        $("#carouselExampleCaptions").carousel('pause');
                                    });
                                    $('video').on('stop pause ended', function (e) {
                                        $("#carouselExampleCaptions").carousel();
                                    });
                                </script>
                                @endif
                                <!-- End Video Modal -->
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <!-- end services sec -->





            <!-- start top project sec -->
            <div class="top-projects-sec py-4 ">
                <h6 class="top-projects-title" data-aos="fade-down" data-aos-duration="3000">Top Projects</h6>
                <!-- Start PageTile -->
                @php
                    $pageTitles = \App\Models\PageTitle::whereStatus(1)->wherePage('Top Projects')->get();
                @endphp
                @if ($pageTitles->count() > 0)
                    @foreach ($pageTitles as $pageTitle)
                        <p class="text-center">{{ $pageTitle->title }}</p>
                    @endforeach
                @endif
                <!-- End PageTile -->
                <div class="row">
                    @foreach ($topProjects as $topProject)
                        <div class="col-xs-12 col-sm-12 col-md-4 mt-3">
                            <div class="card">
                                <img src="{{ asset($topProject->image) }}" class="card-img-top" width="100%" height="220px">
                                <div class="card-body">
                                    <h6><a href="/project-details/{{ $topProject->id }}">{{ $topProject->title }}</a></h6>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- end top project sec -->


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
