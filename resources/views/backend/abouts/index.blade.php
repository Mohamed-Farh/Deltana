@extends('layouts.admin_auth_app')

@section('title', 'About Us')

@section('content')


    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">About Us</h6>
            <div class="ml-auto">
                @if (empty($about))
                    @ability('superAdmin', 'manage_about,create_about')
                        <a href="{{ route('admin.abouts.create') }}" class="btn btn-primary">
                            <span class="icon text-white-50">
                                <i class="fa fa-plus"></i>
                            </span>
                            <span class="text">Create About Us</span>
                        </a>
                    @endability
                @else
                    @ability('superAdmin', 'manage_about,update_about')
                        <a href="{{ route('admin.abouts.edit', $about->id) }}" class="btn btn-primary">
                            <span class="icon text-white-50">
                                <i class="fa fa-edit"></i>
                            </span>
                            <span class="text">Update About Us</span>
                        </a>
                    @endability
                @endif
            </div>
        </div>

        @if (!empty($about))
            <!-- start main sec -->
            <div class="container">
                <div class="about-us-sec py-4">
                    <h1 data-aos="fade-up"
                    data-aos-duration="3000">About Us</h1>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <p class="about-us-des">{!! $about->main !!}</p>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 text-center">
                            <img src="{{ asset($about->image) }}" style="height: 300px"/>
                        </div>
                    </div>
                    <h1 data-aos="flip-down"data-aos-duration="3000">Work Environment</h1>
                    <p class="work-des">{!! $about->work !!}</p>
                </div>

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

                <div class="circle-sec py-4 text-center" style="border: solid">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-4 mt-3">
                            <img src="{{ asset('assets/about/1.png') }}"/>
                            <h4>Performance</h4>
                            <p>{!! $about->performance !!}</p>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 mt-3">
                            <img src="{{ asset('assets/about/2.png') }}"/>
                            <h4>Quality</h4>
                            <p>{!! $about->quality !!}</p>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 mt-3">
                            <img src="{{ asset('assets/about/3.png') }}"/>
                            <h4>Maintenance</h4>
                            <p>{!! $about->maintenance !!}</p>
                        </div>
                    </div>
                </div>
                <!-- end circle sec -->
            </div>
        @endif
    </div>


@endsection
