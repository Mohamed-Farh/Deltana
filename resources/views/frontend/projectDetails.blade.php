@extends('layouts.frontend_app')

@section('title', $projectDetail->title)

@section('content')

<style>
    .services-sec-1 p {
    text-align: left;
    color: #eb581a;
    font-weight: 600;
    font-size: larger;
}

</style>

    <!-- start main sec -->
    <div class="main-containt">
        <div class="container">
            <!-- start services sec -->
            <div class="services-sec-1 py-4">
                <div class="row py-4">
                    <div class="order-sm-2 col-xs-12 col-sm-12 col-md-6">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="{{ asset($projectDetail->image) }}" alt="First slide">
                                </div>
                                @if($projectDetail->media->count() > 0)
                                    @foreach($projectDetail->media as $media)
                                        <div class="carousel-item">
                                            <img class="d-block w-100" src="{{ asset($media->file_name) }}" alt="Second slide">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="order-sm-1 col-xs-12 col-sm-12 col-md-6 text-left slider-sec-services">
                        <p>
                            <span style="color: orangered;font-size: larger;">Name : </span>
                            <span style="color: rgb(0, 0, 0);font-size: large;">{{ $projectDetail->title }}</span>
                        </p>
                        <p>
                            <span style="color: orangered;font-size: larger;">Category : </span>
                            <span style="color: rgb(0, 0, 0);font-size: large;">{{ $projectDetail->category }}</span>
                        </p>
                        <p>
                            <span style="color: orangered;font-size: larger;">Link : </span>
                            <span style="color: rgb(0, 0, 0);font-size: large;">
                                @if ($projectDetail->link != null)
                                    <a href="{{ $projectDetail->link }}" target="_blank">{{ $projectDetail->link }}</a>
                                @else
                                    -
                                @endif
                            </span>
                        </p>
                        <p>
                            <span style="color: orangered;font-size: larger;">Demo : </span>
                            <span style="color: rgb(0, 0, 0);font-size: large;">
                                <!-- Start Video Modal -->
                                @if ($projectDetail->video != '')
                                    <button type="button" class="req-serv-3" data-toggle="modal" data-target="#myModal"  title="Watch Video">
                                        <i class="fab fa-youtube"></i> Watch Video
                                    </button>
                                    <!-- Modal HTML -->
                                    <div id="myModal" class="modal fade modal_fade">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Watch Video</h5>
                                                    <button type="button" class="close" id="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="embed-responsive embed-responsive-16by9">
                                                        <iframe id="cartoonVideo" class="embed-responsive-item" width="100%" height="100%" src="{{ $projectDetail->video }}" allowfullscreen></iframe>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        $('#myModal').on('hide.bs.modal', function(){
                                            $('#cartoonVideo').attr('src', $('#cartoonVideo').attr('src'));
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
                            </span>
                        </p>
                        <p>
                            <span style="color: orangered;font-size: larger;">Used Technology : </span>
                            <span style="color: rgb(0, 0, 0);font-size: large;">{{ $projectDetail->technology }}</span>
                        </p>
                    </div>


                </div>
                <div class="row py-4">
                    <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                        <h5 class="text-left" style="color: orangered;">Description</h5>
                        <p>
                            <span style="color: rgb(0, 0, 0);font-size: large;">{{ $projectDetail->text }}</span>
                        </p>
                    </div>
                </div>
            </div>
            <!-- end services sec -->
        </div>
    </div>
    <!-- end main sec -->



@endsection
