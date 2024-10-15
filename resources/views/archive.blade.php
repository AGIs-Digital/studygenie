<!DOCTYPE html>
<html lang="de">

<head>
    @section('title', 'Archiv')
    @include('components.head')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="MainContainer">
    <div class="headerSpacer"></div>
    @include('components.navbar')
    @include('components.feedback')
    @include('components.arrowupbutton')

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2 style="color: #E09E50; font-family: Milonga; font-size: 32px; font-style: normal; font-weight: 400; line-height: 38px; position: relative; margin-top: 3rem; text-align: center;">Bildung</h2>
                <div class="accordion" id="accordionBildung">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="Bildungcheck">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#BildungCollpasetool2" aria-expanded="false" aria-controls="BildungCollpasetool2">Fragen</button>
                        </h2>
                        <div id="BildungCollpasetool2" class="accordion-collapse collapse" aria-labelledby="Bildungcheck" data-bs-parent="#accordionBildung">
                            <div class="accordion-body">
                                <div class="accordion accordion-flush" id="accordionFlushGenieCheck">
                                    <?php createAccordion($Bildung, 'genie_check'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="TextInspiration">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#BildungCollpasetool1" aria-expanded="false" aria-controls="BildungCollpasetool1">Texte Inspiration</button>
                        </h2>
                        <div id="BildungCollpasetool1" class="accordion-collapse collapse" aria-labelledby="TextInspiration" data-bs-parent="#accordionBildung">
                            <div class="accordion-body">
                                <div class="accordion accordion-flush" id="accordionFlushTextInspiration">
                                    <?php createAccordion($Bildung, 'text_inspiration'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="BildungOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#BildungCollpasetool3" aria-expanded="false" aria-controls="BildungCollpasetool3">Texte Analyse</button>
                        </h2>
                        <div id="BildungCollpasetool3" class="accordion-collapse collapse" aria-labelledby="BildungOne" data-bs-parent="#accordionBildung">
                            <div class="accordion-body">
                                <div class="accordion accordion-flush" id="accordionFlushTextAnalyse">
                                    <?php createAccordion($Bildung, 'text_analysis'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="BildungMentor">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#BildungCollpasetool4" aria-expanded="false" aria-controls="BildungCollpasetool4">Tutor</button>
                        </h2>
                        <div id="BildungCollpasetool4" class="accordion-collapse collapse" aria-labelledby="BildungMentor" data-bs-parent="#accordionBildung">
                            <div class="accordion-body">
                                <div class="accordion accordion-flush" id="accordionFlushTutor">
                                    <?php createAccordion($Bildung, 'tutor'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h2 style="color: #2D3E4E; font-family: Milonga; font-size: 32px; font-style: normal; font-weight: 400; line-height: 38px; position: relative; margin-top: 3rem; text-align: center;">Karriere</h2>
                <div class="accordion" id="accordionKarriere">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingJobMatch">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseJobMatch" aria-expanded="false" aria-controls="collapseJobMatch">Job Match</button>
                        </h2>
                        <div id="collapseJobMatch" class="accordion-collapse collapse" aria-labelledby="headingJobMatch" data-bs-parent="#accordionKarriere">
                            <div class="accordion-body">
                                <div class="accordion accordion-flush" id="accordionFlushJobMatch">
                                    <?php createAccordion($Karriere, 'job_match'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingJobInsider">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseJobInsider" aria-expanded="false" aria-controls="collapseJobInsider">Job Insider</button>
                        </h2>
                        <div id="collapseJobInsider" class="accordion-collapse collapse" aria-labelledby="headingJobInsider" data-bs-parent="#accordionKarriere">
                            <div class="accordion-body">
                                <div class="accordion accordion-flush" id="accordionFlushJobInsider">
                                    <?php createAccordion($Karriere, 'job_insider'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingKarriereMentor">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseKarriereMentor" aria-expanded="false" aria-controls="collapseKarriereMentor">Karriere Mentor</button>
                        </h2>
                        <div id="collapseKarriereMentor" class="accordion-collapse collapse" aria-labelledby="headingKarriereMentor" data-bs-parent="#accordionKarriere">
                            <div class="accordion-body">
                                <div class="accordion accordion-flush" id="accordionFlushKarriereMentor">
                                    <?php createAccordion($Karriere, 'karriere_mentor'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Eintrag löschen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Bist du sicher, dass du diese Antwort löschen möchtest?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Löschen</button>
                </div>
            </div>
        </div>
    </div>

    @include('components.mathjax')
    @include('components.footer')

    <script src="{{ asset('asset/js/toast.js') }}"></script>
    <script>
        $(document).ready(function() {
            var deleteId;

            $('.delete-archive').click(function() {
                deleteId = $(this).data('id');
                $('#deleteConfirmationModal').modal('show');
            });

            $('#confirmDelete').click(function() {
                $('#deleteConfirmationModal').modal('hide');
                $.ajax({
                    url: route('archive.destroy', deleteId),
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#archive-item-' + deleteId).fadeOut('slow', function() {
                                $(this).remove();
                            });
                            showToast('Der Eintrag wurde erfolgreich gelöscht.', 'success');
                        } else {
                            showToast('Fehler: ' + response.message, 'error');
                        }
                    },
                    error: function(xhr) {
                        showToast('Ein Fehler ist aufgetreten. Bitte später erneut versuchen.', 'error');
                    }
                });
            });

            // MathJax-Formatierung auf alle Nachrichten anwenden
            MathJax.typesetPromise().then(() => {
                console.log('MathJax typesetting complete.');
            }).catch((err) => {
                console.error('MathJax typesetting failed:', err);
            });

            // Initialize Bootstrap collapse
            var collapseElements = document.querySelectorAll('.accordion-button');
            collapseElements.forEach(function (element) {
                element.addEventListener('click', function() {
                    var target = document.querySelector(element.getAttribute('data-bs-target'));
                    var collapseInstance = bootstrap.Collapse.getOrCreateInstance(target);

                    collapseInstance.toggle(); // Toggle the collapse state
                });
            });
        });
    </script>
</body>
</html>
<?php
function createAccordion($data, $toolType) {
    foreach ($data as $row) {
        if ($row['tooltype'] === $toolType) {
            echo '<div class="accordion-item" id="archive-item-' . $row['id'] . '">';
            echo '<h2 class="accordion-header d-flex justify-content-between align-items-center" id="flush-headingOne' . $row['id'] . '">';
            echo '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne' . $row['id'] . '" aria-expanded="false" aria-controls="flush-collapseOne' . $row['id'] . '">' . $row['question'] . '</button>';
            echo '<button class="btn delete-archive" data-id="' . $row['id'] . '"><i class="fas fa-trash-alt"></i></button>';
            echo '</h2>';
            echo '<div id="flush-collapseOne' . $row['id'] . '" class="accordion-collapse collapse" aria-labelledby="flush-headingOne' . $row['id'] . '" data-bs-parent="#accordionFlushExample2">';
            echo '<div class="accordion-body">' . $row['answer'] . '</div>';
            echo '</div>';
            echo '</div>';
        }
    }
}
?>
