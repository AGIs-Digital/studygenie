<!DOCTYPE html>
<html lang="de">

<head>
    @section('title', 'GenieKarriere')
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
        <img src="{{ asset('asset/images/ab1.svg') }}" class="ab1" alt="">
        <img src="{{ asset('asset/images/ab2.svg') }}" class="ab2" alt="">
        <img src="{{ asset('asset/images/ab3.svg') }}" class="ab3" alt="">
        <img src="{{ asset('asset/images/ab4.svg') }}" class="ab4" alt="">

        <div class="headerMainContainer">
            <div class="closetool" onclick="window.location.href='/tools'" style="cursor: pointer">
                <img id="closeIcon" src="{{ asset('asset/images/ic_close.png') }}" alt="closeIcon">
            </div>
            <div class="centerCon">
                <h1>Genie Karriere</h1><br />
                <img id="StudyGenieImage" src="{{ asset('asset/images/toolsImage.svg') }}" alt="StudyGenieImage">
            </div>
        </div>

        <div class="categoryClouds">
            <a href="{{ route('karriere.berufe') }}" class="Cloud_Karriere">
                <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" 
                        title="Entdecke deine idealen Berufe und erfahre alles Wichtige!">
                    <img src="{{ asset('asset/images/info.svg') }}" width="20" alt="">
                </button>
                <svg xmlns="http://www.w3.org/2000/svg" width="245" height="167" viewBox="0 0 245 167" fill="none">
                    <image href="{{ asset('asset/images/cloud-background.svg') }}" width="245" height="167"/>
                    <x-cloud-content 
                        tool-name="Berufe" 
                        bg-color="#2D3E4E"
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
                    ($date != null && \Carbon\Carbon::parse($date)->gt(\Carbon\Carbon::now()))) {
                    $check = true;
                }
            @endphp

            @if ((auth()->user()->subscription_name == 'Gold' || auth()->user()->subscription_name == 'Diamant') && $check)
                <a href="{{ route('karriere.bewerbung') }}" class="Cloud_Karriere">
                    <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Erstelle blitzschnell individuelle Bewerbungsunterlagen">
                        <img src="{{ asset('asset/images/info.svg') }}" width="20" alt="">
                    </button>
                    <svg xmlns="http://www.w3.org/2000/svg" width="245" height="167" viewBox="0 0 245 167" fill="none">
                        <image href="{{ asset('asset/images/cloud-background.svg') }}" width="245" height="167"/>
                        <x-cloud-content 
                            tool-name="Bewerbung" 
                            bg-color="2D3E4E"
                            text-color="#FFFFFF"
                            position-x="30"
                            position-y="30"
                        />
                    </svg>
                </a>
            @else
                <a onclick="showDialog();" class="Cloud_Karriere custom-hover">
                    <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Erstelle blitzschnell individuelle Bewerbungsunterlagen">
                        <img src="{{ asset('asset/images/info.svg') }}" width="20" alt="">
                    </button>
                    <svg xmlns="http://www.w3.org/2000/svg" width="245" height="167" viewBox="0 0 245 167" fill="none">
                        <image href="{{ asset('asset/images/cloud-background.svg') }}" width="245" height="167"/>
                        <x-cloud-content 
                            tool-name="Bewerbung" 
                            bg-color="grey"
                            text-color="#FFFFFF"
                            position-x="30"
                            position-y="30"
                        />
                    </svg>
                </a>
            @endif

            @if (auth()->user()->subscription_name == 'Diamant' && $check)
                <a href="{{ route('karriere.mentor') }}" class="Cloud_Karriere">
                    <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" 
                            title="Trainiere für Vorstellungsgespräche mit Tipps und Übungen für mehr Selbstsicherheit.">
                        <img src="{{ asset('asset/images/info.svg') }}" width="20" alt="">
                    </button>
                    <svg xmlns="http://www.w3.org/2000/svg" width="245" height="167" viewBox="0 0 245 167" fill="none">
                        <image href="{{ asset('asset/images/cloud-background.svg') }}" width="245" height="167"/>
                        <x-cloud-content 
                            tool-name="Mentor" 
                            bg-color="#2D3E4E"
                            text-color="#FFFFFF"
                            position-x="30"
                            position-y="30"
                        />
                    </svg>
                </a>
            @else
                <!-- Gesperrte Mentor-Cloud mit grauer Farbe -->
                <a onclick="showDialog();" class="Cloud_Karriere custom-hover">
                    <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" 
                            title="Trainiere für Vorstellungsgespräche mit Tipps und Übungen für mehr Selbstsicherheit.">
                        <img src="{{ asset('asset/images/info.svg') }}" width="20" alt="">
                    </button>
                    <svg xmlns="http://www.w3.org/2000/svg" width="245" height="167" viewBox="0 0 245 167" fill="none">
                        <image href="{{ asset('asset/images/cloud-background.svg') }}" width="245" height="167"/>
                        <x-cloud-content 
                            tool-name="Mentor" 
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
    
</body>

</html>
