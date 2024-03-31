<!DOCTYPE html>
<html lang="en">

<head>
@include('includes.head')
@section('title', 'Impressum')
<link rel="stylesheet" href="{{ asset('asset/css/homepage.css') }}">
</head>

<body class="MainContainer">
	@include('includes.header')

	<section class="blog_sec">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-8">
					<h1>Impressum</h1>

					<h2>Impressum & Kontakt</h2>
					<p class="mb-2">Angaben gemäß § 5 TMG:</p>
					<p>Abeln & Goltz GbR</p>
					<p>Adalbert-Stifter-Straße 14</p>
					<p>30655 Hannover</p>
					<p>Deutschland</p>
					<p class="mb-3 mt-3">
						E-Mail: <a href="mailto:info@agis.digital">info@agis.digital</a>
					</p>
					<p class="mb-3">
						Gerichtsstand: Hannover, Amtsgericht Hannover <br>
						Geschäftsführer: Tom Niclas Abeln, Timo Goltz
					</p>
					<p class="gray mb-3">Inhaltlich Verantwortlicher gem. § 55 II RStV:
						Tom Niclas Abeln</p>
					<h2>Haftungsausschluss</h2>
					<h3>Haftungsbeschränkung</h3>
					<p>Die Abeln & Goltz GbR übernimmt keinerlei Gewähr für die
						Aktualität, Korrektheit, Vollständigkeit oder Qualität der
						bereitgestellten Informationen. Haftungsansprüche gegen die Abeln
						& Goltz GbR, welche sich auf Schäden materieller oder ideeller Art
						beziehen, die durch die Nutzung oder Nichtnutzung der dargebotenen
						Informationen bzw. durch die Nutzung fehlerhafter und
						unvollständiger Informationen verursacht wurden, sind
						grundsätzlich ausgeschlossen, sofern seitens der Abeln & Goltz GbR
						kein nachweislich vorsätzliches oder grob fahrlässiges Verschulden
						vorliegt. Alle Angebote sind freibleibend und unverbindlich. Die
						Abeln & Goltz GbR behält es sich ausdrücklich vor, Teile der
						Seiten oder das gesamte Angebot ohne gesonderte Ankündigung zu
						verändern, zu ergänzen, zu löschen oder die Veröffentlichung
						zeitweise oder endgültig einzustellen.</p>

					<h3>Urheberrechte</h3>
					<p>Die Inhalte dieser Webseite, insbesondere die verwendeten Bilder
						und Texte, unterliegen dem Urheberrecht und dürfen nicht ohne
						vorherige schriftliche Zustimmung von der Abeln & Goltz GbR weder
						als Ganzes noch in Teilen verbreitet, verändert oder kopiert
						werden. Auf den Websites enthaltene Bilder unterliegen teilweise
						dem Urheberrecht Dritter. ® StudyGenie. Alle Rechte vorbehalten.
						Impressum</p>
					<h3>Verweise und Links</h3>
					<p>Trotz sorgfältiger inhaltlicher Kontrolle übernehmen wir keine
						Haftung für die Inhalte externer Links. Für den Inhalt der
						verlinkten Seiten sind ausschließlich deren Betreiber
						verantwortlich. Alle innerhalb des Internetangebotes genannten und
						ggf. durch Dritte geschützten Marken- und Warenzeichen unterliegen
						uneingeschränkt den Bestimmungen des jeweils gültigen
						Kennzeichenrechts und den Besitzrechten der jeweiligen
						eingetragenen Eigentümer. Allein aufgrund der bloßen Nennung ist
						nicht der Schluss zu ziehen, dass Markenzeichen nicht durch Rechte
						Dritter geschützt sind.</p>
					<h4>Informationen zur Online-Streitbeilegung</h4>
					<p>
						Die EU-Kommission stellt eine Plattform für außergerichtliche
						Streitschlichtung bereit. Verbrauchern gibt dies die Möglichkeit,
						Streitigkeiten im Zusammenhang mit ihrer Online-Bestellung
						zunächst außergerichtlich zu klären. Die
						Streitbeilegungs-Plattform finden Sie <br> hier: <a
							href="https://ec.europa.eu/consumers/odr/.">https://ec.europa.eu/consumers/odr/.</a>
						<br> Verbraucherinformation: Nichtteilnahme an einem
						Streitbeilegungsverfahren Wir sind weder bereit noch verpflichtet,
						an einem Streitbeilegungsverfahren vor einer
						Verbraucherschlichtungsstelle teilzunehmen. Unsere E-Mail-Adresse
						finden Sie im Impressum.
					</p>
				</div>
			</div>
		</div>

	</section>

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

	<script
		src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
		crossorigin="anonymous">
	</script>		
</body>
</html>
