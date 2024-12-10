<!DOCTYPE html>
<html lang="de">

<head>
    @section('title', 'JobMatch')
    @include('components.head')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="MainContainer backimage">
    <div class="headerSpacer"></div>
        @include('components.navbar')
    @include('components.feedback')
    @include('components.mobile_warning')

    <div class="page-container">
        <!-- Sidebar with back button -->
        <aside class="sidebar">
            <div class="leftCon" style="cursor: pointer">
                <img id="closeIcon" onclick="window.location.href='/karriere/berufe'" 
                     src="{{ asset('asset/images/ic_close.png') }}" alt="closeIcon">
                <svg xmlns="http://www.w3.org/2000/svg" width="134" height="113" viewBox="0 0 245 167" fill="none">
                    <image href="{{ asset('asset/images/cloud-background.svg') }}" width="245" height="167"/>
                    <x-cloud-content 
                        tool-name="JobMatch" 
                        bg-color="#2D3E4E"
                        text-color="#FFFFFF"
                    />
                </svg>
            </div>
        </aside>

        <!-- Main content area -->
        <main class="main-content">
            <!-- Input Section -->
            <section class="input-section">
                <div class="input-area">
                    <div class="scroll-container">
                        <form id="myForm">
                            @csrf
                            <div class="group-box">
                                <span>Fähigkeiten & Stärken:
                                    <strong type="button" data-bs-toggle="tooltip" 
                                            data-bs-placement="top" 
                                            title="Was kannst du deiner Meinung nach besonders gut?">
                                        <img src="{{ asset('asset/images/info-tools.svg') }}" 
                                             width="16" alt="" loading="lazy">
                                    </strong>
                                </span>
                                <input type="text" placeholder="Teamführung, Kommunikation, etc." 
                                       id="field_1" name="field1">
                            </div>

                            <div class="group-box">
                                <span>Interessen & Leidenschaften:
                                    <strong type="button" data-bs-toggle="tooltip" 
                                            data-bs-placement="top" 
                                            title="Was machst du gerne in deiner Freizeit? Was begeistert dich?">
                                        <img src="{{ asset('asset/images/info-tools.svg') }}" 
                                             width="16" alt="" loading="lazy">
                                    </strong>
                                </span>
                                <input type="text" placeholder="Sport, Technik, Kunst, etc." 
                                       id="field_2" name="field2">
                            </div>

                            <div class="group-box">
                                <span>Diese Fähigkeiten möchte ich erlernen:
                                    <strong type="button" data-bs-toggle="tooltip" 
                                            data-bs-placement="top" 
                                            title="Welche Fähigkeiten würdest du gerne in deinem Beruf entwickeln?">
                                        <img src="{{ asset('asset/images/info-tools.svg') }}" 
                                             width="16" alt="" loading="lazy">
                                    </strong>
                                </span>
                                <input type="text" placeholder="Projektmanagement, Programmierung, etc." 
                                       id="field_3" name="field3">
                            </div>

                            <div class="group-box">
                                <span>Bevorzugte Arbeitsumgebung:
                                    <strong type="button" data-bs-toggle="tooltip" 
                                            data-bs-placement="top" 
                                            title="Wie bist du am produktivsten? In Gruppen? Alleine? Draußen? etc.">
                                        <img src="{{ asset('asset/images/info-tools.svg') }}" 
                                             width="16" alt="" loading="lazy">
                                    </strong>
                                </span>
                                <input type="text" placeholder="In Teams, Alleine, etc." 
                                       id="field_4" name="field4">
                            </div>

                            <!-- Radio Buttons für Entscheidungsfreiheit -->
                            <div class="group-box">
                                <span>Entscheidungsfreiheit & Kontrolle:
                                    <strong type="button" data-bs-toggle="tooltip" 
                                            data-bs-placement="top" 
                                            title="Wie wichtig sind dir Entscheidungsfreiheit und Kontrolle bei Aufgaben?">
                                        <img src="{{ asset('asset/images/info-tools.svg') }}" 
                                             width="16" alt="" loading="lazy">
                                    </strong>
                                </span>
                                <div class="radio-group">
                                    <label class="radio-button">
                                        <input type="radio" name="field5" value="wichtig">
                                        <span class="radio-label">wichtig</span>
                                    </label>
                                    <label class="radio-button">
                                        <input type="radio" name="field5" value="neutral">
                                        <span class="radio-label">neutral</span>
                                    </label>
                                    <label class="radio-button">
                                        <input type="radio" name="field5" value="unwichtig">
                                        <span class="radio-label">unwichtig</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Radio Buttons für Persönlichkeitstyp -->
                            <div class="group-box">
                                <span>Persönlichkeitstyp:
                                    <strong type="button" data-bs-toggle="tooltip" 
                                            data-bs-html="true" 
                                            data-bs-placement="top" 
                                            title="Introvertiert: Mag Ruhe, ist gern alleine<br>Extrovertiert: Mag Action, ist gern unter Menschen">
                                        <img src="{{ asset('asset/images/info-tools.svg') }}" 
                                             width="16" alt="">
                                    </strong>
                                </span>
                                <div class="radio-group">
                                    <label class="radio-button">
                                        <input type="radio" name="field6" value="introvertiert">
                                        <span class="radio-label">Introvertiert</span>
                                    </label>
                                    <label class="radio-button">
                                        <input type="radio" name="field6" value="extrovertiert">
                                        <span class="radio-label">Extrovertiert</span>
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="button-container">
                    <button type="button" class="send-button" id="submitForm">Absenden</button>
                    <button type="button" class="archive-button" id="showSaveModal">Archivieren</button>
                </div>
            </section>

            <!-- Output Section -->
            <section class="output-section">
                <div class="output-area">
                    <div class="scroll-container">
                        <div id="typed-text"></div>
                    </div>
                </div>
                <p class="info-text">
                    StudyGenie kann Fehler machen. Überprüfe wichtige Informationen.
                </p>
            </section>
        </main>
    </div>

    @include('components.save_modal')

    <script src="{{ asset('asset/js/typing.js') }}"></script>

    <script>
        let conversation_id = null
        document.addEventListener('DOMContentLoaded', () => {
            const saveForm = document.getElementById('save_data');
            const saveFormButton = document.getElementById('saveFormButton');
            const showSaveModalButton = document.getElementById('showSaveModal');

            // Speichern des Chatverlaufs
            saveFormButton.addEventListener('click', async () => {
                await window.fns.saveToArchive(
                    conversation_id,
                    $("#save_name").val(),
                    "job_match",
                    "Karriere",
                );

                $("#save_name").val('');

                // Schließe das Modal
                $('#saveModal').modal('hide');

                showToast(document.title + " wurde im Archiv gespeichert");
            });

            showSaveModalButton.addEventListener('click', () => {
                $('#saveModal').modal('show');
            });
        });
    </script>
    <script>

        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        $(document).ready(function() {
            const saveForm = document.getElementById('save_data');
            const saveFormButton = document.getElementById('saveForm');

            $("#submitForm").on("click", function() {
                let form = $("#myForm")[0];
                let formData = new FormData(form);
                $("#save_data").val('x');
                //Ladezeichen anzeigen
                $("#submitForm").addClass('loading-button').text("Zaubert...").prop('disabled', true);

                // Timer für den Toast
                let toastTimer = setTimeout(() => {
                    showToast("Unsere Server brauchen gerade etwas länger. Bitte haben Sie einen Moment Geduld.");
                }, 20000);

                $.ajax({
                    url: route('karriere.jobmatch.store'),
                    method: "POST",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        clearTimeout(toastTimer); // Timer löschen
                        // Prüfe ob response.message existiert
                        if (response && response.message) {
                            conversation_id = response.message.conversation_id || null;
                            textToType = response.message.content.replace(/\n/g, " <br> ");
                            $('#typed-text').empty();
                            let checks = response.message.content.split('\n');
                            textarray = checks;
                            $("#save_val").val(textToType + " <br> <br> ");
                            typeFun();
                        } else {
                            console.error("Unerwartetes Antwortformat vom Server");
                            showToast("Es ist ein Fehler aufgetreten. Bitte versuchen Sie es erneut.");
                        }
                        //Ladezeichen entfernen
                        $("#submitForm").removeClass('loading-button').text("Absenden").prop('disabled', false);
                    },
                    error: function(xhr, status, error) {
                        clearTimeout(toastTimer); // Timer löschen
                        console.error("Ein Fehler ist aufgetreten: " + error);
                        //Ladezeichen entfernen
                        $("#submitForm").removeClass('loading-button').text("Absenden").prop('disabled', false);
                    }
                });
            });
        });
    </script>
</body>

</html>
