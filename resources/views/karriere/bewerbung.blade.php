<!DOCTYPE html>
<html lang="de">

<head>
    @section('title', 'Genie Bewerbung')
    @include('components.head')
    <link rel="stylesheet" href="{{ asset('asset/css/clouds.css') }}">
</head>

<body class="MainContainer">
    <div class="headerSpacer"></div>
        @include('components.navbar')
    @include('components.feedback')
    @include('components.mobile_warning')

    <main class="mainContainer">
        <img src="{{ asset('asset/images/ab1.svg') }}" class="ab1" alt="">
        <img src="{{ asset('asset/images/ab2.svg') }}" class="ab2" alt="">
        <img src="{{ asset('asset/images/ab3.svg') }}" class="ab3" alt="">
        <img src="{{ asset('asset/images/ab4.svg') }}" class="ab4" alt="">

        <div class="headerMainContainer">
            <div class="closetool" onclick="window.location.href='/karriere'" style="cursor: pointer">
                <img id="closeIcon" src="{{ asset('asset/images/ic_close.png') }}" alt="closeIcon">
            </div>
            <div class="centerCon">
                <h1>Genie Bewerbung</h1><br />
                <img id="StudyGenieImage" src="{{ asset('asset/images/toolsImage.svg') }}" alt="StudyGenieImage">
            </div>
        </div>

        <div class="categoryClouds twoClouds">
            <a href="{{ route('karriere.lebenslauf') }}" class="Cloud_Karriere small" id="textInspirationCloud">
                <svg xmlns="http://www.w3.org/2000/svg" width="245" height="167" viewBox="0 0 245 167" fill="none">
                    <image href="{{ asset('asset/images/cloud-background.svg') }}" width="245" height="167"/>
                    <x-cloud-content 
                        tool-name="Lebenslauf" 
                        bg-color="#2D3E4E"
                        text-color="#FFFFFF"
                        position-x="30"
                        position-y="30"
                        size="small"
                    />
                </svg>
            </a>

            <a href="{{ route('karriere.motivation') }}" class="Cloud_Karriere small" id="textInspirationCloud2">
                <svg xmlns="http://www.w3.org/2000/svg" width="245" height="167" viewBox="0 0 245 167" fill="none">
                    <image href="{{ asset('asset/images/cloud-background.svg') }}" width="245" height="167"/>
                    <x-cloud-content 
                        tool-name="Motivationsschreiben" 
                        bg-color="#2D3E4E"
                        text-color="#FFFFFF"
                        position-x="30"
                        position-y="30"
                        size="small"
                    />
                </svg>
            </a>
        </div>
    </main>

</body>

</html>
