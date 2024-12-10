<!DOCTYPE html>
<html lang="de">

<head>
    @section('title', 'Text Inspiration')
    @include('components.head')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                <img id="closeIcon" onclick="window.location.href='/bildung/texte'" 
                     src="{{ asset('asset/images/ic_close.png') }}" alt="closeIcon">
                <svg xmlns="http://www.w3.org/2000/svg" width="134" height="113" viewBox="0 0 245 167" fill="none">
                    <image href="{{ asset('asset/images/cloud-background.svg') }}" width="245" height="167"/>
                    <x-cloud-content 
                        tool-name="Inspiration" 
                        bg-color="#E09E50"
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
                                <span>Aufgabenart:
                                    <strong type="button" data-bs-toggle="tooltip" 
                                            data-bs-placement="top" 
                                            title="Aufsatz, Inhaltsangaben, Bachelorarbeit, etc.">
                                        <img src="{{ asset('asset/images/info-tools.svg') }}" 
                                             width="16" alt="" loading="lazy">
                                    </strong>
                                </span>
                                <input type="text" placeholder="Aufsatz, Inhaltsangaben, Bachelorarbeit, etc." 
                                       id="field_1" name="field1">
                            </div>

                            <div class="group-box">
                                <span class="small_text_font">Level:
                                    <strong type="button" class="" data-bs-toggle="tooltip" data-bs-placement="top" title="9. Klasse Realschule, Oberstufe, Studium, etc.">
                                        <img src="{{ asset('asset/images/info-tools.svg') }}" width="16" alt="" loading="lazy">
                                    </strong>
                                </span>
                                <input type="text" placeholder="9. Klasse Realschule, Oberstufe, Studium, etc." id="field_2" name="field2">
                            </div>

                            <div class="group-box">
                                <span class="small_text_font">Thema:
                                    <strong type="button" class="" data-bs-toggle="tooltip" data-bs-placement="top" title="Zu welchem Thema willst du etwas schreiben?">
                                        <img src="{{ asset('asset/images/info-tools.svg') }}" width="16" alt="" loading="lazy">
                                    </strong>
                                </span>
                                <input type="text" placeholder="Bildungsreform im digitalen Zeitalter, etc." id="field_3" name="field3">
                            </div>

                            <div class="group-box">
                                <span class="small_text_font">Besonderen Anforderungen/Interessen:
                                    <strong type="button" class="" data-bs-toggle="tooltip" data-bs-placement="top" title="Wortanzahl, Text in einer anderen Sprache als deutsch, etc.">
                                        <img src="{{ asset('asset/images/info-tools.svg') }}" width="16" alt="" loading="lazy">
                                    </strong>
                                </span>
                                <input type="text" placeholder="300 Worte, in Englisch, etc." id="field_4" name="field4">
                            </div>

                            <div class="group-box">
                                <span>Zu erstellender Absatz:</span>
                                <div class="radio-group">
                                    <label class="radio-button">
                                        <input type="radio" name="field5" value="Inhaltsverzeichnis">
                                        <span class="radio-label">Inhaltsverzeichnis</span>
                                    </label>
                                    <label class="radio-button">
                                        <input type="radio" name="field5" value="Einleitung">
                                        <span class="radio-label">Einleitung</span>
                                    </label>
                                    <label class="radio-button">
                                        <input type="radio" name="field5" value="Hauptteil">
                                        <span class="radio-label">Hauptteil</span>
                                    </label>
                                    <label class="radio-button">
                                        <input type="radio" name="field5" value="Schluss">
                                        <span class="radio-label">Schluss</span>
                                    </label>
                                </div>
                            </div>

                            <div class="group-box">
                                <span class="small_text_font">Bisheriger Text:
                                    <strong type="button" class="" data-bs-toggle="tooltip" data-bs-placement="top" title="Gib deinen Text ein, um ihn weiterformulieren zu lassen.">
                                        <img src="{{ asset('asset/images/info-tools.svg') }}" width="16" alt="" loading="lazy">
                                    </strong>
                                </span>
                                <textarea name="field6" id="field_6" rows="10" style="width:100%;" oninput="this.style.height = '';this.style.height = this.scrollHeight + 'px'" placeholder="Deinen aktuellen Text hier eingeben"></textarea>
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
                    <div class="scroll-container" id="checkcontent_box">
                        <div id="typed-text"></div>
                    </div>
                </div>
                <p class="info-text">
                    StudyGenie kann Fehler machen. Überprüfe wichtige Informationen.
                </p>
            </section>
        </main>
    </div>

    @include('components.mathjax')
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
                    "text_inspiration",
                    "Bildung",
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
                    url: route('bildung.textinspiration.store'),
                    method: "POST",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        clearTimeout(toastTimer); // Timer löschen
                        conversation_id = response.message.conversation_id;
                        //Ladezeichen entfernen
                        $("#submitForm").removeClass('loading-button').text("Absenden").prop('disabled', false);
                        textToType = response.message.content.replace(/\n/g, " <br> ");
                        $('#typed-text').empty();
                        let checks = response.message.content.split('\n');
                        textarray = checks;
                        $("#save_val").val(textToType + " <br> <br> ");
                        typeFun();
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
