<!DOCTYPE html>
<html lang="de">

<head>
    @section('title', 'Impressum')
    @include('includes.head')

    <link rel="stylesheet" href="{{ asset('asset/css/HomePage.css') }}">
</head>

<body class="MainContainer">
<header class="headerContainer navContainer">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"> <img src="{{ asset('asset/images/logo.png') }}" width="90"
                        height="48" alt="logoContainer"></a>
                <button class="navbar-toggler navbar navbar-light" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0 CenterAnchorTagsContainer">
                        <li class="nav-item"><a class="nav-link anchor {{ request()->is('/') ? 'active' : '' }}"
                                aria-current="page" href="/">Home</a></li>
                        @auth
                            <li class="nav-item"><a class="nav-link  anchor {{ request()->is('tools') ? 'active' : '' }}"
                                    href="/tools">Tools</a></li>
                            <li class="nav-item profile_u" id="userprofile"><a
                                    class="nav-link  anchor {{ request()->is('profile') ? 'active' : '' }}"
                                    href="/profile">Profil</a></li>
                            <li class="nav-item archive" id="archive"><a
                                    class="nav-link anchor {{ request()->is('archive') ? 'active' : '' }}"
                                    href="/archive">Archiv</a></li>
                        @endauth
                    </ul>
                    <div class="rightContainer">
                        @auth
                            <div class="logOutbutton">
                                <img style="cursor: pointer" src="{{ asset('asset/images/LogOut.svg') }}"
                                    onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();"
                                    alt="Log Out">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf
                                </form>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>

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
