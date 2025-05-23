<!DOCTYPE html>
<html lang="de">

<head>
    @section('title', 'Impressum')
    @include('components.head')
    
</head>

<body class="MainContainer">
    <div class="headerSpacer"></div>
    @include('components.navbar')
    @include('components.arrowupbutton')

    @guest
        @include('components.login-modal')
        @include('components.signup-modal')

        @include('components.tooglePasswordVisibility')
    @endguest
    
    <section class="blog_sec">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                <div class="headerSpacer"></div>
                    <h2>Impressum</h2>

                    <p class="mb-2">Angaben gemäß § 5 TMG:</p>

                    <p><strong>Abeln Goltz GbR</strong><br /> Adalbert-Stifter-Stra&szlig;e 14<br />30655 Hannover</p>
                    <br />

                    <p><strong>Vertreten durch:</strong><br />
                        Tom Niclas Abeln, Timo Goltz</p>
                    <br />

                    <h4>Kontakt</h4>
                    <p>Telefon: +49 155 60106486<br />
                        E-Mail:
                        <a href="mailto:info@studygenie.de">info@studygenie.de</a> - Für Anfragen zu Abrechnungen, Erstattungen, Feedback und ähnliche Anliegen.<br />
                        <a href="mailto:kontakt@studygenie.de">kontakt@studygenie.de</a> - Für Kooperations- und sonstige Geschäftsanfragen.
                    <br />

                    <h4>Umsatzsteuer-ID</h4>
                    <p>Umsatzsteuer-Identifikationsnummer gem&auml;&szlig; &sect; 27 a Umsatzsteuergesetz:<br />
                        25/235/00307</p>
                    <br />

                    <h4>EU-Streitschlichtung</h4>
                    <p>Die Europ&auml;ische Kommission stellt eine Plattform zur Online-Streitbeilegung (OS) bereit: <a
                            href="https://ec.europa.eu/consumers/odr/" target="_blank"
                            rel="noopener noreferrer">https://ec.europa.eu/consumers/odr/</a>.<br /> Unsere
                        E-Mail-Adresse finden Sie oben im Impressum.</p>
                    <br />

                    <h4>Verbraucher&shy;streit&shy;beilegung/Universal&shy;schlichtungs&shy;stelle</h4>
                    <p>Wir sind nicht bereit oder verpflichtet, an Streitbeilegungsverfahren vor einer
                        Verbraucherschlichtungsstelle teilzunehmen.</p>
                    <br />

                    <h4>Zentrale Kontaktstelle nach dem Digital Services Act - DSA (Verordnung (EU) 2022/265)</h4>
                    <p>Unsere zentrale Kontaktstelle f&uuml;r Nutzer und Beh&ouml;rden nach Art. 11, 12 DSA erreichen
                        Sie wie folgt:</p>
                    <p>E-Mail: <a href="mailto:info@studygenie.de">info@studygenie.de</a><br />
                        Telefon: +49 155 60106486
                    </p>
                    <br />
                    <p>Die für den Kontakt zur Verf&uuml;gung stehenden Sprachen sind: Deutsch, Englisch.</p>

                </div>
            </div>
    </section>

@include('components.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    
</body>

</html>