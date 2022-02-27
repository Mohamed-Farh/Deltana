<!-- start footer -->
<div class="footer py-4 ">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4">
                <!-- Start PageTile -->
                @php
                    $pageTitles = \App\Models\PageTitle::whereStatus(1)->wherePage('Footer')->get();
                @endphp
                @if ($pageTitles->count() > 0)
                    @foreach ($pageTitles as $pageTitle)
                        <p class="text-left">{{ $pageTitle->title }}</p>
                    @endforeach
                @endif
                <!-- End PageTile -->

                @php
                    $socials = \App\Models\SocialMedia::whereStatus(1)->orderBy('id', 'desc')->get();
                    $whats  = \App\Models\Phone::whereType('WhatsApp')->whereStatus(1)->orderBy('id', 'desc')->get();
                    $phones  = \App\Models\Phone::whereType('Phone')->whereStatus(1)->orderBy('id', 'desc')->get();
                    $emails = \App\Models\Email::whereStatus(1)->orderBy('id', 'desc')->get();

                @endphp
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
            <div class="col-xs-12 col-sm-12 col-md-4 text-center">
                <div class="row">
                    <div class="col">
                        <ul class="ul-links text-center">
                            <li><a href="{{ route('frontend.index') }}">Home</a></li>
                            <li><a href="{{ route('frontend.kayan') }}">Kayan</a></li>
                            <li><a href="{{ route('frontend.infinity') }}">Infinity</a></li>
                        </ul>

                    </div>
                    <div class="col">
                        <ul class="ul-links text-center">
                            <li><a href="{{ route('frontend.careers') }}">Jobs</a></li>
                            <li><a href="{{ route('frontend.about-us') }}">About Us</a></li>
                            <li><a href="{{ route('frontend.contact') }}">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4">
                <h5>Contact</h5>
                <ul class="ul-contact">
                    @foreach ($emails as $email)
                        <li><a href="{{ $email->email }}">{{ $email->email }}</a></li>
                    @endforeach

                    @foreach ($phones as $phone)
                        <li>
                            <p class="hotline-para">Hotlione: {{ $phone->number }} </p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- end footer -->


<!-- start line sec -->
<div class="line-1">
</div>
<!-- end line sec -->


<!-- start copy right -->
<div class="copy-right py-4">
    <div class="container">
        <p>DESIGN BY DELTANA - © 2019. ALL RIGHTS RESERVED.</p>
    </div>
</div>
<!-- end copy right -->
