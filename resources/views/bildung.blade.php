<!DOCTYPE html>
<html lang="de">

<head>
    @section('title', 'Bildung')
    @include('components.head')
    <link rel="stylesheet" href="{{ asset('asset/css/clouds.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="MainContainer">
    <div class="headerSpacer"></div>
        @include('components.navbar')
    @include('components.feedback')
    @include('components.mobile_warning')
    @include('components.toolsperre')

    <main class="mainContainer">
        <img src="{{ asset('asset/images/ab1.svg') }}" class="ab1" alt="" loading="lazy">
        <img src="{{ asset('asset/images/ab2.svg') }}" class="ab2" alt="" loading="lazy">
        <img src="{{ asset('asset/images/ab3.svg') }}" class="ab3" alt="" loading="lazy">
        <img src="{{ asset('asset/images/ab4.svg') }}" class="ab4" alt="" loading="lazy">

        <div class="headerMainContainer">
            <div class="closetool" onclick="window.location.href='/tools'" style="cursor: pointer">
                <img id="closeIcon" src="{{ asset('asset/images/ic_close.png') }}" alt="closeIcon">
            </div>
            <div class="centerCon">
                <h1>Genie Bildung</h1><br />
                <img id="StudyGenieImage" src="{{ asset('asset/images/toolsImage.svg') }}" alt="StudyGenieImage">
            </div>
        </div>

        <div class="categoryClouds">
            <a href="{{ route('bildung.geniecheck.create') }}" class="Cloud">
                <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="Soforthilfe für alle deine Fragen">
                    <img src="{{ asset('asset/images/info.svg') }}" width="20" alt="" loading="lazy">
                </button>
                <svg xmlns="http://www.w3.org/2000/svg" width="245" height="167" viewBox="0 0 245 167" fill="none">
                    <image href="{{ asset('asset/images/cloud-background.svg') }}" width="245" height="167"/>
                    <x-cloud-content 
                        tool-name="Fragen" 
                        bg-color="#E09E50"
                        text-color="#FFFFFF"
                        position-x="30"
                        position-y="30"
                    />
                </svg>
            </a>

            @php
                $check = false;
                $date = auth()->user()->expire_date;
                $subscriptionName = auth()->user()->subscription_name;
                if (
                    $subscriptionName == 'Diamant' ||
                    ($date != null && \Carbon\Carbon::parse($date)->gt(\Carbon\Carbon::now()))
                ) {
                    $check = true;
                }
            @endphp

            @if ((auth()->user()->subscription_name == 'Gold' || auth()->user()->subscription_name == 'Diamant') && $check)
                <a href="{{ route('bildung.texte') }}" class="Cloud">
                    <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Textkorrekturen und -inspiration für Grammatik, Stil und mehr">
                        <img src="{{ asset('asset/images/info.svg') }}" width="20" alt="" loading="lazy">
                    </button>
                    <svg xmlns="http://www.w3.org/2000/svg" width="245" height="167" viewBox="0 0 245 167" fill="none">
                        <image href="{{ asset('asset/images/cloud-background.svg') }}" width="245" height="167"/>
                        <x-cloud-content 
                            tool-name="Texte" 
                            bg-color="#E09E50"
                            text-color="#FFFFFF"
                            position-x="30"
                            position-y="30"
                        />
                    </svg>
                </a>
            @else
                <a onclick="showDialog();" class="Cloud custom-hover">
                    <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Textkorrekturen und -inspiration für Grammatik, Stil und mehr">
                        <img src="{{ asset('asset/images/info.svg') }}" width="20" alt="" loading="lazy">
                    </button>
                    <svg xmlns="http://www.w3.org/2000/svg" width="245" height="167" viewBox="0 0 245 167" fill="none">
                        <image href="{{ asset('asset/images/cloud-background.svg') }}" width="245" height="167"/>
                        <x-cloud-content 
                            tool-name="Texte" 
                            bg-color="grey"
                            text-color="#FFFFFF"
                            position-x="30"
                            position-y="30"
                        />
                    </svg>
                </a>
            @endif

            @if (auth()->user()->subscription_name == 'Diamant' && $check)
                <a href="{{ route('bildung.tutor.create') }}" class="Cloud">
                    <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Dein Lerncoach für deine Fragen, Übungen und Lernpläne.">
                        <img src="{{ asset('asset/images/info.svg') }}" width="20" alt="" loading="lazy">
                    </button>
                    <svg xmlns="http://www.w3.org/2000/svg" width="245" height="167" viewBox="0 0 245 167" fill="none">
                        <image href="{{ asset('asset/images/cloud-background.svg') }}" width="245" height="167"/>
                        <x-cloud-content 
                            tool-name="Tutor" 
                            bg-color="#E09E50"
                            text-color="#FFFFFF"
                            position-x="30"
                            position-y="30"
                        />
                    </svg>
                </a>
            @else
                <!-- Gesperrte Tutor-Cloud mit grauer Farbe -->
                <a onclick="showDialog();" class="Cloud custom-hover">
                    <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Dein Lerncoach für deine Fragen, Übungen und Lernpläne.">
                        <img src="{{ asset('asset/images/info.svg') }}" width="20" alt="" loading="lazy">
                    </button>
                    <svg xmlns="http://www.w3.org/2000/svg" width="245" height="167" viewBox="0 0 245 167" fill="none">
                        <image href="{{ asset('asset/images/cloud-background.svg') }}" width="245" height="167"/>
                        <x-cloud-content 
                            tool-name="Tutor" 
                            bg-color="grey"
                            text-color="#FFFFFF"
                            position-x="30"
                            position-y="30"
                        />
                    </svg>
                </a>
            @endif
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> 
</body>
</html>
