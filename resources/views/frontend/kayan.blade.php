<head>
    {{-- @include('layouts.frontend.head') --}}
    <meta charset="utf-8"/>
    <meta name="viewport"content="width=device-width,initial-scale=1,shrink-to-fit=no"/>

    <title>Deltana | KAYAN</title>
    <link rel="stylesheet"href="{{ asset('frontend/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.css') }}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
        .services-sec-1 .description-para {
            text-align: left;
            padding-top: 0px;
            font-size: 16px;
            color: #ffffff !important;
        }
    </style>
</head>

<body>

    <!-- start navbar sec -->
    <div class="nav-bar-sec nav-bar-sec1  ">
        <nav class="navbar navbar-expand-lg navbar-light bg-light bg-light1">
            <a class="navbar-brand" href="{{ route('frontend.index') }}">
                @php $logo = \App\Models\Logo::whereStatus(1)->whereColor(0)->first(); @endphp
                @if ($logo)
                    <img src="{{ asset($logo->logo) }}" style="width: 30%;"></a>
                @else
                    <img src="{{ asset('images/Mask Group 22.png') }}" style="width: 50%;">
                @endif
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ">
                    <li class="nav-item active ">
                        <a class="nav-link cool-link nav-link1" href="{{ route('frontend.index') }}">HOME <span
                                class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle nav-link1 " href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-expanded="false">
                            Company
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item " href="{{ route('frontend.careers') }}">JOBS</a>
                            <a class="dropdown-item " href="{{ route('frontend.about-us') }}">ABOUT US</a>
                            <a class="dropdown-item " href="{{ route('frontend.process') }}">Process</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link cool-link nav-link1" href="{{ route('frontend.kayan') }}">KAYAN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link cool-link nav-link1" href="{{ route('frontend.infinity') }}">INFINTY</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link cool-link nav-link1" href="{{ route('frontend.our-work') }}">OUR WORK</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link cool-link nav-link1" href="{{ route('frontend.contact') }}">CONTACT</a>
                    </li>
                </ul>
            </div>
        </nav>

    </div>
    <!-- end navbar sec -->

    @include('sweetalert::alert')

    <div class="main-containt1">
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
                                                        <input type="hidden" name="type" value="Kayan" id="Kayan">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label for="name">Doctor Name</label>
                                                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                                                                        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label for="mobile">Doctor Mobile</label>
                                                                        <input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control" required>
                                                                        @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label for="speciality">Doctor Speciality</label>
                                                                        <input type="text" name="speciality" value="{{ old('speciality') }}" class="form-control" required>
                                                                        @error('speciality')<span class="text-danger">{{ $message }}</span>@enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label for="address">Doctor Address</label>
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
                                        <img src="{{ asset($slider->image) }}" style="width: 100%;" />
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
                                                            <h5 class="modal-title" id="exampleModalLongTitle" style="color: #EB581A;">
                                                                {{ $project->title }}</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('frontend.send-message') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="type" value="Kayan" id="Kayan">
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="name">Doctor Name</label>
                                                                            <input type="text" name="name" value="{{ old('name') }}" class="form-control"  required>
                                                                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="mobile">Doctor Mobile</label>
                                                                            <input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control"  required>
                                                                            @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="speciality">Doctor Speciality</label>
                                                                            <input type="text" name="speciality" value="{{ old('speciality') }}" class="form-control"  required>
                                                                            @error('speciality')<span class="text-danger">{{ $message }}</span>@enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="address">Doctor Address</label>
                                                                            <input type="address" name="address" value="{{ old('address') }}" class="form-control"  required>
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
                                    <img src="{{ asset($project->image) }}" style="width: 80%;" data-aos="flip-right"
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
                                                            <h5 class="modal-title" id="exampleModalLongTitle" style="color: #EB581A;">
                                                                {{ $project->title }}</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('frontend.send-message') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="type" value="Kayan" id="Kayan">
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="name">Doctor Name</label>
                                                                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                                                                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="mobile">Doctor Mobile</label>
                                                                            <input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control" required>
                                                                            @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="speciality">Doctor Speciality</label>
                                                                            <input type="text" name="speciality" value="{{ old('speciality') }}" class="form-control" required>
                                                                            @error('speciality')<span class="text-danger">{{ $message }}</span>@enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="address">Doctor Address</label>
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
                                        style="background: white;border-radius: 13px;" data-aos="flip-right">
                                        <iframe width="100%" height="90%" src="{{ $project->video_src }}"
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
                                                            <h5 class="modal-title" id="exampleModalLongTitle" style="color: #EB581A;">
                                                                {{ $project->title }}</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('frontend.send-message') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="type" value="Kayan" id="Kayan">
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="name">Doctor Name</label>
                                                                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                                                                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="mobile">Doctor Mobile</label>
                                                                            <input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control" required>
                                                                            @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="speciality">Doctor Speciality</label>
                                                                            <input type="text" name="speciality" value="{{ old('speciality') }}" class="form-control" required>
                                                                            @error('speciality')<span class="text-danger">{{ $message }}</span>@enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="address">Doctor Address</label>
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
                                    <img src="{{ asset($project->image) }}" style="width: 80%;" data-aos="flip-right"
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
                                                            <input type="hidden" name="type" value="Kayan" id="Kayan">
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="name">Doctor Name</label>
                                                                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                                                                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="mobile">Doctor Mobile</label>
                                                                            <input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control" required>
                                                                            @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="speciality">Doctor Speciality</label>
                                                                            <input type="text" name="speciality" value="{{ old('speciality') }}" class="form-control" required>
                                                                            @error('speciality')<span class="text-danger">{{ $message }}</span>@enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="address">Doctor Address</label>
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
                                        style="background: white;border-radius: 13px;" data-aos="flip-right">
                                        <iframe width="100%" height="90%" src="{{ $project->video_src }}"
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




            <!-- start Technologies We Provide -->
            <div class="Technologies-We-Provide py-4 text-center">
                <h5 class="techno-title" style="color: white;">Technologies We Provide</h5>
                <!-- Start PageTile -->
                @php
                    $pageTitles = \App\Models\PageTitle::whereStatus(1)->wherePage('Technologies We Provide')->get();
                @endphp
                @if ($pageTitles->count() > 0)
                    @foreach ($pageTitles as $pageTitle)
                        <p class="text-center" style="color: white">{{ $pageTitle->title }}</p>
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
                                    <img src="{{ asset($technology->icon) }}" style="width: 30%;" />
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



    @include('layouts.frontend.footer')
    @include('layouts.frontend.footer_script')

</body>

</html>
