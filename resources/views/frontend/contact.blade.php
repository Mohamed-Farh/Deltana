@extends('layouts.frontend_app')

@section('title', 'Contact Us')

@section('content')



    <!-- start main sec -->
    <div class="contact-us-sec py-4">
        <div class="container">
            <h5 data-aos="zoom-in-up" data-aos-duration="3000">Contact Us</h5>
            <p>For careers, please <a href="{{ route('frontend.careers') }}">Click here</a></p>
            <!-- Start PageTile -->
            @php
                $pageTitles = \App\Models\PageTitle::whereStatus(1)->wherePage('Contact Us')->get();
            @endphp
            @if ($pageTitles->count() > 0)
                @foreach ($pageTitles as $pageTitle)
                    <p class="text-center">{{ $pageTitle->title }}</p>
                @endforeach
            @endif
            <!-- End PageTile -->
            <div class="row checkbox-row">
                <div class="col-xs-12 col-sm-12 col-md-6 ">



                    <form action="{{ route('frontend.send-contact-message') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="full_name">Full Name</label>
                                    <input type="text" name="full_name" value="{{ old('full_name') }}" class="form-control" required>
                                    @error('full_name')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="company">Company</label>
                                    <input type="text" name="company" value="{{ old('company') }}" class="form-control" required>
                                    @error('company')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <input type="text" name="country" value="{{ old('country') }}" class="form-control" required>
                                    @error('country')<span class="text-danger">{{ $message }}</span>@enderror
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
                                <label for="mobile" style="color: orangered">Choose From The Following Services</label>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" name="services[]" type="checkbox" value="Mobile App Development" id="1">
                                        <label class="form-check-label" for="1">Mobile App Development</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" name="services[]" type="checkbox" value="Web Development" id="2">
                                        <label class="form-check-label" for="2">Web Development</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" name="services[]" type="checkbox" value="Web Design" id="3">
                                        <label class="form-check-label" for="3">Web Design</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" name="services[]" type="checkbox" value="Kayan" id="4">
                                        <label class="form-check-label" for="4">Kayan</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" name="services[]" type="checkbox" value="Infinity" id="5">
                                        <label class="form-check-label" for="5">Infinity</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <textarea name="note" rows="5" class="form-control"  placeholder="Specify Your Project Details">{!! old('note') !!}</textarea>
                                    @error('note')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="submit">Submit</button>
                        </div>
                    </form>
                </div>


                @php
                    $socials = \App\Models\SocialMedia::whereStatus(1)->orderBy('id', 'desc')->get();
                    $whats  = \App\Models\Phone::whereType('WhatsApp')->whereStatus(1)->orderBy('id', 'desc')->get();
                    $phones  = \App\Models\Phone::whereType('Phone')->whereStatus(1)->orderBy('id', 'desc')->get();
                    $emails = \App\Models\Email::whereStatus(1)->orderBy('id', 'desc')->get();
                    $locations = \App\Models\Location::whereStatus(1)->orderBy('id', 'desc')->get();

                @endphp
                <div class="col-xs-12 col-sm-12 col-md-6 text-center">
                    <h4>contact information:</h4>
                    <img src="images/contact.png" style="width: 100%;" data-aos="flip-right" data-aos-duration="3000" />
                    <div class="row">
                        <div class="col">
                            <ul>
                                @foreach ($phones as $phone)
                                    <li>
                                        <p class="fas fa-circle">Tell: {{ $phone->number }} </p>
                                    </li>
                                @endforeach

                                @foreach ($locations as $location)
                                    <li>
                                        <p class="fas fa-circle">Address: {{ $location->country }} - {{ $location->state }} - {{ $location->city }} </p>
                                        <p class="fas fa-circle">{{ $location->description }}</p>
                                    </li>
                                @endforeach
                            </ul>
                            <!-- Start PageTile -->
                            @php
                                $pageTitles = \App\Models\PageTitle::whereStatus(1)->wherePage('Contact Us Footer')->get();
                            @endphp
                            @if ($pageTitles->count() > 0)
                                @foreach ($pageTitles as $pageTitle)
                                    <p class="text-center">{{ $pageTitle->title }}</p>
                                @endforeach
                            @endif
                            <!-- End PageTile -->

                            @foreach ($socials as $social)
                                <a href="{{ $social->link }}" target="_blank" class="social-link">
                                    <img src="{{ asset('images/icon/'.$social->type).'.png' }}" width="13%">
                                </a>
                            @endforeach
                            @foreach ($whats as $what)
                                <a href="https://wa.me/{{ $what->number }}" target="_blank" class="social-link">
                                    <img src="{{ asset('images/icon/'.$what->type).'.png' }}" width="13%">
                                </a>
                            @endforeach

                        </div>

                    </div>


                </div>

            </div>
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
    </div>


@endsection
