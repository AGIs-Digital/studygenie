<!DOCTYPE html>
<html lang="de">

<head>
    @section('title', 'Impressum')
    @include('includes.head')

    <link rel="stylesheet" href="{{ asset('asset/css/homepage.css') }}">
</head>

<body class="MainContainer">
    @include('includes.header')

    <section class="blog_sec">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h1>Impressum</h1>

                    <p class="mb-2">Angaben gemäß § 5 TMG:</p>

                    <p><strong>Abeln Goltz GbR</strong><br /> Adalbert-Stifter-Stra&szlig;e 14<br />30655 Hannover</p>
                    <br />

                    <p><strong>Vertreten durch:</strong><br />
                        Tom Niclas Abeln, Timo Goltz</p>
                    <br />

                    <h2>Kontakt</h2>
                    <p>Telefon: +49 155 60106486<br />
                        E-Mail: <a href="mailto:info@agis.digital">info@agis.digital</a></p>
                    <br />

                    <h2>Umsatzsteuer-ID</h2>
                    <p>Umsatzsteuer-Identifikationsnummer gem&auml;&szlig; &sect; 27 a Umsatzsteuergesetz:<br />
                        25/235/00307</p>
                    <br />

                    <h2>EU-Streitschlichtung</h2>
                    <p>Die Europ&auml;ische Kommission stellt eine Plattform zur Online-Streitbeilegung (OS) bereit: <a
                            href="https://ec.europa.eu/consumers/odr/" target="_blank"
                            rel="noopener noreferrer">https://ec.europa.eu/consumers/odr/</a>.<br /> Unsere
                        E-Mail-Adresse finden Sie oben im Impressum.</p>
                    <br />

                    <h2>Verbraucher&shy;streit&shy;beilegung/Universal&shy;schlichtungs&shy;stelle</h2>
                    <p>Wir sind nicht bereit oder verpflichtet, an Streitbeilegungsverfahren vor einer
                        Verbraucherschlichtungsstelle teilzunehmen.</p>
                    <br />

                    <h2>Zentrale Kontaktstelle nach dem Digital Services Act - DSA (Verordnung (EU) 2022/265)</h2>
                    <p>Unsere zentrale Kontaktstelle f&uuml;r Nutzer und Beh&ouml;rden nach Art. 11, 12 DSA erreichen
                        Sie wie folgt:</p>
                    <p>E-Mail: <a href="mailto:info@agis.digital">info@agis.digital</a><br />
                        Telefon: +49 155 60106486
                    </p>
                    <br />
                    <p>Die für den Kontakt zur Verf&uuml;gung stehenden Sprachen sind: Deutsch, Englisch.</p>

                </div>
            </div>
    </section>

    <footer class="mainFooterContainer">
        <div class="footerContainer">
            <img id="footerLogo" src="{{ asset('asset/images/Logo_(2).png') }}" width="133" height="77"
                alt="Logo " loading="lazy">
            <div class="CenterContainer">
                <div class="anchorTagsFooterContainer">
                    <a href="{{ route('impressum') }}" class="footerHeading"> Impressum </a>
                </div>
                <div class="anchorTagsFooterContainer">
                    <a href="{{ route('agb') }}" class="footerHeading"> AGBs </a>

                </div>
                <div class="anchorTagsFooterContainer">
                    <a href="{{ route('datenschutz') }}" class="footerHeading"> Datenschutz </a>
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
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
