@extends('layouts.frontend_app')

@section('title', 'ABOUT US')

@section('content')

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>


    <!-- start main sec -->
    <div class="main-containt">
        @if (!empty($about))
            <div class="container">
                <!-- start about us sec -->
                <div class="about-us-sec py-4">
                    <h6 data-aos="fade-up" data-aos-duration="3000">About Us</h6>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <p class="about-us-des"  style="text-align: justify">{!! $about->main !!}</p>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 text-center">
                            <img src="{{ asset($about->image) }}" style="height: 300px"/>
                        </div>
                    </div>
                    <h1 data-aos="flip-down"data-aos-duration="3000">Work Environment</h1>
                    <p class="work-des"  style="text-align: justify">{!! $about->work !!}</p>
                </div>
                <!-- end about us sec -->


                <!-- start gallery -->
                <div class="gallery py-4">
                    <div class="row gallery-1  text-center">
                        @if($about->media()->count() > 0 )
                            @foreach($about->media as $media)
                                <div class="col-xs-12 col-sm-12 col-md-4 mt-3">
                                    <figure>
                                        <img src="{{ asset($media->file_name) }}" alt="gallery" class="image" style="height:200px">
                                    </figure>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <!-- end gallery   -->


                <!-- start circle sec -->
                <div class="circle-sec py-4 text-center">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-4 mt-3">
                            <img src="{{ asset('assets/about/1.png') }}"/>
                            <h4>Performance</h4>
                            <p style="text-align: justify">{!! $about->performance !!}</p>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 mt-3">
                            <img src="{{ asset('assets/about/2.png') }}"/>
                            <h4>Quality</h4>
                            <p style="text-align: justify">{!! $about->quality !!}</p>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 mt-3">
                            <img src="{{ asset('assets/about/3.png') }}"/>
                            <h4>Maintenance</h4>
                            <p style="text-align: justify">{!! $about->maintenance !!}</p>
                        </div>
                    </div>
                </div>
                <!-- end circle sec -->


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
            </div>
        @endif



        @php
            $location = \App\Models\Location::whereStatus(1)->first();
        @endphp
        @if ($location)
            <div id="googleMap" style="width:100%; height:400px;">
                <iframe
                    src="{{ $location->location }}"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy">
                </iframe>
            </div>
        @endif
    </div>
    <!-- end main sec -->



@endsection
