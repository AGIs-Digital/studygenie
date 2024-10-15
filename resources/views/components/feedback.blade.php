<!-- Feedback Button -->
<div id="feedback-button" style="position: fixed; bottom: 20px; right: 20px; cursor: pointer; z-index: 9999;">
    <img src="{{ asset('asset/images/feedback-icon.png') }}" alt="Feedback" width="30" height="30">
</div>

<!-- Feedback Modal -->
<div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="feedbackForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="feedbackModalLabel">Anonymes Feedback</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="feedbackType" class="form-label">Feedback Typ</label>
                        <select class="form-select" id="feedbackType" name="feedbackType" required>
                            <option value="Bug">Bug</option>
                            <option value="Lob">Lob</option>
                            <option value="Kritik">Kritik</option>
                            <option value="Frage">Frage</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="feedbackText" class="form-label">Anonymes Feedback</label>
                        <textarea class="form-control" id="feedbackText" name="feedbackText" rows="3" required placeholder="Das möchte ich euch mitteilen..."></textarea>
                    </div>
                    <input type="hidden" id="currentPage" name="currentPage" value="{{ Request::path() }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Schließen</button>
                    <button type="submit" class="btn btn-primary">Absenden</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('asset/js/toast.js') }}"></script>

<script>
    document.getElementById('feedback-button').addEventListener('click', function() {
        var feedbackModal = new bootstrap.Modal(document.getElementById('feedbackModal'));
        feedbackModal.show();
    });

    document.getElementById('feedbackForm').addEventListener('submit', function(event) {
        event.preventDefault();
        var formData = new FormData(this);

        fetch('{{ route("feedback.store") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast(document.getElementById('feedbackType').value + "? Danke, wir schauen uns das an!");
                var feedbackModal = bootstrap.Modal.getInstance(document.getElementById('feedbackModal'));
                feedbackModal.hide();
            } else {
                showToast("Fehler beim Senden des Feedbacks!");
            }
        })
        .catch(error => console.error('Error:', error));
    });

    document.getElementById('feedbackModal').addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
        }
    });
</script>