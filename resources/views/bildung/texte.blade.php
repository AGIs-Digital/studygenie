<!DOCTYPE html>
<html lang="de">

<head>
    @section('title', 'Genie Texte')
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
            <div class="closetool" onclick="window.location.href='/bildung'" style="cursor: pointer">
                <img id="closeIcon" src="{{ asset('asset/images/ic_close.png') }}" alt="closeIcon">
            </div>
            <div class="centerCon">
                <h1>Genie Texte</h1><br />
                <img id="StudyGenieImage" src="{{ asset('asset/images/toolsImage.svg') }}" alt="StudyGenieImage">
            </div>
        </div>

        <div class="categoryClouds twoClouds">
            <a href="{{ route('bildung.textinspiration') }}" class="Cloud" id="textInspirationCloud">
                <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" 
                        title="Knüpfe an deinen Text an und lass dich inspirieren.">
                    <img src="{{ asset('asset/images/info.svg') }}" width="20" alt="Info">
                </button>
                <svg xmlns="http://www.w3.org/2000/svg" width="245" height="167" viewBox="0 0 245 167" fill="none">
                    <image href="{{ asset('asset/images/cloud-background.svg') }}" width="245" height="167"/>
                    <x-cloud-content 
                        tool-name="Inspiration" 
                        bg-color="#E09E50"
                        text-color="#FFFFFF"
                        position-x="30"
                        position-y="30"
                    />
                </svg>
            </a>

            <a href="{{ route('bildung.textanalysis') }}" class="Cloud" id="textInspirationCloud2">
                <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" 
                        title="Schnelle Textkorrektur für Grammatik, Stil und mehr.">
                    <img src="{{ asset('asset/images/info.svg') }}" width="20" alt="Info">
                </button>
                <svg xmlns="http://www.w3.org/2000/svg" width="245" height="167" viewBox="0 0 245 167" fill="none">
                    <image href="{{ asset('asset/images/cloud-background.svg') }}" width="245" height="167"/>
                    <x-cloud-content 
                        tool-name="Analyse" 
                        bg-color="#E09E50"
                        text-color="#FFFFFF"
                        position-x="30"
                        position-y="30"
                    />
                </svg>
            </a>
        </div>
    </main>

</body>

</html>
