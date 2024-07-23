<!DOCTYPE html>
<html lang="de">
<head>
@section('title', 'StudyGenie')
@include('includes.head')
<link rel="stylesheet" href="{{ asset('asset/css/HomePage.css') }}">
<link rel="stylesheet" href="{{ asset('asset/css/cookie-consent.css') }}">
<style>
        .hidden {
            display: none;
        }

        .visible {
            display: block;
        }

        .text-success {
            color: green;
        }

        .text-danger {
            color: red;
        }

        .password-field {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 1.5rem;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .toggle-password img {
            width: 23px;
            height: 23px;
        }

        .criteria-container {
            width: 100%; /* Ensure the container takes the full width of the input field */
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .criteria-row {
            justify-content: space-between;
            margin-bottom: 10px; /* Add some space between rows */
        }

        .criteria-row p {
            margin: 0;
            white-space: nowrap;
            width: 100%; /* Ensure each criterion takes the full width of its container */
        }

        .text-success .checkmark {
            color: green;
            animation: highlight 3.5s ease-in-out;
        }

        .text-danger .checkmark {
            color: red;
        }

        @keyframes highlight {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

        .arrow-up {
            position: fixed;
            bottom: 20%;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 50px;
            background-color: #212529;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            opacity: 0.7;
            transition: opacity 0.3s ease;
            z-index: 1000;
        }

        .arrow-up.hidden {
            display: none;
        }

        .arrow-up:hover {
            opacity: 1;
        }

        .arrow-up img {
            width: 30px;
            height: 30px;
        }
    </style>
</head>

<body class="MainContainer">

    <!-- Arrow Up Button -->
    <div class="arrow-up hidden" id="arrowUpContainer">
        <img src="{{ asset('asset/images/arrow-up.svg') }}" id="arrowUp" class="hidden" alt="Nach oben">
    </div>

<!-- Cookie Consent Modal -->
<div id="cookieConsentModal" class="modal fade" tabindex="-1" aria-labelledby="cookieConsentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cookieConsentModalLabel">Cookie-Einstellungen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Wir verwenden Cookies, um Ihre Erfahrung zu verbessern. Sie können wählen, welche Cookies Sie akzeptieren möchten.</p>
                <form id="cookieConsentForm">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="necessary" id="necessaryCookies" checked disabled>
                        <label class="form-check-label" for="necessaryCookies">
                            Notwendige Cookies
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="analytics" id="analyticsCookies">
                        <label class="form-check-label" for="analyticsCookies">
                            Analytische Cookies
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="marketing" id="marketingCookies">
                        <label class="form-check-label" for="marketingCookies">
                            Marketing Cookies
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="declineCookies" data-bs-dismiss="modal">Ablehnen</button>
                <button type="button" class="btn btn-primary" id="acceptCookies">Akzeptieren</button>
            </div>
        </div>
    </div>
</div>



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

                            <!-- <li class="nav-item"><a class="nav-link blog primary-button"
                                href="#">{{ __('Blog') }}</a></li> -->



                            <li class="nav-item">
                                <button class="primary-button" data-bs-toggle="modal"
                                    data-bs-target="#loginModal" id="loginButton">Log In</button>

                            </li> @else
                            <!-- <li class="nav-item"><a class="nav-link blog primary-button"
                                href="#">{{ __('Blog') }}</a></li> -->
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
            <video controls id="home_video" loading="lazy" preload="metadata">
                <source src="{{ asset('asset/Videos/video_klein.mp4') }}" type="video/mp4">
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
                    src="{{ asset('asset/images/illustrations/Deine_professionelle_Bewerbung.png') }}"
                    alt="Testimonial Card" loading="lazy"> <span class="CardThumbnailSpan">Karrierecoaching und Bewerbung</span>
            </div>
            <div class="testimonialCard">
                <img
                    src="{{ asset('asset/images/illustrations/Der_perfekte_Lernplan_fur_dich.png') }}"
                    alt="Testimonial Card" loading="lazy"> <span class="CardThumbnailSpan">Individuelle Lernhilfe</span>
            </div>
            <div class="testimonialCard">
                <img
                    src="{{ asset('asset/images/illustrations/Alles_wichtige_uber_deine_Traumberufe.png') }}"
                    alt="Testimonial Card" loading="lazy"> <span class="CardThumbnailSpan">Deinen Traumberuf finden</span>
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
                            src="{{ asset('asset/images/illustrations/Berufsinformationen.png') }}"
                            width="90" height="90" alt="Berufsinformationen " loading="lazy">
                        <p class="cardPara">Berufsinformationen</p>
                    </div>
                </div>
                <div class="parent-card">
                    <div class="cards">
                        <img
                            src="{{ asset('asset/images/illustrations/Bewerbungscoach.png') }}"
                            width="90" height="90" alt="Bewerbungscoach " loading="lazy">
                        <p class="cardPara">Bewerbungscoach</p>
                    </div>
                </div>
                <div class="parent-card">
                    <div class="cards">
                        <img
                            src="{{ asset('asset/images/illustrations/Lebenslauf.png') }}"
                            width="90" height="90" alt="Lebenslauf" loading="lazy">
                        <p class="cardPara">Lebenslauf</p>
                    </div>
                </div>
                <div class="parent-card">
                    <div class="cards">
                        <img src="{{ asset('asset/images/illustrations/Lernplan.png') }}"
                            width="90" height="90" alt="Lernplan" loading="lazy">
                        <p class="cardPara">Persönlicher Tutor</p>
                    </div>
                </div>
                <div class="parent-card">
                    <div class="cards">
                        <img
                            src="{{ asset('asset/images/illustrations/Motivationsschreiben.png') }}"
                            width="90" height="90" alt="Motivationsschreiben " loading="lazy">
                        <p class="cardPara">Motivationsschreiben</p>
                    </div>
                </div>

                <div class="parent-card">
                    <div class="cards">
                        <img
                            src="{{ asset('asset/images/illustrations/Textinspiration.png') }}"
                            width="90" height="90" alt="Textinspiration" loading="lazy">
                        <p class="cardPara">Textinspiration</p>
                    </div>
                </div>

                <div class="parent-card">
                    <div class="cards">
                        <img
                            src="{{ asset('asset/images/illustrations/Textkorrekturen.png') }}"
                            width="90" height="90" alt="Textkorrekturen" loading="lazy">
                        <p class="cardPara">Textkorrekturen</p>
                    </div>
                </div>

                <div class="parent-card">
                    <div class="cards">
                        <img
                            src="{{ asset('asset/images/illustrations/Übungsklausur.png') }}"
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
                        ✓ Intelligente Soforthilfe<br /> ✓ Traumberuf finden<br />✓ Berufsinformationen<br /> ✘ Textinspirationen<br /> ✘ Textanalyse<br />
                        ✘ Bewerbungsunterlagen<br /> ✘ Lerncoach<br /> ✘ Bewerbungstrainer
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
                        ✓ Intelligente Soforthilfe<br />✓ Traumberuf finden<br /> ✓ Berufsinformationen<br /> ✓ Textinspirationen<br /> ✓ Textanalyse<br />
                        ✓ Bewerbungsunterlagen<br /> ✘ Lerncoach<br /> ✘ Bewerbungstrainer
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
                        onclick="setModel('{{ route('paypal.payment','gold') }}'/* ,'{{ route('stripe.payment','gold') }}' */)"
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
                        ✓ Intelligente Soforthilfe<br />✓ Traumberuf finden<br /> ✓ Berufsinformationen<br /> ✓ Textinspirationen<br /> ✓ Textanalyse<br />
                        ✓ Bewerbungsunterlagen<br /> ✓ Lerncoach<br /> ✓ Bewerbungstrainer
                    </p>
                    @guest
                    <button data-bs-toggle="modal" data-bs-target="#signupModal"
                        class="plancardButton">Hol dir Diamant</button>
                    @else @if(auth()->user()->subscription_name == 'diamant' && $check)

                    <button class="plancardButton" disabled>Hol dir Diamant</button>

                    @else
                    <button
                        onclick="setModel('{{ route('paypal.payment','diamant') }}'/* ,'{{ route('stripe.payment','diamant') }}' */)"
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
                                    id="signupAnchor" class="loginAnchor" data-bs-toggle="modal" data-bs-target="#signupModal">Account anlegen</a>
                            </div>

                            <form method="POST" id="loginForm">
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
                                            oder anmelden über
                                            <a href="{{ url('login/google') }}" id="google-login">
                                                <img src="{{ asset('asset/images/google.svg') }}" alt="Google" loading="lazy">
                                            </a>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
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
                            <form method="POST" id="registerForm">
                                @csrf <br />

                                <div class="emailInput">
                                    <div id="errors-list" class="mx-auto"></div>
                                    <div class="emailField">
                                        <label class="label" for="name">Name:</label> <input type="text"
                                            placeholder="Wie heißt du?" name="name"
                                            id="name_register" class="emailLogin" autocomplete="name">
                                    </div>

                                    <div class="emailField">
                                        <label class="label" for="email">E-Mail:</label> <input
                                            type="email" placeholder="Deine E-Mailadresse" name="email"
                                            id="email_register" class="emailLogin" autocomplete="email">

                                    </div>
                                    <label class="label" for="password">Passwort:</label>
                                    <div class="password-field">
                                        <input type="password" id="password_register" name="password" placeholder="Dein Wunschpasswort"  class="emailLogin">
                                        <span class="toggle-password" onclick="togglePasswordVisibility()">
                                            <img src="{{ asset('asset/images/eye.svg') }}" alt="Toggle Password Visibility" width="25" height="25">
                                        </span>
                                    </div>
                                    <div id="passwordCriteria" class="criteria-container mt-2">
                                        <div class="criteria-row">
                                            <p id="lengthCriteria" class="text-danger"><span class="checkmark">✔</span> 8 Zeichen</p>
                                            <p id="uppercaseCriteria" class="text-danger"><span class="checkmark">✔</span> 1 Großbuchstabe</p>
                                        </div>
                                        <div class="criteria-row">
                                            <p id="numberCriteria" class="text-danger"><span class="checkmark">✔</span> 1 Zahl</p>
                                            <p id="specialCharCriteria" class="text-danger"><span class="checkmark">✔</span> 1 Sonderzeichen</p>
                                        </div>
                                    </div>

                                    <input type="submit" value="Registrieren" class="emailLogin">
                                        <div class="or">
                                            oder registrieren mit
                                            <a href="{{ url('login/google') }}">
                                                <img src="{{ asset('asset/images/google.svg') }}" alt="Google" loading="lazy">
                                            </a>
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
                        <!-- <a href="#" id="stripe_btn">Bezahlen mit Stripe</a> -->

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

    <footer class="mainFooterContainer"> <!-- Klasse nicht definiert-->
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

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
	<script src="{{ asset('asset/js/index.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Login Form Submission
        document.getElementById("loginForm").addEventListener("submit", function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content')); // Fügt das CSRF-Token zum FormData hinzu
            fetch("/postLogin", {
                method: "POST",
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest', // Wichtig für Laravel, um AJAX-Anfragen zu erkennen
                },
            })
            .then(response => response.json())
            .then(data => {
                if(data.status === true) {
                    window.location.href = data.redirect;
                } else {
                    alert("Fehler beim Login.");
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

        // Register Form Submission
        document.getElementById("registerForm").addEventListener("submit", function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            fetch("/postRegistration", {
                method: "POST",
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest', // Wichtig für Laravel, um AJAX-Anfragen zu erkennen
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF-Token
                },
            })
            .then(response => response.json())
            .then(data => {
                if(data.status === true) {
                    if (data.subscription_updated) {
                        localStorage.setItem('subscription_updated', 'true');
                    }
                    window.location.href = data.redirect;
                } else {
                    alert("Fehler beim Login.");
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

        // Google Login
        document.getElementById('google-login').addEventListener('click', function() {
            window.location.href = "{{ url('login/google') }}";
        });

        // Cookie Consent Modal
        if (!localStorage.getItem('cookieConsent')) {
            var cookieModal = new bootstrap.Modal(document.getElementById('cookieConsentModal'));
            cookieModal.show();
        }

        // Show Toast Message
        function showToast(message) {
            var toast = document.createElement('div');
            toast.className = 'toast align-items-center text-white bg-primary border-0';
            toast.role = 'alert';
            toast.ariaLive = 'assertive';
            toast.ariaAtomic = 'true';
            toast.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body">${message}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            `;
            document.body.appendChild(toast);
            var bsToast = new bootstrap.Toast(toast, { delay: 3000 });
            bsToast.show();
            toast.addEventListener('hidden.bs.toast', function () {
                toast.remove();
            });
        }

        // Accept Cookies
        document.getElementById('acceptCookies').addEventListener('click', function() {
            var consent = {
                necessary: true,
                analytics: document.getElementById('analyticsCookies').checked,
                marketing: document.getElementById('marketingCookies').checked
            };
            localStorage.setItem('cookieConsent', JSON.stringify(consent));
            showToast('Ihre Cookie-Einstellungen wurden gespeichert.');
            var cookieModal = bootstrap.Modal.getInstance(document.getElementById('cookieConsentModal'));
            cookieModal.hide();
        });

        // Decline Cookies
        document.getElementById('declineCookies').addEventListener('click', function() {
            var consent = {
                necessary: true,
                analytics: false,
                marketing: false
            };
            localStorage.setItem('cookieConsent', JSON.stringify(consent));
            showToast('Ihre Cookie-Einstellungen wurden gespeichert.');
            var cookieModal = bootstrap.Modal.getInstance(document.getElementById('cookieConsentModal'));
            cookieModal.hide();
        });

        // Arrow Up Button
        var arrowUp = document.getElementById('arrowUp');
        var arrowUpContainer = document.getElementById('arrowUpContainer');

        window.addEventListener('scroll', function() {
            if (window.scrollY > window.innerHeight) {
                arrowUp.classList.add('visible');
                arrowUp.classList.remove('hidden');
                arrowUpContainer.classList.add('visible');
                arrowUpContainer.classList.remove('hidden');
            } else {
                arrowUp.classList.add('hidden');
                arrowUp.classList.remove('visible');
                arrowUpContainer.classList.add('hidden');
                arrowUpContainer.classList.remove('visible');
            }
        });

        arrowUp.addEventListener('click', function() {
            smoothScrollToTop();
        });

        // Hide Arrow Up Button after scrolling to top
        window.addEventListener('scroll', function() {
            if (window.scrollY === 0) {
                arrowUp.classList.add('hidden');
                arrowUp.classList.remove('visible');
                arrowUpContainer.classList.add('hidden');
                arrowUpContainer.classList.remove('visible');
            }
        });

        // Check for subscription update
        if (localStorage.getItem('subscription_updated') === 'true') {
            showConfetti();
            showSuccessMessage();
            localStorage.removeItem('subscription_updated');
        }
    });

    // Smooth scroll to top function
    function smoothScrollToTop() {
        const scrollDuration = 300; // Duration in ms
        const scrollStep = -window.scrollY / (scrollDuration / 15);
        const scrollInterval = setInterval(function() {
            if (window.scrollY !== 0) {
                window.scrollBy(0, scrollStep);
            } else {
                clearInterval(scrollInterval);
            }
        }, 15);
    }

    // Toggle Password Visibility
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password_register');
        const toggleIcon = document.querySelector('.toggle-password img');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        toggleIcon.src = type === 'password' ? "{{ asset('asset/images/eye.svg') }}" : "{{ asset('asset/images/eye-off.svg') }}";
    }
</script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const passwordInput = document.getElementById('password_register');
        if (passwordInput) {
            const passwordCriteria = document.getElementById('passwordCriteria');
            const criteria = {
                length: document.getElementById('lengthCriteria'),
                uppercase: document.getElementById('uppercaseCriteria'),
                number: document.getElementById('numberCriteria'),
                specialChar: document.getElementById('specialCharCriteria')
            };

            passwordInput.addEventListener('focus', () => passwordCriteria.classList.remove('hidden'));
            passwordInput.addEventListener('blur', () => { if (passwordInput.value === '') passwordCriteria.classList.add('hidden'); });
            passwordInput.addEventListener('input', function () {
                const password = passwordInput.value;
                criteria.length.classList.toggle('text-success', password.length >= 8);
                criteria.length.classList.toggle('text-danger', password.length < 8);
                criteria.uppercase.classList.toggle('text-success', /[A-Z]/.test(password));
                criteria.uppercase.classList.toggle('text-danger', !/[A-Z]/.test(password));
                criteria.number.classList.toggle('text-success', /\d/.test(password));
                criteria.number.classList.toggle('text-danger', !/\d/.test(password));
                criteria.specialChar.classList.toggle('text-success', /[!@#$%^&*(),.?":{}|<>]/.test(password));
                criteria.specialChar.classList.toggle('text-danger', !/[!@#$%^&*(),.?":{}|<>]/.test(password));
            });
        }
    });
</script>
</body>
</html>
