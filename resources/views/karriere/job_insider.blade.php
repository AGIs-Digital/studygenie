<!DOCTYPE html>
<html lang="de">

<head>
    @section('title', 'JobInsider')
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
                        tool-name="JobInsider" 
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
                                <span>Welcher Beruf interessiert dich?
                                    <strong type="button" data-bs-toggle="tooltip" 
                                            data-bs-placement="top" 
                                            title="Gib hier den Beruf ein zu dem du eine Übersicht möchtest">
                                        <img src="{{ asset('asset/images/info-tools.svg') }}" 
                                             width="16" alt="" loading="lazy">
                                    </strong>
                                </span>
                                <input type="text" placeholder="Maurer, Hundefriseur, etc." 
                                       id="field1" name="field1">
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
    document.addEventListener('DOMContentLoaded', function() {
        // URL-Parameter auslesen
        const urlParams = new URLSearchParams(window.location.search);
        const job = urlParams.get('job');
        
        if (job) {
            // Wert in das Eingabefeld setzen
            $("#field1").val(job);
            
            // Kurze Verzögerung für die UI-Aktualisierung
            setTimeout(function() {
                $("#submitForm").click();
            }, 500);
        }
    });
    </script>
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
                    "job_insider",
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
                let textField = $("#field1").val().trim();

                if (textField === "") {
                    showToast("Hoppla, du hast vergessen einen Beruf einzugeben!");
                    return;
                }

                $("#save_data").val('x');
                //Ladezeichen anzeigen
                $("#submitForm").addClass('loading-button').text("Zaubert...").prop('disabled', true);

                // Timer für den Toast
                let toastTimer = setTimeout(() => {
                    showToast("Unsere Server brauchen gerade etwas länger. Bitte haben Sie einen Moment Geduld.");
                }, 20000);

                $.ajax({
                    url: route('karriere.jobinsider.store'),
                    method: "POST",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        clearTimeout(toastTimer);
                        if (!response || !response.message) {
                            showToast("Unerwartete Serverantwort", "error");
                            return;
                        }
                        conversation_id = response.message.conversation_id;
                        //Ladezeichen entfernen
                        $("#submitForm").removeClass('loading-button').text("Absenden").prop('disabled', false);
                        textToType = response.message.content.replace(/\n/g, " <br> ");
                        $('#typed-text').empty();
                        let checks = response.message.content.split('\n');
                        textarray = checks;
                        $("#save_val").val(textToType + " <br> <br> ");
                        typeFun();
                        
                        // Textfeld leeren
                        $("#field1").val('');
                    },
                    error: function(xhr, status, error) {
                        clearTimeout(toastTimer);
                        console.error("Fehler:", error);
                        showToast("Ein Fehler ist aufgetreten: " + error, "error");
                        $("#submitForm").removeClass('loading-button').text("Absenden").prop('disabled', false);
                    }
                });
            });
        });
    </script>
</body>

</html>
