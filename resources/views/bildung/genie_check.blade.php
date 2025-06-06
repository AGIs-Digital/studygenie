<!DOCTYPE html>
<html lang="de">

<head>
    @section('title', 'Fragen')
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
                <img id="closeIcon" onclick="window.location.href='/bildung'" 
                     src="{{ asset('asset/images/ic_close.png') }}" alt="closeIcon">
                <svg xmlns="http://www.w3.org/2000/svg" width="134" height="113" viewBox="0 0 245 167" fill="none">
                    <image href="{{ asset('asset/images/cloud-background.svg') }}" width="245" height="167"/>
                    <x-cloud-content tool-name="Fragen" />
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
                                <span>Deine Frage: 
                                    <strong type="button" data-bs-toggle="tooltip" 
                                            data-bs-placement="top" 
                                            title="Worum geht es? Matheaufgaben, Textaufgaben ich kann alles prüfen!">
                                        <img src="{{ asset('asset/images/info-tools.svg') }}" 
                                             width="16" alt="" loading="lazy">
                                    </strong>
                                </span>
                                <textarea name="text1" id="field1" rows="12" 
                                          style="width:100%;" 
                                          placeholder="Was möchtest du wissen?"
                                          oninput="this.style.height = '';this.style.height = this.scrollHeight + 'px'"></textarea>
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
                    "genie_check",
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
                let textField = $("#field1").val().trim();

                if (textField === "") {
                    showToast("Hoppla, du hast vergessen eine Frage zu stellen!.");
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
                    url: route('bildung.geniecheck.store'),
                    method: "POST",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        clearTimeout(toastTimer);
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
                        showToast("Ein Fehler ist aufgetreten: " + error, 'error');
                        $("#submitForm").removeClass('loading-button').text("Senden").prop('disabled', false);
                    }
                });
            });
        });
    </script>
</body>

</html>
