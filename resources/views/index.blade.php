<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>StudyGenie</title>
<link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    rel="stylesheet">

<link rel="stylesheet"
    href="{{ asset('asset/css/navBarHomeStyles.css') }}">
<link rel="stylesheet" href="{{ asset('asset/css/HomePage.css') }}">
<link rel="stylesheet" href="{{ asset('asset/css/utilities.css') }}">
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
<link rel="apple-touch-icon" sizes="57x57"
    href="/favicon/apple-icon-57x57.png" alt="Apple Touch Icon 57x57">
<link rel="apple-touch-icon" sizes="60x60"
    href="/favicon/apple-icon-60x60.png" alt="Apple Touch Icon 60x60">
<link rel="apple-touch-icon" sizes="72x72"
    href="/favicon/apple-icon-72x72.png" alt="Apple Touch Icon 72x72">
<link rel="apple-touch-icon" sizes="76x76"
    href="/favicon/apple-icon-76x76.png" alt="Apple Touch Icon 76x76">
<link rel="apple-touch-icon" sizes="114x114"
    href="/favicon/apple-icon-114x114.png" alt="Apple Touch Icon 114x114">
<link rel="apple-touch-icon" sizes="120x120"
    href="/favicon/apple-icon-120x120.png" alt="Apple Touch Icon 120x120">
<link rel="apple-touch-icon" sizes="144x144"
    href="/favicon/apple-icon-144x144.png" alt="Apple Touch Icon 144x144">
<link rel="apple-touch-icon" sizes="152x152"
    href="/favicon/apple-icon-152x152.png" alt="Apple Touch Icon 152x152">
<link rel="apple-touch-icon" sizes="180x180"
    href="/favicon/apple-icon-180x180.png" alt="Apple Touch Icon 180x180">
<link rel="icon" type="image/png" sizes="192x192"
    href="/favicon/android-icon-192x192.png" alt="Android Icon 192x192">
<link rel="icon" type="image/png" sizes="32x32"
    href="/favicon/favicon-32x32.png" alt="Favicon 32x32">
<link rel="icon" type="image/png" sizes="96x96"
    href="/favicon/favicon-96x96.png" alt="Favicon 96x96">
<link rel="icon" type="image/png" sizes="16x16"
    href="/favicon/favicon-16x16.png" alt="Favicon 16x16">
<link rel="manifest" href="/favicon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage"
    content="/favicon/ms-icon-144x144.png" alt="MS Application Tile Image">
<meta name="theme-color" content="#ffffff">

</head>
<body class="MainContainer">
    <header class="headerContainer">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/"> <img
                        src="{{ asset('asset/images/logo.png') }}" width="90" height="48"
                        alt="StudyGenie Logo" loading="lazy"></a>
                    <button class="navbar-toggler navbar navbar-light" type="button"
                        data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        @guest @else
                        <ul class="navbar-nav mx-auto mb-2 mb-lg-0 anchorTagsContainer">
                            <li class="nav-item"><a class="nav-link anchor active"
                                aria-current="page" href="/">Home</a></li>
                            <li class="nav-item"><a class="nav-link  anchor" href="/tools">Tools</a>
                            </li>

                            <li class="nav-item"><a class="nav-link anchor" href="/profile">Profil</a>
                            </li>
                            <li class="nav-item"><a class="nav-link anchor" href="/archive">Archiv</a>
                            </li>
                        </ul>
                        @endguest

                        <ul class="navbar-nav ms-auto">
                            <!-- Authentication Links -->
                            @guest

                            <li class="nav-item"><a class="nav-link blog primary-button"
                                href="#">{{ __('Blog') }}</a></li>



                            <li class="nav-item">
                                <button class="primary-button" data-bs-toggle="modal"
                                    data-bs-target="#loginModal" id="loginButton">Log In</button>

                                {{-- <a class="nav-link primary-button" data-bs-toggle="modal"
                                data-bs-target="#" id="loginButton">{{ __('Log In') }}</a> --}}
                            </li> @else
                            <li class="nav-item"><a class="nav-link blog primary-button"
                                href="#">{{ __('Blog') }}</a></li>
                            <li class="nav-item dropdown"><a id="navbarDropdown"
                                class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" v-pre> {{ Auth::user()->name }} </a>

                                <div class="dropdown-menu dropdown-menu-end"
                                    aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }} </a>

                                    <form id="logout-form" action="{{ route('logout') }}"
                                        method="POST" class="d-none">@csrf</form>
                                </div></li> @endguest
                        </ul>

                    </div>
                </div>
            </nav>
        </div>

        <div class="container">
            <div class="mainImageContantContainer">

                <div class="contentContainer">
                    <h1 class="primary-heading">
                        <u>Bildung & Karriere</u></br> neu gedacht, mit</br> Genie
                        gemacht!
                    </h1>

                    <p class="primary-paragraph">
                        Chancengleichheit in Schule,</br>Studium und Karriere
                    </p>
                    <img src="{{ asset('asset/images/23.1.png') }}" alt="Z Design Illustration" loading="lazy">
                </div>

                <div class="imageContainer">
                    <img src="{{ asset('asset/images/illustrations/heroImage.svg') }}"
                        alt="Hauptbild" loading="lazy">
                </div>
            </div>
        </div>

        <div class="headerDesign">
            <img src="{{ asset('asset/images/Group 391.png') }}" alt="Haupt Hintergrundbild" loading="lazy">
        </div>
    </header>

    <section class="learnAnythingSection">
        <img class="crownImg" src="{{ asset('asset/images/Fill 7.png') }}"
            alt="Kronenbild" loading="lazy">

        <h1 class="secondary-Heading">Gemeinsam schaffen wir das</h1>

        <p class="secondary-Paragraph">Wir unterstützen dich in der Schule, im
            Studium und im Berufsstart.</p>

        <div class="video_sec">
            <video controls id="home_video" loading="lazy">
                <source src="{{ asset('asset/Videos/video.mp4') }}" type="video/mp4">
                <source src="{{ asset('asset/Videos/video.mp4') }}" type="video/ogg">
                Ihr Browser unterstützt das Video-Tag nicht.
            </video>
            <script>
                document.getElementById('home_video').addEventListener('contextmenu', function(e) {
                e.preventDefault();
                }, false);
            </script>
            <img class="learnAnythingImage"
                src="{{ asset('asset/images/pic_mac_book.png') }}" alt="Mac Book Bild" loading="lazy">
        </div>

        <div class="buttonContainer">
            <img src="{{ asset('asset/images/69.png') }}" alt="Vorwärtspfeil" loading="lazy">

            <button data-bs-toggle="modal" data-bs-target="#signupModal"
                class="plancardButton">Jetzt starten</button>

            <img src="{{ asset('asset/images/68.png') }}" alt="Rückwärtspfeil" loading="lazy">
        </div>
    </section>

    <section class="MathrixSection">
        <img src="{{ asset('asset/images/23.png') }}" alt="Z Design" loading="lazy">

        <h1 class="secondary-Heading">Was wir noch können</h1>

        <div class="testomnialDivision">

            <div class="testimonialCard">
                <img
                    src="{{ asset('asset/images/illustrations/Deine professionelle Bewerbung.png') }}"
                    alt="Testimonial Card" loading="lazy"> <span class="CardThumbnailSpan">Deine
                    professionelle Bewerbung</span>
            </div>
            <div class="testimonialCard">
                <img
                    src="{{ asset('asset/images/illustrations/Der perfekte Lernplan für dich.png') }}"
                    alt="Testimonial Card" loading="lazy"> <span class="CardThumbnailSpan">Der
                    perfekte Lernplan für dich</span>
            </div>
            <div class="testimonialCard">
                <img
                    src="{{ asset('asset/images/illustrations/Alles wichtige über deine Traumberufe.png') }}"
                    alt="Testimonial Card" loading="lazy"> <span class="CardThumbnailSpan">Alles
                    wichtige über deine Traumberufe</span>
            </div>
        </div>

        <div class="buttonContainer MathrixButtonContainer">
            <img src="{{ asset('asset/images/71.png') }}" alt="Vorwärtspfeil" loading="lazy">

            <button data-bs-toggle="modal" data-bs-target="#signupModal"
                class="plancardButton">Lege jetzt los</button>

            <img src="{{ asset('asset/images/70.png') }}" alt="Rückwärtspfeil" loading="lazy">
        </div>
    </section>

    <section class="witnessSection">
        <div class="container">
            <img class="crownImg mb-2"
                src="{{ asset('asset/images/Fill 7.png') }}" alt="Kronenbild" loading="lazy">

            <h1 class="secondary-Heading mb-2">Sie liebens!</h1>

            <div class="MainCardsContainer">
                <div class="CardDiv">
                    <img class="shadowOfCard"
                        src="{{ asset('asset/images/Vector 2.png') }}" alt="Karte 1 Hintergrund" loading="lazy">
                    <div class="card">
                        <img class="quoteMarks" src="{{ asset('asset/images/ic.png') }}"
                            alt="Zitatzeichen" loading="lazy">
                        <div class="thumbnail-Content-Container">
                            <img src="{{ asset('asset/images/illustrations/lukeg.png') }}"
                                alt="Thumbnail Luke G." loading="lazy"> <span class="thumbnailDescription">Luke G.</span>
                        </div>
                        « Ich habe jetzt einen klaren Überblick und kann genau fragen was
                        noch nicht verstanden habe »
                        </p>
                    </div>
                </div>
                <div class="CardDiv">
                    <img class="shadowOfCard2"
                        src="{{ asset('asset/images/2nd Card bg.png') }}"
                        alt="2nd Card Hintergrund" loading="lazy">
                    <div class="card card2">
                        <div class="thumbnail-Content-Container">
                            <img class="quoteMarks" src="{{ asset('asset/images/ic.png') }}"
                                alt="Zitatzeichen" loading="lazy"> <img
                                src="{{ asset('asset/images/illustrations/julias.png') }}"
                                alt="Thumbnail Julia S." loading="lazy"> <span class="thumbnailDescription">Julia S.</span>

                        </div>

                        « Mit StudyGenie fällt mir Lernen leichter und macht Spaß. »
                        </p>
                    </div>
                </div>

                <div class="CardDiv">
                    <img class="shadowOfCard3"
                        src="{{ asset('asset/images/3rd Card bg.png') }}"
                        alt="3rd Card Hintergrund" loading="lazy">
                    <div class="card">
                        <div class="thumbnail-Content-Container">
                            <img class="quoteMarks" src="{{ asset('asset/images/ic.png') }}"
                                alt="Zitatzeichen" loading="lazy"> <img
                                src="{{ asset('asset/images/illustrations/alexm.png') }}"
                                alt="Thumbnail Alex M." loading="lazy"> <span class="thumbnailDescription">Alex M.</span>
                        </div>
                        « StudyGenie ist einfach nice. Ich kann so lernen wie ich will! »
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="tutorialSection">
        <div class="container">
            <img class="crownImg mb-2"
                src="{{ asset('asset/images/Fill 7.png') }}" alt="Kronenbild" loading="lazy">

            <h1 class="secondary-Heading mb-2">Wünsch dir was</h1>

            <div class="cardsContainer">
                <div class="parent-card">
                    <div class="cards">
                        <img
                            src="{{ asset('asset/images/Illustrations/Berufsinformationen.png') }}"
                            width="90" height="90" alt="Berufsinformationen " loading="lazy">
                        <p class="cardPara">Berufsinformationen</p>
                    </div>
                </div>
                <div class="parent-card">
                    <div class="cards">
                        <img
                            src="{{ asset('asset/images/Illustrations/Bewerbungscoach.png') }}"
                            width="90" height="90" alt="Bewerbungscoach " loading="lazy">
                        <p class="cardPara">Bewerbungscoach</p>
                    </div>
                </div>
                <div class="parent-card">
                    <div class="cards">
                        <img
                            src="{{ asset('asset/images/Illustrations/Lebenslauf.png') }}"
                            width="90" height="90" alt="Lebenslauf" loading="lazy">
                        <p class="cardPara">Lebenslauf</p>
                    </div>
                </div>
                <div class="parent-card">
                    <div class="cards">
                        <img src="{{ asset('asset/images/Illustrations/Lernplan.png') }}"
                            width="90" height="90" alt="Lernplan" loading="lazy">
                        <p class="cardPara">Lernplan</p>
                    </div>
                </div>
                <div class="parent-card">
                    <div class="cards">
                        <img
                            src="{{ asset('asset/images/Illustrations/Motivationsschreiben.png') }}"
                            width="90" height="90" alt="Motivationsschreiben " loading="lazy">
                        <p class="cardPara">Motivationsschreiben</p>
                    </div>
                </div>

                <div class="parent-card">
                    <div class="cards">
                        <img
                            src="{{ asset('asset/images/Illustrations/Textinspiration.png') }}"
                            width="90" height="90" alt="Textinspiration" loading="lazy">
                        <p class="cardPara">Textinspiration</p>
                    </div>
                </div>

                <div class="parent-card">
                    <div class="cards">
                        <img
                            src="{{ asset('asset/images/Illustrations/Textkorrekturen.png') }}"
                            width="90" height="90" alt="Textkorrekturen" loading="lazy">
                        <p class="cardPara">Textkorrekturen</p>
                    </div>
                </div>

                <div class="parent-card">
                    <div class="cards">
                        <img
                            src="{{ asset('asset/images/Illustrations/Übungsklausur.png') }}"
                            width="90" height="90" alt="Übungsklausur" loading="lazy">
                        <p class="cardPara">Übungsklausur</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div align="center">
        <img src="{{ asset('asset/images/23.png') }}"
            alt="Ein zentriertes Bild" loading="lazy">
    </div>
    <section class="planCardsSection">


        <h1 class="secondary-Heading planCardHeading">Dein persönlicher Genie</h1>

        <div class="planCardsContainer">
            <img id="upperDesign" src="{{ asset('asset/images/patterns.png') }}"
                alt="Oberes Design" loading="lazy">
            <div class="planCard">
                <div class="discountSticekr">
                    <img src="{{ asset('asset/images/Star 2.png') }}"
                        alt="Rabattsticker" id="discountStickerImg" loading="lazy"> <span
                        id="discountPercent">FREE</span>
                </div>
                <div class="headerPlanCard">
                    <img class="crownImg"
                        src="{{ asset('asset/images/illustrations/silber2.png') }}"
                        alt="Kronenbild Silber" loading="lazy">

                    <h1 class="secondary-Heading" style="color: #fff">Silber</h1>

                </div>
                <div class="contentPlanCard contentPlanCard1">

                    <span class="highWeightSpan">0 €<span class="lowWeightSpan"> mtl.</span></span>
                    <p class="planCardParagraph">
                        ✓ Korrekturen<br /> ✓ Berufsinformationen<br /> ✘ Inspirationen<br />
                        ✘ Bewerbungen<br /> ✘ Lernen<br /> ✘ Bewerbungstrainer
                    </p>

                    @guest
                    <button data-bs-toggle="modal" data-bs-target="#signupModal"
                        class="plancardButton">Jetzt ausprobieren</button>
                    @else @if(auth()->user()->subscription_name == 'silber')

                    <button class="plancardButton" disabled>Jetzt ausprobieren</button>

                    @else <a href="{{ route('paypal.payment','silber') }}"
                        class="plancardButton"> Jetzt ausprobieren </a> @endif @endguest
                </div>
            </div>
            <div class="planCard">
                <div class="headerPlanCard">
                    <img class="crownImg"
                        src="{{ asset('asset/images/illustrations/gold.png') }}"
                        alt="Kronenbild Gold" loading="lazy">

                    <h1 class="secondary-Heading" style="color: #fff">Gold</h1>

                </div>

                <div class="contentPlanCard contentPlanCard1">
                    <span class="highWeightSpan">10 €<span class="lowWeightSpan"> mtl.</span></span>
                    <p class="planCardParagraph">
                        ✓ Korrekturen<br /> ✓ Berufsinformationen<br /> ✓ Inspirationen<br />
                        ✓ Bewerbungen<br /> ✘ Lernen<br /> ✘ Bewerbungstrainer
                    </p>

                    @guest
                    <button data-bs-toggle="modal" data-bs-target="#signupModal"
                        class="plancardButton">Hol dir Gold</button>
                    @else @php $check = false; $date = auth()->user()->expire_date;
                    if($date != null &&
                    \Carbon\Carbon::parse($date)->gt(\Carbon\Carbon::now())){ $check =
                    true; } @endphp @if(auth()->user()->subscription_name == 'gold' &&
                    $check)

                    <button class="plancardButton" disabled>Hol dir Gold</button>

                    @else
                    <button
                        onclick="setModel('{{ route('paypal.payment','gold') }}','{{ route('stripe.payment','gold') }}')"
                        class="plancardButton">Hol dir Gold</button>
                    @endif @endguest
                </div>
                <br />
            </div>
            <div class="planCard ">
                <div class="headerPlanCard">
                    <img class="crownImg"
                        src="{{ asset('asset/images/illustrations/diamant.png') }}"
                        alt="Kronenbild Diamant" loading="lazy">
                    <h1 class="secondary-Heading" style="color: #fff">Diamant</h1>
                </div>

                <div class="contentPlanCard contentPlanCard1">
                    <span class="highWeightSpan">20 € <span class="lowWeightSpan">mtl.</span></span>

                    <p class="planCardParagraph">
                        ✓ Korrekturen<br /> ✓ Berufsinformationen<br /> ✓ Inspirationen<br />
                        ✓ Bewerbungen<br /> ✓ Lernen<br /> ✓ Bewerbungstrainer
                    </p>
                    @guest
                    <button data-bs-toggle="modal" data-bs-target="#signupModal"
                        class="plancardButton">Hol dir Diamant</button>
                    @else @if(auth()->user()->subscription_name == 'diamant' && $check)

                    <button class="plancardButton" disabled>Hol dir Diamant</button>

                    @else
                    <button
                        onclick="setModel('{{ route('paypal.payment','diamant') }}','{{ route('stripe.payment','diamant') }}')"
                        class="plancardButton">Hol dir Diamant</button>
                    @endif @endguest

                </div>
            </div>
            <img id="lowerDesign" src="{{ asset('asset/images/patterns1.png') }}"
                alt="Unteres Design" loading="lazy">
        </div>
    </section>

    <section class="joinNowSection">
        <img src="{{ asset('asset/images/Fill 7.png') }}" alt="Kronenbild" loading="lazy">

        <h1 class="secondary-Heading">Worauf wartest du?</h1>
        <p class="secondary-Paragraph">Starte jetzt kostenlos und mach dir das
            Leben leichter.</p>
    </section>

    <section class="frequentlyAskedQuestionSection">

        <img src="{{ asset('asset/images/23.png') }}" alt="Z Design" loading="lazy">

        <h1 class="secondary-Heading">Wissenswertes über StudyGenie</h1>

        <div class="questionsContainer">
            <div class="question">
                <div class="questionContentContainer">
                    <img class="plusIcon" src="{{ asset('asset/images/ic_plus.png') }}"
                        alt="Plus Icon" loading="lazy"> <img class="crossIcon"
                        src="{{ asset('asset/images/ic_cross.png') }}" alt="Kreuz Icon" loading="lazy">
                    Was unterscheidet StudyGenie von anderen Lern- und
                    Karriereplattformen?
                </div>
                <div class="answerContentContainer">StudyGenie setzt sich durch
                    seine KI-basierte Herangehensweise von anderen Lern- und
                    Karriereplattformen ab. Im Gegensatz zu statischen Inhalten anderer
                    Plattformen, bietet StudyGenie dynamische, individuell
                    zugeschnittene Unterstützung beim Lernen und in der
                    Karriereplanung.</div>
                <div class="divider"></div>

            </div>
            <div class="question">
                <div class="questionContentContainer">
                    <img class="plusIcon" src="{{ asset('asset/images/ic_plus.png') }}"
                        alt="Plus Icon" loading="lazy"> <img class="crossIcon"
                        src="{{ asset('asset/images/ic_cross.png') }}" alt="Kreuz Icon" loading="lazy">
                    Welche Daten werden gespeichert?
                </div>
                <div class="answerContentContainer">Wir speichern lediglich deinen
                    Namen, deine E-Mail-Adresse und das Passwort. Zusätzlich werden die
                    Antworten, die du in deinem Archiv ablegst, gesichert, um sie dir
                    jederzeit zugänglich zu machen.</div>
                <div class="divider"></div>

            </div>
            <div class="question">
                <div class="questionContentContainer">
                    <img class="plusIcon" src="{{ asset('asset/images/ic_plus.png') }}"
                        alt="Plus Icon" loading="lazy"> <img class="crossIcon"
                        src="{{ asset('asset/images/ic_cross.png') }}" alt="Kreuz Icon" loading="lazy">
                    Wie sicher sind meine Daten?
                </div>
                <div class="answerContentContainer">Die Sicherheit deiner Daten ist
                    uns sehr wichtig. Wir speichern nur die absolut notwendigen Daten
                    und gewährleisten ihre Sicherheit durch modernste
                    Verschlüsselungstechnologien. So kannst du sicher sein, dass deine
                    Daten bei StudyGenie bestens geschützt sind.</div>
                <div class="divider"></div>

            </div>
            <div class="question">
                <div class="questionContentContainer">
                    <img class="plusIcon" src="{{ asset('asset/images/ic_plus.png') }}"
                        alt="Plus Icon" loading="lazy"> <img class="crossIcon"
                        src="{{ asset('asset/images/ic_cross.png') }}" alt="Kreuz Icon" loading="lazy">
                    Wie kann ich mein Abo bei StudyGenie kündigen oder upgraden?
                </div>
                <div class="answerContentContainer">Um dein Abo bei StudyGenie zu
                    kündigen oder upzugraden, navigiere einfach zu 'Mein Profil'.
                    Unsere Abopläne sind flexibel und monatlich kündbar. In einem
                    übersichtlichen Fenster siehst du zudem immer, wie viele Tage
                    deines aktuellen Abos noch verbleiben.</div>

                <div class="divider"></div>

            </div>
            <div class="question">
                <div class="questionContentContainer">
                    <img class="plusIcon" src="{{ asset('asset/images/ic_plus.png') }}"
                        alt="Plus Icon" loading="lazy"> <img class="crossIcon"
                        src="{{ asset('asset/images/ic_cross.png') }}" alt="Kreuz Icon" loading="lazy">
                    Wie kann ich bezahlen?
                </div>
                <div class="answerContentContainer">Du kannst dein Abo ganz bequem
                    per PayPal oder Kreditkarte bezahlen. Zudem ist es jederzeit
                    kündbar, sodass du vollste Flexibilität genießt.</div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1"
        aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body p-0">
                    <div class="login_sec p-4 position-relative">
                        <img class="login_m1" src="{{ asset('asset/images/m1.svg') }}"
                            alt="" loading="lazy"> <img class="login_m2"
                            src="{{ asset('asset/images/m2.svg') }}" alt="" loading="lazy"> <img
                            class="login_m3" src="{{ asset('asset/images/m3.svg') }}" alt="" loading="lazy">
                        <img class="login_m4" src="{{ asset('asset/images/m4.svg') }}"
                            alt="" loading="lazy"> <img class="close-icon" data-bs-dismiss="modal"
                            aria-label="Close"
                            src="{{ asset('asset/images/ic_close1.png') }}" alt="Close" loading="lazy">
                        <div class="text-center">
                            <img src="{{ asset('asset/images/Logo (2).png') }}" width="133"
                                height="77" alt="Logo" loading="lazy">
                        </div>
                        <br />
                        <div class="main">

                            <div class="text-center">
                                <span id="haveaccountSpan">Kein Account?</span> <a
                                    id="signupAnchor" class="loginAnchor" href="#">Account anlegen</a>
                            </div>

                            <form action="{{ route('login.post') }}" method="POST"
                                id="handleAjax2">
                                @csrf

                                <div id="errors-list2"></div>

                                <div class="emailInput">

                                    <div class="emailField">
                                        <label class="label" for="email">E-Mail:</label> <input
                                            type="email" placeholder="Deine E-Mailadresse" name="email" id="email_login" class="emailLogin" autocomplete="email">

                                    </div>

                                    <label class="label" for="password">Passwort:</label>
                                    <div class="password-field">
                                        <input type="password" placeholder="Dein Passwort"
                                            name="password" id="password_login" class="emailLogin" autocomplete="current-password">
                                    </div>


                                    <input type="submit" value="Login" class="emailLogin">


                                    <div class="or">
                                        <p>oder anmelden über</p>
                                    </div>


                                    <div class="sign-up-facebook">
                                        <img src="{{ asset('asset/images/facebook.svg') }}"
                                            alt="Facebook" loading="lazy"> <input type="button" value="Facebook"
                                            class="email">
                                    </div>
                                    <br />

                                    <div class="sign-up-google">
                                        <img src="{{ asset('asset/images/google.svg') }}" alt="Goolge" loading="lazy">
                                        <input type="button" value="Google" class="email">
                                    </div>


                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="signupModal" tabindex="-1"
        aria-labelledby="signupModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body p-0">
                    <div class="login_sec p-4 position-relative">
                        <img class="login_m1" src="{{ asset('asset/images/m1.svg') }}"
                            alt="" loading="lazy"> <img class="login_m2"
                            src="{{ asset('asset/images/m2.svg') }}" alt="" loading="lazy"> <img
                            class="login_m3" src="{{ asset('asset/images/m3.svg') }}" alt="" loading="lazy">
                        <img class="login_m4" src="{{ asset('asset/images/m4.svg') }}"
                            alt="" loading="lazy"> <img class="close-icon" data-bs-dismiss="modal"
                            aria-label="Close"
                            src="{{ asset('asset/images/ic_close1.png') }}" alt="Close" loading="lazy">
                        <div class="text-center">
                            <img src="{{ asset('asset/images/Logo (2).png') }}" width="133"
                                height="77" alt="Logo" loading="lazy">
                        </div>
                        <div class="main">
                            <form action="{{ route('register.post') }}" method="POST"
                                id="handleAjax">
                                @csrf <br />

                                <div class="text-center">
                                    <span id="haveaccountSpan">Hab nen Account:</span> <a
                                        id="loginAnchor" class="loginAnchor" href="###">Login</a>
                                </div>

                                <div class="emailInput">
                                    <div id="errors-list" class="mx-auto"></div>
                                    <div class="emailField">
                                        <label class="label" for="name"></label> <input type="text"
                                            placeholder="Wie möchtest du genannt werden?" name="name"
                                            id="name_register" class="emailLogin" autocomplete="name">

                                    </div>

                                    <div class="emailField">
                                        <label class="label" for="email">E-Mail:</label> <input
                                            type="email" placeholder="Deine E-Mailadresse" name="email"
                                            id="email_register" class="emailLogin" autocomplete="email">

                                    </div>
                                    <label class="label" for="password">Passwort:</label>
                                    <div class="password-field">
                                        <input type="password" placeholder="Dein Wunschpasswort"
                                            name="password" id="password_register" class="emailLogin" autocomplete="new-password">
                                    </div>
                                    <input type="submit" value="Registrieren" class="emailLogin">
                                    <div class="or">
                                        <p>oder registrieren mit</p>
                                    </div>
                                    <div class="sign-up-facebook">
                                        <img src="{{ asset('asset/images/facebook.svg') }}"
                                            alt="Facebook" loading="lazy"> <input type="button" value="Facebook"
                                            class="email">
                                    </div>
                                    <br />
                                    <div class="sign-up-google">
                                        <img src="{{ asset('asset/images/google.svg') }}" alt="Goolge" loading="lazy">
                                        <input type="button" value="Google" class="email">
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="payment_modal" tabindex="-1"
        aria-labelledby="payment_modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body p-0">
                    <div class="button_payment_box">
                        <a href="#" id="paypal_btn">Bezahlen mit <span>Pay</span><span>pal</span></a>
                        <a href="#" id="stripe_btn">Bezahlen mit Stripe</a>

                    </div>
                </div>

            </div>
        </div>
    </div>


    <!--Forget  Modal -->
    <div class="modal fade" id="forgetModal" tabindex="-1"
        aria-labelledby="forgetModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body p-0">
                    <div class="login_sec p-4 position-relative">
                        <img class="login_m1" src="{{ asset('asset/images/m1.svg') }}"
                            alt="" loading="lazy"> <img class="login_m2"
                            src="{{ asset('asset/images/m2.svg') }}" alt="" loading="lazy"> <img
                            class="login_m3" src="{{ asset('asset/images/m3.svg') }}" alt="" loading="lazy">
                        <img class="login_m4" src="{{ asset('asset/images/m4.svg') }}"
                            alt="" loading="lazy"> <img class="close-icon" data-bs-dismiss="modal"
                            aria-label="Close"
                            src="{{ asset('asset/images/ic_close1.png') }}" alt="Close" loading="lazy">
                        <div class="text-center">
                            <img src="{{ asset('asset/images/Logo (2).png') }}" width="133"
                                height="77" alt="Logo" loading="lazy">
                            <h2 class="primary-heading-forget">Passwort vergessen?</h2>
                        </div>
                        <div class="main">
                            <div class="emailInput">
                                <label for="email">Email:</label> <input type="email"
                                    placeholder="Deine E-Mailadresse" name="email" id="email_reset" class="email" autocomplete="email">
                                <button id="resetButton">Zurücksetzen</button>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <footer class="mainFooterContainer">
        <div class="footerContainer">
            <img id="footerLogo" src="{{ asset('asset/images/Logo (2).png') }}"
                width="133" height="77" alt="Logo " loading="lazy">
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
                    <a href=""><img id="instagram"
                        src="{{ asset('asset/images/instagram.svg') }}" alt="Instagram" loading="lazy"></a>
                    <a href=""><img id="tiktok"
                        src="{{ asset('asset/images/tiktok.svg') }}" alt="TikTok" loading="lazy"></a> <a
                        href=""><img id="linkedin"
                        src="{{ asset('asset/images/linkedin.svg') }}" alt="LinkedIn" loading="lazy"></a>
                </div>
            </div>
        </div>
    </footer>
    
	@guest @else
	@if($showTutorial)
	<script>
	$(document).ready(function() {
	    // Anzeigen des Tutorials
	    var tut = document.querySelectorAll(".tutorial_sec");
	    tut[0].style.display = 'block';
	    document.body.style.overflow = 'hidden';

	    // Funktion zum Schließen des Tutorials und Senden der AJAX-Anfrage
	    window.crosstut = function() {
	        var tut = document.querySelectorAll(".tutorial_sec");
	        tut[0].style.display = 'none';
	        document.body.style.overflow = 'auto';
	        markTutorialAsShown();
	    }
	});

	// AJAX-Anfrage, um den tutorial_shown Status zu aktualisieren
	function markTutorialAsShown() {
	    fetch('/mark-tutorial-as-shown', {
	        method: 'POST',
	        headers: {
	            'Content-Type': 'application/json',
	            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
	        },
	        body: JSON.stringify({ tutorialShown: true })
	    })
	    .then(response => response.json())
	    .then(data => {
	        console.log(data.message);
	    })
	    .catch((error) => {
	        console.error('Error:', error);
	    });
	}
	</script>
	@endif
	@endguest

	<script
		src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

	<script src="{{ asset('asset/js/index.js') }}"></script>
	<script
		src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

	<script>

$(function() {

$(document).on("submit", "#handleAjax", function() {
    var e = this;

    $(this).find("[type='submit']").html("Register...");

    $.ajax({
        url: $(this).attr('action'),
        data: $(this).serialize(),
        type: "POST",
        dataType: 'json',
        success: function (data) {

          $(e).find("[type='submit']").html("Register");

          if (data.status) {
              window.location = data.redirect;
          }else{

              $(".alert").remove();
              $.each(data.errors, function (key, val) {
                  $("#errors-list").append("<div class='alert alert-danger py-0'>" + val + "</div>");
              });
          }

        }
    });

    return false;
});

$(document).on("submit", "#handleAjax2", function() {
          var e = this;

          $(this).find("[type='submit']").html("Login...");

          $.ajax({
              url: $(this).attr('action'),
              data: $(this).serialize(),
              type: "POST",
              dataType: 'json',
              success: function (data) {

                $(e).find("[type='submit']").html("Login");

                if (data.status) {
                    window.location = data.redirect;
                }else{
                    $(".alert").remove();
                    $.each(data.errors, function (key, val) {
                        $("#errors-list2").append("<div class='alert alert-danger py-0'>" + val + "</div>");
                    });
                }
              }
          });
          return false;
      });
});
        $("#signupAnchor").click(function(e){
            e.preventDefault();
            $("#loginModal").modal('hide');
            $("#signupModal").modal('show');

        });
        new WOW().init();
        $("#loginAnchor").click(function(e){
            e.preventDefault();
            $("#signupModal").modal('hide');

            $("#loginModal").modal('show');

        });
            function setModel(paypal,stripe){
                document.getElementById('paypal_btn').href = paypal;
                document.getElementById('stripe_btn').href = stripe;
                $("#payment_modal").modal('show');
            }
    </script>
	@guest @else
	<script>
 var element = document.getElementById("loginButton");
            var imageBox = document.getElementById("login_image_box");
            var check = true;
        var getCoookie=getCookie("user_email");
        if(!getCoookie){

            setTimeout(function(){
               var tut =  document.querySelectorAll(".tutorial_sec");
               tut[0].style.display = 'block';
               document.body.style.overflow = 'hidden';
            }, 2000);

            function crosstut(){
               var tut =  document.querySelectorAll(".tutorial_sec");
               tut[0].style.display = 'none';
               document.body.style.overflow = 'auto';
               setCookie("user_email","modal_not_show",30);
            }
        }


            function setCookie(name,value,days) {
                var expires = "";
                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days*24*60*60*1000));
                    expires = "; expires=" + date.toUTCString();
                }
                document.cookie = name + "=" + (value || "")  + expires + "; path=/";
            }
            function getCookie(name) {
                var nameEQ = name + "=";
                var ca = document.cookie.split(';');
                for(var i=0;i < ca.length;i++) {
                    var c = ca[i];
                    while (c.charAt(0)==' ') c = c.substring(1,c.length);
                    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
                }
                return null;
            }

            var homeVideo = document.getElementById('home_video');
            homeVideo.muted = false;

    </script>
	<script>
document.addEventListener('DOMContentLoaded', function() {
    // Beispiel für eine asynchrone Funktion, die eine AJAX-Anfrage sendet
    function fetchData() {
        return fetch('/api/data') // Pfad zu Ihrem Laravel-Route, die Daten zurückgibt
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
                // Verarbeiten Sie hier die empfangenen Daten
            })
            .catch(error => console.error('Fehler beim Abrufen der Daten', error));
    }

    // Rufen Sie die fetchData-Funktion irgendwo in Ihrem Code auf
    fetchData();
});
</script>
	@endguest
    <div id="cookieConsentContainer" class="cookie-consent-container" style="display: none; position: fixed; bottom: 0; width: 100%; background-color: black; opacity: 0.8; color: white; text-align: center; padding: 10px; z-index: 1000;">
        <p>Wir verwenden Cookies, um Deine Erfahrung zu verbessern. Mit der weiteren Nutzung unserer Website stimmst Du der Verwendung von Cookies zu. <a href="/datenschutz" style="color: #ccc;">Mehr erfahren</a>.</p>
        <button id="acceptCookies" style="background-color: green; border: none; border-radius: 18px; padding: 5px 10px; font-weight: bold; margin: 5px;">Akzeptieren</button>
        <button id="declineCookies" style="background-color: grey; border: none; border-radius: 18px; padding: 5px 10px; font-weight: bold; margin: 5px;">Ablehnen</button>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var consent = getCookie('userConsent');
        if (!consent) {
            document.getElementById('cookieConsentContainer').style.display = 'block';
        }

        document.getElementById('acceptCookies').onclick = function() {
            setCookie('userConsent', 'true', 365);
            document.getElementById('cookieConsentContainer').style.display = 'none';
        };

        document.getElementById('declineCookies').onclick = function() {
            // Setzen Sie hier die Logik, um zu verhindern, dass nicht wesentliche Cookies verwendet werden
            setCookie('userConsent', 'false', 365);
            document.getElementById('cookieConsentContainer').style.display = 'none';
        };

        function setCookie(name, value, days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days*24*60*60*1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "")  + expires + "; path=/";
        }

        function getCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for(var i=0;i < ca.length;i++) {
                var c = ca[i];
                while (c.charAt(0)==' ') c = c.substring(1,c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
            }
            return null;
        }
    });
    </script>
</body>
</html>