<!-- start navbar sec -->
<div class="nav-bar-sec ">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('frontend.index') }}">
            @php $logo = \App\Models\Logo::whereStatus(1)->whereColor(1)->first(); @endphp
            @if ($logo)
                <img src="{{ asset($logo->logo) }}" style="width: 30%;"></a>
            @else
                <img src="{{ asset('images/Mask Group 1.png') }}" style="width: 50%;"></a>
            @endif
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ">
                <li class="nav-item active ">
                    <a class="nav-link cool-link" href="{{ route('frontend.index') }}">HOME <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-expanded="false">
                        Company
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item " href="{{ route('frontend.careers') }}">JOBS</a>
                        <a class="dropdown-item " href="{{ route('frontend.about-us') }}">ABOUT US</a>
                        <a class="dropdown-item " href="{{ route('frontend.process') }}">Process</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link cool-link" href="{{ route('frontend.kayan') }}">KAYAN</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link cool-link" href="{{ route('frontend.infinity') }}"> INFINTY</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link cool-link" href="{{ route('frontend.our-work') }}"> OUR WORK</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link cool-link" href="{{ route('frontend.contact') }}">CONTACT</a>
                </li>
            </ul>
        </div>
    </nav>

</div>
<!-- end navbar sec -->
