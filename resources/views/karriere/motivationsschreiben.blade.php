<!DOCTYPE html>
<html lang="de">

<head>
    @section('title', 'Motivationsschreiben')
    @include('components.head')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="MainContainer backimage">
    <div class="headerSpacer"></div>
        @include('components.navbar')
    @include('components.feedback')
    @include('components.mobile_warning')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <div class="leftCon" style="cursor: pointer">
                    <img id="closeIcon" onclick="window.location.href='{{ route('karriere.bewerbung') }}'" src="{{ asset('asset/images/ic_close.png') }}" alt="closeIcon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="134" height="113" viewBox="0 0 245 167" fill="none">
                        <image href="{{ asset('asset/images/cloud-background.svg') }}" width="245" height="167"/>
                        <x-cloud-content 
                            tool-name="Motivation" 
                            bg-color="#2D3E4E"
                            text-color="#FFFFFF"
                        />
                    </svg>
                </div>
            </div>

            <div class="col-md-3">
                <form id="motivation-form">
                    @csrf
                    <h2 style="color: #2D3E4E; font-family: Milonga; font-size: 24px; font-style: normal; font-weight: 500; line-height: 38px; position: relative; margin-top: 3rem;">
                        Motivationsschreiben
                        <strong type="button" class="" data-bs-toggle="tooltip" data-bs-placement="top" title="Je mehr Informationen du uns gibst, desto persönlicher wird das Ergebnis. Trage hier nur Infos ein, die für die Bewerbung auf diese Stelle relevant sind.">
                            <img src="{{ asset('asset/images/info-tools.svg') }}" width="20" alt="" loading="lazy">
                        </strong>
                    </h2>
                    <p style="font-size: 12px; color: gray; text-align: center; margin: 0;">Mehrere Versuche können das Ergebnis verbessern.</p>
                    <div class="accordion accordion-flush" id="accordionFlushExample" style="border: 1px solid #2D3E4E; border-radius: 12px;">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    Persönliche Daten
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <div class="entry">
                                        <p>Name: <input type="text" name="name" autocomplete="name"></p>
                                        <p>Straße Nr.: <input type="text" name="street" autocomplete="street-address"></p>
                                        <p>PLZ: <input type="text" name="postal_city" autocomplete="postal-code"></p>
                                        <p>Ort: <input type="text" name="city" autocomplete="address-level2"></p>
                                        <p>Telefon: <input type="text" name="phone" autocomplete="tel"></p>
                                        <p>E-Mail: <input type="email" name="email" autocomplete="email"></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                    Adressat
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <div class="section" id="adressat">
                                        <div class="entry">
                                            <p>Unternehmen/Universität: <input type="text" name="adressat_company"></p>
                                            <p>Ansprechperson: <input type="text" name="adressat_person"></p>
                                            <p>Straße Nr.: <input type="text" name="adressat_street"></p>
                                            <p>PLZ: <input type="text" name="adressat_postal_city"></p>
                                            <p>Ort: <input type="text" name="adressat_city"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                                    Stellenbezeichnung
                                </button>
                            </h2>
                            <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <div class="section" id="stellenbezeichnung">
                                        <div class="entry">
                                            <p>Job/Studiengang:
                                                <strong type="button" class="" data-bs-toggle="tooltip" data-bs-placement="top" title="Trage hier ein wofür du dich bewirbst.">
                                                    <img src="{{ asset('asset/images/info-tools.svg') }}" width="16" alt="" loading="lazy">
                                                </strong>
                                                <input type="text" name="stellenbezeichnung_job" placeholder="Webentwicklerin, etc.">
                                            </p>
                                            <p>Stellenbeschreibung:
                                                <strong type="button" class="" data-bs-toggle="tooltip" data-bs-placement="top" title="Trage hier die relevanten Abschnitte wir 'was du mitbringst' 'was wir suchen' etc. ein.">
                                                    <img src="{{ asset('asset/images/info-tools.svg') }}" width="16" alt="" loading="lazy">
                                                </strong>
                                                <textarea name="stellenbezeichnung_stellenbeschreibung" rows="10" placeholder="Das zeichnet Sie aus: Sie haben Ihre Allgemeine Hochschulreife (Abitur) erworben oder sind kurz vor Ihrem Abschluss. Sie können sich sicher in Englisch und Deutsch verständigen"></textarea>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                    Qualifikationen
                                </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <div class="section" id="qualification">
                                        <div class="entry">
                                            <span class="small_text_font">Relevante Abschlüsse:
                                                <strong type="button" class="" data-bs-toggle="tooltip" data-bs-placement="top" title=" Trage hier deine relevantesten Abschlüsse chronologisch ein.">
                                                    <img src="{{ asset('asset/images/info-tools.svg') }}" width="16" alt="" loading="lazy">
                                                </strong>
                                                <input type="text" name="qualification_grade" placeholder="Architektin B.Sc., Ausbildung Maurer, etc.">
                                            </span>
                                            <p>Beruflicher Werdegang:
                                                <strong type="button" class="" data-bs-toggle="tooltip" data-bs-placement="top" title="Falls du bereits in Unternehmen gearbeitet hast, gebe hier, beginnend mit dem letzten, das Unternehmen und deine Position ein.">
                                                    <img src="{{ asset('asset/images/info-tools.svg') }}" width="16" alt="" loading="lazy">
                                                </strong>
                                                <input type="text" name="qualification_jobs" placeholder="Projektleitung bei Google, etc.">
                                            </p>
                                            <p>Aktuelle Aufgaben:
                                                <strong type="button" class="" data-bs-toggle="tooltip" data-bs-placement="top" title="Trage hier die Aufgaben ein, die du derzeit ausführst.">
                                                    <img src="{{ asset('asset/images/info-tools.svg') }}" width="16" alt="" loading="lazy">
                                                </strong>
                                                <input type="text" name="qualification_tasks_now" placeholder="PHP programmieren, Kundenservice, etc.">
                                            </p>
                                            <p>Frühere Aufgaben:
                                                <strong type="button" class="" data-bs-toggle="tooltip" data-bs-placement="top" title="Tätigkeiten die du in anderen Jobs ausgeübt hast und die für die jetzige Bewerbung von Wert sind.">
                                                    <img src="{{ asset('asset/images/info-tools.svg') }}" width="16" alt="" loading="lazy">
                                                </strong>
                                                <input type="text" name="qualification_tasks_earlier" placeholder="Präsentationen, Meetings organisieren, etc.">
                                            </p>
                                            <p>Persönliche Stärken:
                                                <strong type="button" class="" data-bs-toggle="tooltip" data-bs-placement="top" title="Was macht dich zur idealen Stellenbesetzung?">
                                                    <img src="{{ asset('asset/images/info-tools.svg') }}" width="16" alt="" loading="lazy">
                                                </strong>
                                                <input type="text" name="qualification_skills" placeholder="Strukturiertes Arbeiten, Empathie, etc.">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                    Motivationen
                                </button>
                            </h2>
                            <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <div class="section" id="motivationen">
                                        <div class="entry">
                                            <p>Karriereziele:
                                                <strong type="button" class="" data-bs-toggle="tooltip" data-bs-placement="top" title="Was möchtest du persönlich in diesem Job lernen oder erreichen?">
                                                    <img src="{{ asset('asset/images/info-tools.svg') }}" width="16" alt="" loading="lazy">
                                                </strong>
                                                <input type="text" name="motivationen_type" placeholder="Teamleitung, Aufstiegschancen etc.">
                                            </p>
                                            <p>Persönliche Interessen:
                                                <strong type="button" class="" data-bs-toggle="tooltip" data-bs-placement="top" title="Hobbies oder Leidenschaften von dir.">
                                                    <img src="{{ asset('asset/images/info-tools.svg') }}" width="16" alt="" loading="lazy">
                                                </strong>
                                                <input type="text" name="motivationen_level" placeholder="Mannschaftssport, Schülersprecher*in, etc.">
                                            </p>
                                            <p>Stil:
                                                <strong type="button" class="" data-bs-toggle="tooltip" data-bs-placement="top" title="Welchen Eindruck möchtest du mit deiner Bewerbung von dir vermitteln?">
                                                    <img src="{{ asset('asset/images/info-tools.svg') }}" width="16" alt="" loading="lazy">
                                                </strong>
                                                <input type="text" name="motivationen_style" placeholder=" Professionell, kreativ, sebstbewusst, etc.">
                                            </p>
                                            <p>Freitextfeld:
                                                <strong type="button" class="" data-bs-toggle="tooltip" data-bs-placement="top" title="Alles, woran wir nicht gedacht haben, dir aber wichtig ist :-)">
                                                    <img src="{{ asset('asset/images/info-tools.svg') }}" width="16" alt="" loading="lazy">
                                                </strong>
                                                <input type="text" name="motivationen_freitext" placeholder="Lust auf neue Aufgaben, etc.">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="button-container">
                        <button type="button" class="send-button" id="preview-button">Vorschau</button>
                        <button type="submit" class="archive-button">Download</button>
                    </div>
                    <input type="hidden" id="openai_response" name="openai_response">
                </form>
            </div>

            <div class="col-md-7">
                <div class="motivation_box_sec preview-container" id="motivation_appnd">
                    <!-- Vorschau des Motivationsschreibens wird hier angezeigt -->
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            function checkFields() {
                const accordionItems = document.querySelectorAll('.accordion-item');
                accordionItems.forEach(item => {
                    const Fields = item.querySelectorAll('input, textarea');
                    let hasEmptyField = false;
                    Fields.forEach(field => {
                        if (!field.value.trim()) {
                            hasEmptyField = true;
                        }
                    });
                    const header = item.querySelector('.accordion-header');
                    if (hasEmptyField) {
                        header.classList.add('-warning');
                    } else {
                        header.classList.remove('-warning');
                    }
                });
            }

            $(document).ready(function() {
                $("#preview-button").click(function() {
                    var form = document.getElementById("motivation-form");
                    var formData = new FormData(form);
                    // Ladezeichen anzeigen
                    $("#preview-button").addClass('loading-button').text("Zaubert...").prop('disabled', true);
                    $.ajax({
                        url: route('karriere.motivation.generate'),
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            // Ladezeichen entfernen
                            $("#preview-button").removeClass('loading-button').text("Vorschau").prop('disabled', false);

                            if (data.status) {
                                // Füge die OpenAI-Antwort zu den Formulardaten hinzu
                                formData.append('openai_response', data.data);
                                document.getElementById('openai_response').value = data.data;

                                // Leere den Vorschau-Container
                                const previewContainer = document.getElementById('motivation_appnd');
                                previewContainer.innerHTML = '';

                                // Sende die Formulardaten an die Vorschau-Route
                                fetch(route('karriere.motivation.preview'), {
                                    method: 'POST',
                                    body: formData,
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.error) {
                                        console.error('Server Error:', data.error);
                                        return;
                                    }
                                    console.log('Server Response:', data); // Debugging-Ausgabe

                                    // Erstelle ein eingebettetes PDF-Element
                                    const pdfEmbed = document.createElement('iframe');
                                    pdfEmbed.src = `data:application/pdf;base64,${data.pdf}`;
                                    pdfEmbed.type = 'application/pdf';
                                    pdfEmbed.width = '100%';
                                    pdfEmbed.height = '100%';
                                    pdfEmbed.style.border = 'none';

                                    // Füge das eingebettete PDF-Element in den Vorschau-Container ein
                                    previewContainer.appendChild(pdfEmbed);
                                })
                                .catch(error => console.error('Error:', error));
                            } else {
                                console.error('Error:', data.error);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Ein Fehler ist aufgetreten: " + error);
                            // Ladezeichen entfernen
                            $("#preview-button").removeClass('loading-button').text("Vorschau");
                        }
                    });
                });
            });

            // Download-Funktionalität
            document.getElementById('motivation-form').addEventListener('submit', (event) => {
                event.preventDefault();
                const form = document.getElementById('motivation-form');
                const formData = new FormData(form);
                
                // Füge die OpenAI-Antwort zu den Formulardaten hinzu
                const openaiResponse = document.getElementById('openai_response').value;
                if (!openaiResponse) {
                    showToast("Bitte zuerst eine Vorschau generieren", "error");
                    return;
                }
                formData.append('openai_response', openaiResponse);

                // Ladezeichen anzeigen
                const downloadButton = event.submitter;
                downloadButton.disabled = true;
                downloadButton.textContent = 'Download...';

                // Timer für den Toast
                let toastTimer = setTimeout(() => {
                    showToast("Der Download wird vorbereitet. Bitte haben Sie einen Moment Geduld.");
                }, 20000);

                // Sende die Formulardaten per AJAX an den Server
                fetch(route('karriere.motivation.download-pdf'), {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Netzwerk-Antwort war nicht ok');
                    }
                    return response.blob();
                })
                .then(blob => {
                    clearTimeout(toastTimer);
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    const name = document.querySelector('input[name="name"]')?.value || '';
                    a.download = `Motivationsschreiben_${name}_${new Date().toLocaleDateString('de-DE').replace(/\./g, '_')}.pdf`;
                    document.body.appendChild(a);
                    a.click();
                    window.URL.revokeObjectURL(url);
                    a.remove();
                    showToast("Download erfolgreich");
                })
                .catch(error => {
                    clearTimeout(toastTimer);
                    console.error('Download-Fehler:', error);
                    showToast("Beim Download ist ein Fehler aufgetreten", "error");
                })
                .finally(() => {
                    downloadButton.disabled = false;
                    downloadButton.textContent = 'Download';
                });
            });
        });
    </script>
</body>
</html>
