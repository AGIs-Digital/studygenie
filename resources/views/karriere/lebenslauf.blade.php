<!DOCTYPE html>
<html lang="de">

<head>
    @section('title', 'Lebenslauf')
    @include('components.head')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="MainContainer backimage">
    <div class="headerSpacer"></div>
        @include('components.navbar')
    @include('components.feedback')
    @include('components.mobile_warning')

    <section class="archive_sec">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <div class="leftCon" style="cursor: pointer">
                        <img id="closeIcon" onclick="window.location.href='{{ route('karriere.bewerbung') }}'" src="{{ asset('asset/images/ic_close.png') }}" alt="closeIcon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="134" height="113" viewBox="0 0 245 167" fill="none">
                            <image href="{{ asset('asset/images/cloud-background.svg') }}" width="245" height="167"/>
                            <x-cloud-content 
                                tool-name="Lebenslauf" 
                                bg-color="#2D3E4E"
                                text-color="#FFFFFF"
                            />
                        </svg>
                    </div>
                </div>

                <div class="col-md-3" id="cv-form-container">
                    <form id="cv-form">
                        @csrf
                        <h2 style="color: #2D3E4E; font-family: Milonga; font-size: 32px; font-style: normal; font-weight: 400; line-height: 38px; position: relative; margin-top: 3rem;">
                            Lebenslauf
                        </h2>
                        <p style="font-size: 12px; color: gray; text-align: center; margin: 0;">Fasse dich kurz, damit dein Lebenslauf auf eine Seite passt.</p>
                        <div class="accordion accordion-flush" id="accordionFlushExample" style="border: 1px solid #2D3E4E; border-radius: 12px;">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        Persönliche Informationen
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
                                            <p>Geburtsdatum: <input type="date" name="birthdate" autocomplete="bday"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                        Berufliche Erfahrungen
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <div class="section" id="experience">
                                            <div class="entry">
                                                <p>Unternehmen: <input type="text" name="experience_company[]"></p>
                                                <p>Position: <input type="text" name="experience_position[]"></p>
                                                <p>Zeitraum: <input type="text" name="experience_period[]"></p>
                                                <p>Beschreibung: <textarea name="experience_description[]"></textarea></p>
                                            </div>
                                            <div class="button">
                                                <button type="button" id="add-experience">Weiterer Eintrag</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                        Schulbildung
                                    </button>
                                </h2>
                                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <div class="section" id="school">
                                            <div class="entry">
                                                <p>Einrichtung: <input type="text" name="school_form[]"></p>
                                                <p>Abschluss: <input type="text" name="school_grade[]"></p>
                                                <p>Start: <input type="date" name="school_start[]"></p>
                                                <p>Ende: <input type="date" name="school_end[]"></p>
                                            </div>
                                            <div class="button">
                                                <button type="button" id="add-school">Weiterer Eintrag</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingFour">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                        Sprachen
                                    </button>
                                </h2>
                                <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <div class="section" id="language">
                                            <div class="entry">
                                                <p>Sprache: <input type="text" name="language_type[]"></p>
                                                <p>Level: <input type="text" name="language_level[]"></p>
                                            </div>
                                            <div class="button">
                                                <button type="button" id="add-language">Weiterer Eintrag</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingFive">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                                        Kenntnisse
                                    </button>
                                </h2>
                                <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <div class="section" id="skill">
                                            <div class="entry">
                                                <p>Fähigkeit: <input type="text" name="skill_type[]"></p>
                                            </div>
                                            <div class="button">
                                                <button type="button" id="add-skill">Weiterer Eintrag</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingSix">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                                        Ehrenamtliche Tätigkeiten
                                    </button>
                                </h2>
                                <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <div class="section" id="volunteer">
                                            <div class="entry">
                                                <p>Einrichtung: <input type="text" name="volunteer_company[]"></p>
                                                <p>Tätigkeit: <input type="text" name="volunteer_task[]"></p>
                                                <p>Zeitraum: <input type="text" name="volunteer_period[]"></p>
                                            </div>
                                            <div class="button">
                                                <button type="button" id="add-volunteer">Weiterer Eintrag</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingSeven">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
                                        Ort & Datum
                                    </button>
                                </h2>
                                <div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <div class="section" id="signature">
                                            <div class="entry">
                                                <p>Ort: <input type="text" name="signature_town"></p>
                                                <p>Datum: <input type="date" name="signature_date"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-body">
                                <div class="section" id="side-panel-color">
                                    <div class="entry">
                                        <p>Farbe: <input type="color" name="side_panel_color" id="side_panel_color" value="#E09E50"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <input type="hidden" name="side_panel_text_color" value="white">
                        <div id="cv-form-buttons" class="button-container">
                            <button type="button" id="preview-button" class="send-button">Vorschau</button>
                            <button type="submit" class="archive-button">Download</button>
                        </div>
                    </form>

                </div>

                <div class="col-md-7" id="cv-preview-container">
                    <div class="cv_box_sec preview-container" id="cv_appnd">
                        <!-- Vorschau des Lebenslaufs wird hier angezeigt -->
                    </div>
                </div>
            </div>
    </section>

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

            function addRemoveButton(entry) {
                const removeButton = document.createElement('button');
                removeButton.classList.add('btn', 'delete-archive');
                removeButton.innerHTML = '<i class="fas fa-trash-alt"></i>';
                removeButton.addEventListener('click', () => {
                    entry.remove();
                    checkFields();
                });
                entry.appendChild(removeButton);
            }

            function addNewEntry(sectionId, entryHtml) {
                const section = document.getElementById(sectionId);
                const newEntry = document.createElement('div');
                newEntry.classList.add('entry');
                newEntry.innerHTML = entryHtml;
                addRemoveButton(newEntry);
                section.appendChild(newEntry);
                checkFields();

                // Move the "Weiterer Eintrag" button to the end of the section
                const addButton = section.querySelector('.button');
                section.appendChild(addButton);
            }

            document.getElementById('add-experience').addEventListener('click', () => {
                addNewEntry('experience', `
                    <p>Unternehmen: <input type="text" name="experience_company[]"></p>
                    <p>Position: <input type="text" name="experience_position[]"></p>
                    <p>Zeitraum: <input type="text" name="experience_period[]"></p>
                    <p>Beschreibung: <textarea name="experience_description[]"></textarea></p>
                `);
            });

            document.getElementById('add-school').addEventListener('click', () => {
                addNewEntry('school', `
                    <p>Einrichtung: <input type="text" name="school_form[]" ></p>
                    <p>Abschluss: <input type="text" name="school_grade[]" ></p>
                    <p>Start: <input type="date" name="school_start[]" ></p>
                    <p>Ende: <input type="date" name="school_end[]"></p>
                `);
            });

            document.getElementById('add-language').addEventListener('click', () => {
                addNewEntry('language', `
                    <p>Sprache: <input type="text" name="language_type[]" ></p>
                    <p>Level: <input type="text" name="language_level[]" ></p>
                `);
            });

            document.getElementById('add-skill').addEventListener('click', () => {
                addNewEntry('skill', `
                    <p>Fähigkeit: <input type="text" name="skill_type[]" ></p>
                `);
            });

            document.getElementById('add-volunteer').addEventListener('click', () => {
                addNewEntry('volunteer', `
                    <p>Einrichtung: <input type="text" name="volunteer_company[]"></p>
                    <p>Tätigkeit: <input type="text" name="volunteer_task[]"></p>
                    <p>Zeitraum: <input type="text" name="volunteer_period[]"></p>
                `);
            });

            function getContrastYIQ(hexcolor) {
                hexcolor = hexcolor.replace("#", "");
                const r = parseInt(hexcolor.substr(0, 2), 16);
                const g = parseInt(hexcolor.substr(2, 2), 16);
                const b = parseInt(hexcolor.substr(4, 2), 16);
                const yiq = ((r * 299) + (g * 587) + (b * 114)) / 1000;
                return (yiq >= 128) ? 'black' : 'white';
            }

            document.getElementById('side_panel_color').addEventListener('input', (event) => {
                const color = event.target.value;
                const textColor = getContrastYIQ(color);
                document.querySelector('input[name="side_panel_text_color"]').value = textColor;
            });

            // Vorschau-Funktionalität
            document.getElementById('preview-button').addEventListener('click', () => {
                const form = document.getElementById('cv-form');
                const formData = new FormData(form);
                const previewContainer = document.getElementById('cv_appnd');

                // Leere den Vorschau-Container
                previewContainer.innerHTML = '';

                // Timer für den Toast
                let toastTimer = setTimeout(() => {
                    showToast("Unsere Server brauchen gerade etwas länger. Bitte haben Sie einen Moment Geduld.");
                }, 20000);

                // Sende die Formulardaten per AJAX an den Server
                fetch(route('karriere.lebenslauf.preview'), {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        clearTimeout(toastTimer); // Timer löschen
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
                    .catch(error => {
                        clearTimeout(toastTimer); // Timer löschen
                        console.error('Error:', error);
                    });
            });

            // Download-Funktionalität
            document.getElementById('cv-form').addEventListener('submit', (event) => {
                event.preventDefault();
                const form = document.getElementById('cv-form');
                const formData = new FormData(form);

                // Timer für den Toast
                let toastTimer = setTimeout(() => {
                    showToast("Unsere Server brauchen gerade etwas länger. Bitte haben Sie einen Moment Geduld.");
                }, 20000);

                // Sende die Formulardaten per AJAX an den Server
                fetch(route('karriere.lebenslauf.download'), {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.blob())
                    .then(blob => {
                        clearTimeout(toastTimer); // Timer löschen
                        const url = window.URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.href = url;
                        const name = document.querySelector('input[name="name"]')?.value || '';
                        a.download = `Lebenslauf_${name}_${new Date().toLocaleDateString('de-DE').replace(/\./g, '_')}.pdf`;
                        document.body.appendChild(a);
                        a.click();
                        a.remove();
                    })
                    .catch(error => {
                        clearTimeout(toastTimer); // Timer löschen
                        console.error('Error:', error);
                    });
            });

            const cleanup = () => {
                document.removeEventListener('DOMContentLoaded', checkFields);
                // weitere Event Listener entfernen
            };

            // Cleanup bei Page Unload
            window.addEventListener('unload', cleanup);
        });
    </script>

</body>

</html>
