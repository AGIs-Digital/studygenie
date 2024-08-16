<!DOCTYPE html>
<html lang="de">

<head>
    @section('title', 'AGBs')
    @include('includes.head')
    <link rel="stylesheet" href="{{ asset('asset/css/homepage.css') }}"> 
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

    <!-- Arrow Up Button -->
    <div class="arrow-up hidden" id="arrowUpContainer">
        <img src="{{ asset('asset/images/arrow-up.svg') }}" id="arrowUp" class="hidden" alt="Nach oben">
    </div>
    <section class="blog_sec">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h1>Allgemeine Geschäftsbedingungen</h1>
                    <p>für die Erbringung von Dienstleistungen von Abeln Goltz GbR, Adalbert-Stifter-Straße 14, 30655
                        Hannover, E-Mail: info@agis.digital (nachfolgend „Auftragnehmer“) gegenüber seinen Kunden
                        (nachfolgend „Auftraggeber“)</p>
                        <br />
                    <h2>1. Allgemeines</h2>
                    <p>1.1 Diese Allgemeinen Geschäftsbedingungen (AGB) für die Erbringung von Dienstleistungen gelten
                        für Verträge, die zwischen dem Auftraggeber und dem Auftragnehmer unter Einbeziehung dieser AGB
                        geschlossen werden.</p>
                    <p>1.2 Der Auftragnehmer ist berechtigt, in eigenem Namen und auf eigene Rechnung die erforderlichen
                        Leistungen an Subunternehmer zu vergeben, die ihrerseits ebenfalls Subunternehmer einsetzen
                        dürfen. Der Auftragnehmer bleibt hierbei alleiniger Vertragspartner des Auftraggebers. Der
                        Einsatz von Subunternehmern erfolgt nicht, wenn für den Auftragnehmer ersichtlich ist, dass
                        deren Einsatz berechtigten Interessen des Auftraggebers zuwiderläuft.</p>
                    <p>1.3 Soweit neben diesen AGB weitere Vertragsdokumente oder andere Geschäftsbedingungen in Text-
                        oder Schriftform Vertragsbestandteil geworden sind, gehen die Regelungen dieser weiteren
                        Vertragsdokumente im Widerspruchsfalle den vorliegenden AGB vor.</p>
                    <p>1.4 Von diesen Geschäftsbedingungen abweichende AGB, die durch den Auftraggeber verwendet werden,
                        erkennt Auftragnehmer – vorbehaltlich einer ausdrücklichen Zustimmung – nicht an.</p>
                        <br />
                        <h2>2. Vertragsgegenstand und Leistungsumfang</h2>
                    <p>2.1 Der Auftragnehmer erbringt als selbständiger Unternehmer folgende Leistungen gegenüber dem
                        Auftraggeber:</p>
                    <p>Innovative und softwarebasierte Lösungen im Bereich der Künstlichen Intelligenz</p>
                    <p>2.2 Der spezifische Leistungsumfang ist Gegenstand von Individualvereinbarungen zwischen
                        Auftragnehmer und dem Auftraggeber.</p>
                    <p>2.3 Der Auftragnehmer erbringt die vertragsgemäßen Leistungen mit größtmöglicher Sorgfalt und
                        Gewissenhaftigkeit nach dem jeweils neuesten Stand, neuesten Regeln und Erkenntnissen.</p>
                    <p>2.4 Der Auftragnehmer ist zur Erbringung der vertragsgemäß geschuldeten Leistungen verpflichtet.
                        Bei der Durchführung seiner Tätigkeit ist er jedoch etwaigen Weisungen im Hinblick auf die Art
                        der Erbringung seiner Leistungen, den Ort der Leistungserbringung ebenso wie die Zeit der
                        Leistungserbringung nicht unterworfen. Er wird jedoch bei der Einteilung der Tätigkeitstage und
                        bei der Zeiteinteilung an diesen Tagen diese selbst in der Weise festlegen, dass eine optimale
                        Effizienz bei seiner Tätigkeit und bei der Realisierung des Vertragsgegenstandes erzielt wird.
                        Die Leistungserbringung durch den Auftragnehmer erfolgt lediglich in Abstimmung und in
                        Koordination mit dem Auftraggeber.</p>
                        <br />
                        <h2>3. Mitwirkungspflichten des Auftraggebers</h2>
                    <p>Es obliegt dem Auftraggeber, die von ihm zum Zwecke der Leistungserfüllung zur Verfügung zu
                        stellenden Informationen, Daten und sonstigen Inhalte vollständig und korrekt mitzuteilen. Für
                        Verzögerungen und Verspätungen bei der Leistungserbringung, die durch eine verspätete und
                        notwendige Mit- bzw. Zuarbeit des Kunden entstehen, ist der Auftragnehmer gegenüber dem Kunden
                        in keinerlei Hinsicht verantwortlich; die Vorschriften unter der Überschrift
                        „Haftung/Freistellung“ bleiben hiervon unberührt.</p>
                        <br />
                        <h2>4. Vergütung</h2>
                    <p>4.1 Die Vergütung wird individualvertraglich vereinbart.</p>
                    <p>4.2 Die Vergütung ist nach der Leistung der Dienste zu entrichten. Ist die Vergütung nach
                        Zeitabschnitten bemessen, so ist sie nach dem Ablauf der einzelnen Zeitabschnitte zu entrichten
                        (§ 614 BGB). Bei aufwandsbezogener Abrechnung ist der Auftragnehmer vorbehaltlich abweichender
                        Vereinbarungen berechtigt, die erbrachte Leistungen monatlich abzurechnen.</p>
                    <p>4.3 Der Auftragnehmer stellt dem Auftraggeber nach Erbringung der Leistungen eine Rechnung per
                        Post oder per E-Mail (z.B. als PDF). Die Vergütung ist innerhalb von 14 Tagen nach Zugang der
                        Rechnung zur Zahlung fällig.</p>
                        <br />
                        <h2>5. Haftung / Freistellung</h2>
                    <p>5.1 Der Auftragnehmer haftet aus jedem Rechtsgrund uneingeschränkt bei Vorsatz oder grober
                        Fahrlässigkeit, bei vorsätzlicher oder fahrlässiger Verletzung des Lebens, des Körpers oder der
                        Gesundheit, aufgrund eines Garantieversprechens, soweit diesbezüglich nichts anderes geregelt
                        ist oder aufgrund zwingender Haftung. Verletzt der Auftragnehmer fahrlässig eine wesentliche
                        Vertragspflicht, ist die Haftung auf den vertragstypischen, vorhersehbaren Schaden begrenzt,
                        sofern nicht gemäß vorstehendem Satz unbeschränkt gehaftet wird. Wesentliche Vertragspflichten
                        sind Pflichten, die der Vertrag dem Auftragnehmer nach seinem Inhalt zur Erreichung des
                        Vertragszwecks auferlegt, deren Erfüllung die ordnungsgemäße Durchführung des Vertrags überhaupt
                        erst ermöglicht und auf deren Einhaltung der Kunde regelmäßig vertrauen darf. Im Übrigen ist
                        eine Haftung des Auftragnehmers ausgeschlossen. Vorstehende Haftungsregelungen gelten auch im
                        Hinblick auf die Haftung des Auftragnehmers für seine Erfüllungsgehilfen und gesetzlichen
                        Vertreter.</p>
                    <p>5.2 Der Auftraggeber stellt den Auftragnehmer von jeglichen Ansprüchen Dritter frei, die gegen
                        den Auftragnehmer aufgrund von Verstößen des Kunden gegen diese Vertragsbedingungen oder gegen
                        geltendes Recht geltend gemacht werden.</p>
                        <br />
                        <h2>6. Vertragsdauer und Kündigung</h2>
                    <p>6.1 Die Vertragsdauer und die Fristen zur ordentlichen Kündigung vereinbaren die Parteien
                        individuell.</p>
                    <p>6.2 Das Recht beider Parteien zur fristlosen Kündigung aus wichtigem Grund bleibt unberührt.</p>
                    <p>6.3 Der Auftragnehmer hat alle ihm überlassenen Unterlagen und sonstigen Inhalte nach
                        Vertragsbeendigung unverzüglich nach Wahl des Kunden zurückzugeben oder zu vernichten. Die
                        Geltendmachung eines Zurückbehaltungsrechts daran ist ausgeschlossen. Elektronische Daten sind
                        vollständig zu löschen. Ausgenommen davon sind Unterlagen und Daten, hinsichtlich derer eine
                        längere gesetzliche Aufbewahrungspflicht besteht, jedoch nur bis zum Ende der jeweiligen
                        Aufbewahrungsfrist. Der Auftragnehmer hat dem Unternehmen auf dessen Verlangen die Löschung
                        schriftlich zu bestätigen.</p>
                        <br />
                        <h2>7. Vertraulichkeit und Datenschutz</h2>
                    <p>7.1 Der Auftragnehmer wird alle ihm im Zusammenhang mit dem Auftrag zur Kenntnis gelangenden
                        Vorgänge streng vertraulich behandeln. Der Auftragnehmer verpflichtet sich, die
                        Geheimhaltungspflicht sämtlichen Angestellten und / oder Dritten, die Zugang zu den
                        vertragsgegenständlichen Informationen haben, aufzuerlegen. Die Geheimhaltungspflicht gilt
                        zeitlich unbegrenzt über die Dauer dieses Vertrages hinaus.</p>
                    <p>7.2 Der Auftragnehmer verpflichtet sich, bei der Durchführung des Auftrags sämtliche
                        datenschutzrechtlichen Vorschriften – insbesondere die Vorschriften der
                        Datenschutzgrundverordnung und des Bundesdatenschutzgesetzes – einzuhalten.</p>
                        <br />
                        <h2>8. Schlussbestimmungen</h2>
                    <p>8.1 Es gilt das Recht der Bundesrepublik Deutschland unter Ausschluss des CISG.</p>
                    <p>8.2 Sollte eine Bestimmung dieser AGB unwirksam sein oder werden, so wird die Gültigkeit der AGB
                        im Übrigen hiervon nicht berührt.</p>
                    <p>8.3 Der Auftraggeber wird den Auftragnehmer bei der Erbringung seiner vertragsgemäßen Leistungen
                        durch angemessene Mitwirkungshandlungen, soweit erforderlich, fördern. Der Auftraggeber wird
                        insbesondere dem Auftragnehmer die zur Erfüllung des Auftrags erforderlichen Informationen und
                        Daten zur Verfügung stellen.</p>
                    <p>8.4 Sofern der Auftraggeber Kaufmann, juristische Person des öffentlichen Rechts oder
                        öffentlich-rechtliches Sondervermögen ist oder keinen allgemeinen Gerichtsstand in Deutschland
                        hat, vereinbaren die Parteien den Sitz des Auftragnehmers als Gerichtsstand für sämtliche
                        Streitigkeiten aus diesem Vertragsverhältnis; ausschließliche Gerichtstände bleiben hiervon
                        unberührt.</p>
                    <p>8.5 Der Auftragnehmer ist berechtigt, diese AGB aus sachlich gerechtfertigten Gründen (z. B.
                        Änderungen in der Rechtsprechung, Gesetzeslage, Marktgegebenheiten oder der Geschäfts- oder
                        Unternehmensstrategie) und unter Einhaltung einer angemessenen Frist zu ändern. Bestandskunden
                        werden hierüber spätestens zwei Wochen vor Inkrafttreten der Änderung per E-Mail benachrichtigt.
                        Sofern der Bestandskunde nicht innerhalb der in der Änderungsmitteilung gesetzten Frist
                        widerspricht, gilt seine Zustimmung zur Änderung als erteilt. Widerspricht er, treten die
                        Änderungen nicht in Kraft; Auftragnehmer ist in diesem Fall berechtigt, den Vertrag zum
                        Zeitpunkt des Inkrafttretens der Änderung außerordentlich zu kündigen. Die Benachrichtigung über
                        die beabsichtigte Änderung dieser AGB wird auf die Frist und die Folgen des Widerspruchs oder
                        seines Ausbleibens hinweisen.</p>
                        <br />
                        <h2>9. Informationen zur Online-Streitbeilegung / Verbraucherschlichtung</h2>
                    <p>Die EU-Kommission stellt im Internet unter folgendem Link eine Plattform zur
                        Online-Streitbeilegung bereit: <a href="https://ec.europa.eu/consumers/odr" target="_blank"
                            rel="noopener noreferrer">https://ec.europa.eu/consumers/odr</a></p>
                    <p>Diese Plattform dient als Anlaufstelle zur außergerichtlichen Beilegung von Streitigkeiten aus
                        Online-Kauf- oder Dienstleistungsverträgen, an denen ein Verbraucher beteiligt ist. Der Anbieter
                        ist weder bereit noch verpflichtet, an einem Verbraucherstreitschlichtungsverfahren nach dem
                        VSBG teilzunehmen.</p>
                        <br />
                    <p>Unsere E-Mail-Adresse entnehmen Sie der Überschrift dieser AGB.</p>
                </div>
            </div>
        </div>
    </section>
    <footer class="mainFooterContainer">
        <div class="footerContainer">
            <img id="footerLogo" src="{{ asset('asset/images/Logo_(2).png') }}" width="133" height="77"
                alt="Logo" loading="lazy">
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
                            loading="lazy"></a>
                    <a href=""><img id="linkedin" src="{{ asset('asset/images/linkedin.svg') }}" alt="LinkedIn"
                            loading="lazy"></a>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"
        type="text/javascript"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
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
    </script>
</body>

</html>
