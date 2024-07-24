<!DOCTYPE html>
<html lang="de">

<head>
    @section('title', 'AGBs')
    @include('includes.head')
    <link rel="stylesheet" href="{{ asset('asset/css/homepage.css') }}">
</head>

<body class="MainContainer">
    @include('includes.header')
    <section class="blog_sec">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h1>AGB‘s</h1>
                    <span class="heading"> Allgemeine Geschäftsbedingungen (AGB) von
                        StudyGenie </span> <span class="sub_head"> 1. <span>Geltungsbereich</span>
                    </span>
                    <ul>
                        <li>Diese Allgemeinen Geschäftsbedingungen (AGB) gelten für alle
                            Dienstleistungen und Produkte, die über die Website www.StudyGenie.de angeboten werden.</li>
                    </ul>
                    <span class="sub_head"> 2. <span>Dienstleistungen</span>
                    </span>
                    <ul>
                        <li>StudyGenie bietet Online-Lern- und Karriereberatungsdienste
                            an. Die genauen Dienstleistungsspezifikationen sind auf der
                            Website beschrieben.</li>
                    </ul>
                    <span class="sub_head"> 3. <span>Registrierung und Nutzerkonto</span>
                    </span>
                    <ul>
                        <li>Für die vollständige Nutzung der Dienste ist eine
                            Registrierung und die Erstellung eines Nutzerkontos erforderlich.
                            Der Nutzer verpflichtet sich, ehrliche und aktuelle Informationen
                            bereitzustellen.</li>
                    </ul>
                    <span class="sub_head"> 4. <span>Datenschutz</span>
                    </span>
                    <ul>
                        <li>Persönliche Daten werden gemäß unserer Datenschutzrichtlinie
                            behandelt, die auf der Website einsehbar ist.</li>
                    </ul>
                    <span class="sub_head"> 5. <span>Nutzungsbedingungen</span>
                    </span>
                    <ul>
                        <li>Die bereitgestellten Inhalte dürfen nicht für illegale Zwecke
                            verwendet werden. Jede Form von Missbrauch, wie das Kopieren oder
                            Verbreiten von Materialien, ist untersagt.</li>
                    </ul>
                    <span class="sub_head"> 6. <span>Zahlungsbedingungen</span>
                    </span>
                    <ul>
                        <li>Die Bezahlung der Dienstleistungen erfolgt gemäß den auf der
                            Website angegebenen Tarifen. Alle Zahlungen sind in der auf der
                            Website angegebenen Währung zu leisten.</li>
                    </ul>
                    <span class="sub_head"> 7. <span>Kündigung</span>
                    </span>
                    <ul>
                        <li>Abonnements können gemäß den auf der Website beschriebenen
                            Kündigungsbedingungen beendet werden.</li>
                    </ul>
                    <span class="sub_head"> 8. <span>Haftungsbeschränkung</span>
                    </span>
                    <ul>
                        <li>StudyGenie haftet nicht für indirekte Schäden oder
                            Folgeschäden, die sich aus der Nutzung der Dienste ergeben.</li>
                    </ul>
                    <span class="sub_head"> 9. <span>Haftungsbeschränkung</span>
                    </span>
                    <ul>
                        <li>StudyGenie behält sich das Recht vor, diese AGB jederzeit zu
                            ändern. Die aktuellste Version der AGB ist auf der Website
                            einsehbar.</li>
                    </ul>
                    <span class="sub_head"> 10. <span>Haftungsbeschränkung</span>
                    </span>
                    <ul>
                        <li>Sollten einzelne Bestimmungen dieser AGB unwirksam sein, so
                            bleibt die Wirksamkeit der übrigen Bestimmungen unberührt.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <footer class="mainFooterContainer">
        <div class="footerContainer">
            <img id="footerLogo" src="{{ asset('asset/images/Logo (2).png') }}" width="133" height="77"
                alt="Logo " loading="lazy">
            <div class="CenterContainer">
                <div class="anchorTagsFooterContainer">
                    <a href="/impressum" class="footerHeading"> Impressum </a>
                </div>
                <div class="anchorTagsFooterContainer">
                    <a href="/agb" class="footerHeading"> AGBs </a>

                </div>
                <div class="anchorTagsFooterContainer">
                    <a href="/datenschutz" class="footerHeading"> Datenschutz </a>
                </div>

            </div>

            <div class="rightContainer" style="gap: 0rem;">
                <div class="socialAnchorTags">
                    <a href=""><img id="instagram" src="{{ asset('asset/images/instagram.svg') }}"
                            alt="Instagram" loading="lazy"></a>
                    <a href=""><img id="tiktok" src="{{ asset('asset/images/tiktok.svg') }}" alt="TikTok"
                            loading="lazy"></a> <a href=""><img id="linkedin"
                            src="{{ asset('asset/images/linkedin.svg') }}" alt="LinkedIn" loading="lazy"></a>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"
        type="text/javascript"></script>
</body>

</html>
