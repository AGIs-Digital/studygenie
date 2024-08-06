<!DOCTYPE html>
<html lang="de">

<head>
    @section('title', 'Lebenslauf')
    @include('includes.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .remove-entry {
            color: white;
            background-color: #E74C3C;
            border-radius: 50%;
            cursor: pointer;
            margin-left: 10px;
            padding: 5px 8px;
            font-size: 14px;
            font-weight: bold;
            display: inline-block;
            text-align: center;
            line-height: 1;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .entry p {
            margin: 0.5rem 0;
        }

        .entry input,
        .entry textarea {
            width: 100%;
            padding: 0.5rem;
            margin-top: 0.25rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 0.8rem;
        }

        .accordion-body {
            padding-left: 1rem;
        }

        .preview-container {
            border: 1px solid #2D3E4E;
            border-radius: 12px;
            padding: 1rem;
            margin-top: 6rem;
            margin-right: 3rem;
            background-color: #f8f8f8;
            height: 100%;
            overflow-y: auto;
        }
    </style>
</head>

<body class="MainContainer">
    @include('includes.header')
    <section class="archive_sec">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <div class="leftCon" style="cursor: pointer">
                        <img id="closeIcon" onclick="window.location.href='/karriere/bewerbegenie'"
                            src="{{ asset('asset/images/ic_close.png') }}" alt="closeIcon">

                        <svg xmlns="http://www.w3.org/2000/svg" width="134" height="113" viewBox="0 0 245 167"
                            fill="none">
                            <g filter="url(#filter0_d_168_754)">
                                <path
                                    d="M211.688 63.0115C215.695 65.9483 219.14 69.583 221.858 73.7415C224.672 77.8488 226.568 82.5146 227.415 87.4208C228.262 92.327 228.042 97.3582 226.768 102.171C223.428 114.981 216.168 124.581 205.168 130.681C199.693 133.815 193.534 135.563 187.228 135.771C185.427 135.82 183.625 135.692 181.848 135.391C178.002 138.834 173.501 141.466 168.615 143.129C163.728 144.792 158.556 145.453 153.408 145.071C146.826 144.762 140.437 142.746 134.868 139.221C133.668 140.021 132.478 140.761 131.278 141.441C123.634 145.763 115.227 148.568 106.518 149.701C95.3159 150.615 71.5349 149.799 66.0298 139.221C59.1483 126 52.5391 121 46.5298 124C40.5204 127 16.0298 111.549 17.0298 104.5C17.8298 98.8612 20.0088 97.4515 20.9983 97.4515C20.0533 93.3852 19.6332 89.2145 19.7483 85.0415C20.0283 74.8715 22.8383 66.0115 28.1083 58.7015C31.3727 54.0131 35.6054 50.08 40.5204 47.1679C45.4354 44.2559 50.9182 42.4326 56.5983 41.8215L57.0183 41.7615C57.5483 41.6815 58.1783 41.5715 59.1483 41.5215C60.1183 41.4715 60.9283 41.4715 61.5183 41.4715H62.5183C65.9209 41.6153 69.3075 42.0198 72.6483 42.6815C76.0785 36.3949 80.9649 31.0216 86.8983 27.0115C94.763 21.526 103.912 18.1673 113.458 17.2615C125.558 16.0115 136.998 19.2515 147.508 26.8115C151.874 24.746 156.55 23.4148 161.348 22.8715C172.878 21.3815 183.638 24.5315 193.348 32.2215C199.803 37.4345 204.973 44.0619 208.458 51.5915C210.146 55.198 211.237 59.055 211.688 63.0115Z"
                                    fill="#F8F8F8"></path>
                                <svg xmlns="http://www.w3.org/2000/svg" width="184" height="109"
                                    viewBox="0 0 184 109" x="30" y="30">
                                    <rect width="100%" height="100%" fill="none"></rect>
                                    <path
                                        d="M169.358 42.2315C168.781 41.9628 168.298 41.5259 167.973 40.978C167.649 40.4302 167.497 39.797 167.538 39.1615C167.542 35.3204 166.738 31.5215 165.178 28.0115C162.524 22.1812 158.554 17.0465 153.578 13.0115C146.948 7.75151 139.508 5.15151 130.978 6.26151C125.298 7.00151 119.978 8.62151 115.718 12.7015C114.988 13.3915 114.468 13.2215 113.838 12.6115C112.988 11.7915 112.108 11.0215 111.208 10.2615C102.958 3.37151 93.6882 -0.438494 82.7182 0.671506C75.2957 1.34277 68.1756 3.93439 62.0582 8.19151C55.4282 12.8215 50.7482 18.8215 48.9982 26.8615C48.8982 27.2948 48.7882 27.7148 48.6682 28.1215C48.2782 29.4915 48.2582 29.4915 46.9082 28.8715L46.4182 28.6215C41.2329 26.2577 35.6161 24.9879 29.9182 24.8915C29.2982 24.8915 28.6782 24.8915 28.0582 24.8915C27.4382 24.8915 26.7182 25.0615 26.0582 25.1415C22.1076 25.5463 18.2931 26.8095 14.8817 28.8425C11.4702 30.8756 8.54417 33.6294 6.30823 36.9115C2.14823 42.6815 0.498228 49.3015 0.308228 56.2815C0.0240566 64.608 2.75469 72.7572 7.99823 79.2315C13.7282 86.4815 20.9382 91.2315 30.4882 91.4715C30.8327 91.4485 31.1759 91.5321 31.4711 91.711C31.7663 91.89 31.9993 92.1555 32.1382 92.4715C33.7782 95.7615 36.4782 98.1215 39.2082 100.472C43.5116 104.24 48.7348 106.803 54.3482 107.902C59.814 108.946 65.4026 109.188 70.9382 108.622C78.7765 107.891 86.3705 105.505 93.2182 101.622C96.477 99.7219 99.5184 97.4719 102.288 94.9115C103.358 93.9115 103.398 93.9815 104.288 95.0515C106.509 97.6491 109.247 99.7553 112.327 101.236C115.408 102.717 118.762 103.539 122.178 103.652C131.868 104.212 139.718 100.362 145.718 92.7315C146.518 91.7315 146.518 91.6615 147.568 92.3715C149.763 93.8095 152.358 94.5102 154.978 94.3715C159.262 94.2134 163.441 93.0046 167.148 90.8515C175.398 86.1615 180.348 79.0115 182.698 70.0115C183.53 66.8929 183.668 63.6297 183.101 60.4522C182.534 57.2747 181.277 54.2602 179.418 51.6215C176.877 47.7215 173.424 44.4987 169.358 42.2315Z"
                                        fill="rgba(41,58,74,1)"></path>
                                    <text class="textStyle" x="50%" y="65" text-anchor="middle" font-family: 'Milonga' ,
                                        cursive; font-size="24" fill="#FFFFFF" font-weight="400">Lebenslauf</text>
                                </svg>
                            </g>
                            <defs>
                                <filter id="filter0_d_168_754" x="0" y="0" width="244.92" height="166.98"
                                    filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                    <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                    <feColorMatrix in="SourceAlpha" type="matrix"
                                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha">
                                    </feColorMatrix>
                                    <feOffset></feOffset>
                                    <feGaussianBlur stdDeviation="8.5"></feGaussianBlur>
                                    <feComposite in2="hardAlpha" operator="out"></feComposite>
                                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0">
                                    </feColorMatrix>
                                    <feBlend mode="normal" in2="BackgroundImageFix"
                                        result="effect1_dropShadow_168_754"></feBlend>
                                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_168_754"
                                        result="shape"></feBlend>
                                </filter>
                            </defs>
                        </svg>
                    </div>
                </div>

                <div class="col-md-3">
                    <form id="cv-form">
                        @csrf
                        <h2
                            style="color: #2D3E4E; font-family: Milonga; font-size: 32px; font-style: normal; font-weight: 400; line-height: 38px; position: relative; margin-top: 3rem;">
                            Lebenslauf</h2>
                        <div class="accordion accordion-flush" id="accordionFlushExample"
                            style="border: 1px solid #2D3E4E; border-radius: 12px;">

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseOne" aria-expanded="false"
                                        aria-controls="flush-collapseOne">
                                        Persönliche Informationen</button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <div class="entry">
                                            <p>Name: <input type="text" name="name" autocomplete="name"></p>
                                            <p>Straße Nr.: <input type="text" name="street"
                                                    autocomplete="street-address"></p>
                                            <p>PLZ: <input type="text" name="postal_city" autocomplete="postal-code">
                                            </p>
                                            <p>Ort: <input type="text" name="city" autocomplete="address-level2">
                                            </p>
                                            <p>Telefon: <input type="text" name="phone" autocomplete="tel"></p>
                                            <p>E-Mail: <input type="email" name="email" autocomplete="email"></p>
                                            <p>Geburtsdatum: <input type="date" name="birthdate" autocomplete="bday">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                        aria-expanded="false" aria-controls="flush-collapseTwo">
                                        Berufliche Erfahrungen</button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <div class="section" id="experience">
                                            <div class="entry">
                                                <p>Unternehmen: <input type="text" name="experience_company[]"></p>
                                                <p>Position: <input type="text" name="experience_position[]"></p>
                                                <p>Zeitraum: <input type="text" name="experience_period[]"></p>
                                                <p>Beschreibung:
                                                    <textarea name="experience_description[]"></textarea>
                                                </p>
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
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseThree"
                                        aria-expanded="false" aria-controls="flush-collapseThree">
                                        Schulbildung</button>
                                </h2>
                                <div id="flush-collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
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
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseFour"
                                        aria-expanded="false" aria-controls="flush-collapseFour">
                                        Sprachen</button>
                                </h2>
                                <div id="flush-collapseFour" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
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
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseFive"
                                        aria-expanded="false" aria-controls="flush-collapseFive">
                                        Kenntnisse</button>
                                </h2>
                                <div id="flush-collapseFive" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
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
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseSix"
                                        aria-expanded="false" aria-controls="flush-collapseSix">
                                        Ehrenamtliche Tätigkeiten</button>
                                </h2>
                                <div id="flush-collapseSix" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
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
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven"
                                        aria-expanded="false" aria-controls="flush-collapseSeven">
                                        Ort & Datum</button>
                                </h2>
                                <div id="flush-collapseSeven" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
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
                        </div>
                        <br />
                        <div class="text-center"
                            style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                            <button type="button" id="preview-button" class="send_button">Vorschau</button>
                            <button type="submit" class="send_button">Download</button>
                        </div>
                    </form>
                </div>

                <div class="col-md-7">
                    <div class="cv_box_sec preview-container" id="cv_appnd">
                        <!-- Vorschau des Lebenslaufs wird hier angezeigt -->
                    </div>
                </div>
            </div>
    </section>

    @include('includes.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

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
                const removeButton = document.createElement('span');
                removeButton.classList.add('remove-entry');
                removeButton.innerHTML = 'X';
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

            // Vorschau-Funktionalität
            document.getElementById('preview-button').addEventListener('click', () => {
                const form = document.getElementById('cv-form');
                const formData = new FormData(form);
                const previewContainer = document.getElementById('cv_appnd');

                // Leere den Vorschau-Container
                previewContainer.innerHTML = '';

                // Sende die Formulardaten per AJAX an den Server
                fetch(route('karriere.lebenslauf.preview'), {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
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
            });

            // Download-Funktionalität
            document.getElementById('cv-form').addEventListener('submit', (event) => {
                event.preventDefault();
                const form = document.getElementById('cv-form');
                const formData = new FormData(form);

                // Sende die Formulardaten per AJAX an den Server
                fetch(route('karriere.lebenslauf.download'), {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        }
                    })
                    .then(response => response.blob())
                    .then(blob => {
                        const url = window.URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.href = url;
                        a.download = 'lebenslauf.pdf';
                        document.body.appendChild(a);
                        a.click();
                        a.remove();
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    </script>

</body>

</html>
