<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />

    <title>Deltana | PROCESS</title>
    <link rel="stylesheet" href="{{ asset('frontend/fontawesome/css/all.min.css') }}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.css') }}">

    <style>
        .bs-example {
            margin: 20px;
        }

        .modal-dialog iframe {
            margin: 0 auto;
            display: block;
        }

    </style>

</head>

<body>
    <div class="page-holder {{ request()->routeIs('frontend.detail') ? ' bg-light' : null }}">

        @include('layouts.frontend.navbar')


        <style>
            img {
                border-radius: 10px !important;
            }

        </style>
        <!-- start main sec -->
        <div class="main-containt">
            <div class="container">
                <h6 class="process-title">Process</h6>
                <!-- Start PageTile -->
                @php
                    $pageTitles = \App\Models\PageTitle::whereStatus(1)
                        ->wherePage('Process')
                        ->get();
                @endphp
                @if ($pageTitles->count() > 0)
                    @foreach ($pageTitles as $pageTitle)
                        <p class="text-center">{{ $pageTitle->title }}</p>
                    @endforeach
                @endif
                <!-- End PageTile -->


                @php
                    $step1 = \App\Models\Process::where('step_no', 1)->first();
                    $step2 = \App\Models\Process::where('step_no', 2)->first();
                    $step3 = \App\Models\Process::where('step_no', 3)->first();
                    $step4 = \App\Models\Process::where('step_no', 4)->first();
                    $step5 = \App\Models\Process::where('step_no', 5)->first();
                @endphp
                <div class="step-progress-bar-sec py-4">
                    <div class="row justify-content-center">
                        <div class=" col-sm-12 col-md-12 col-lg-12 col-xl-10 text-center ">
                            <div class=" pt-4 pb-0 mt-3 mb-3">
                                <form id="form">
                                    <ul id="progressbar">
                                        <li class="active" id="step1">
                                            <strong>{{ $step1 != '' ? $step1->step_title : '' }}</strong>
                                        </li>
                                        <li id="step2"><strong>{{ $step2 != '' ? $step2->step_title : '' }}</strong>
                                        </li>
                                        <li id="step3"><strong>{{ $step3 != '' ? $step3->step_title : '' }}</strong>
                                        </li>
                                        <li id="step4"><strong>{{ $step4 != '' ? $step4->step_title : '' }}</strong>
                                        </li>
                                        <li id="step5"><strong>{{ $step5 != '' ? $step5->step_title : '' }}</strong>
                                        </li>
                                    </ul>
                                    <br>

                                    <fieldset>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-6">
                                                {{-- @php
                                                    $step1_image = asset($step1->image);
                                                @endphp --}}
                                                <img src="{{ $step1 != '' ? (asset($step1->image)) : asset('images/Organizing projects-rafiki.png') }}"
                                                    style="width: 100%;" />
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-6">
                                                <h5>{{ $step1 != '' ? $step1->title : '' }}</h5>
                                                <p>{{ $step1 != '' ? $step1->title : '' }}</p>
                                            </div>
                                        </div>
                                        <input type="button" name="next-step" class="next-step"
                                            value="Next Step" />
                                    </fieldset>

                                    <fieldset>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-6">
                                                <img src="{{ $step2 != '' ? (asset($step2->image)) : asset('images/Design team-amico.png') }}"
                                                    style="width: 100%;" />
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-6">
                                                <h5>{{ $step2 != '' ? $step2->title : '' }}</h5>
                                                <p>{{ $step2 != '' ? $step2->title : '' }}</p>
                                            </div>
                                        </div>
                                        <input type="button" name="next-step" class="next-step"
                                            value="Next Step" />
                                        <input type="button" name="previous-step" class="previous-step"
                                            value="Previous Step" />
                                    </fieldset>

                                    <fieldset>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-6">
                                                <img src="{{ $step3 != '' ? (asset($step3->image)) : asset('images/Development focus-amico (1).png') }}"
                                                    style="width: 100%;" />
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-6">
                                                <h5>{{ $step3 != '' ? $step3->title : '' }}</h5>
                                                <p>{{ $step3 != '' ? $step3->title : '' }}</p>
                                            </div>
                                        </div>
                                        <input type="button" name="next-step" class="next-step"
                                            value="Next Step" />
                                        <input type="button" name="previous-step" class="previous-step"
                                            value="Previous Step" />
                                    </fieldset>

                                    <fieldset>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-6">
                                                <img src="{{ $step4 != '' ? (asset($step4->image)) : asset('images/Usability testing-pana.png') }}"
                                                    style="width: 100%;" />
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-6">
                                                <h5>{{ $step4 != '' ? $step4->title : '' }}</h5>
                                                <p>{{ $step4 != '' ? $step4->title : '' }}</p>
                                            </div>
                                        </div>
                                        <input type="button" name="next-step" class="next-step"
                                            value="Final Step" />
                                        <input type="button" name="previous-step" class="previous-step"
                                            value="Previous Step" />
                                    </fieldset>

                                    <fieldset>
                                        <div class="finish">
                                            <h2 class="text text-center">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                                        <img src="{{ $step5 != '' ? (asset($step5->image)) : asset('images/Young and happy-bro.png') }}"
                                                            style="width: 100%;" />
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                                        <h5>{{ $step5 != '' ? $step5->title : '' }}</h5>
                                                        <p>{{ $step5 != '' ? $step5->title : '' }}</p>
                                                    </div>
                                                </div>
                                            </h2>
                                        </div>
                                        <input type="button" name="next-step" class="next-step"
                                            value="Contact Us" />
                                        <input type="button" name="previous-step" class="previous-step"
                                            value="Previous Step" />
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end  stepprogress bar sec -->
            </div>
        </div>
        <!-- end main sec -->




        <!--  -->
        <script>
            $(document).ready(function() {
                var currentGfgStep, nextGfgStep, previousGfgStep;
                var opacity;
                var current = 1;
                var steps = $("fieldset").length;

                setProgressBar(current);

                $(".next-step").click(function() {

                    currentGfgStep = $(this).parent();
                    nextGfgStep = $(this).parent().next();

                    $("#progressbar li").eq($("fieldset")
                        .index(nextGfgStep)).addClass("active");

                    nextGfgStep.show();
                    currentGfgStep.animate({
                        opacity: 0
                    }, {
                        step: function(now) {
                            opacity = 1 - now;

                            currentGfgStep.css({
                                'display': 'none',
                                'position': 'relative'
                            });
                            nextGfgStep.css({
                                'opacity': opacity
                            });
                        },
                        duration: 500
                    });
                    setProgressBar(++current);
                });

                $(".previous-step").click(function() {

                    currentGfgStep = $(this).parent();
                    previousGfgStep = $(this).parent().prev();

                    $("#progressbar li").eq($("fieldset")
                        .index(currentGfgStep)).removeClass("active");

                    previousGfgStep.show();

                    currentGfgStep.animate({
                        opacity: 0
                    }, {
                        step: function(now) {
                            opacity = 1 - now;

                            currentGfgStep.css({
                                'display': 'none',
                                'position': 'relative'
                            });
                            previousGfgStep.css({
                                'opacity': opacity
                            });
                        },
                        duration: 500
                    });
                    setProgressBar(--current);
                });

                function setProgressBar(currentStep) {
                    var percent = parseFloat(100 / steps) * current;
                    percent = percent.toFixed();
                    $(".progress-bar")
                        .css("width", percent + "%")
                }

                $(".submit").click(function() {
                    return false;
                })
            });
        </script>
        <!--  -->

        @include('layouts.frontend.footer')
        @include('layouts.frontend.footer_script')

    </div>


</body>

</html>
