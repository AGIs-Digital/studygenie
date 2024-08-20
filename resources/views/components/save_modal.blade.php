<div class="modal fade" id="saveModal" tabindex="-1" aria-labelledby="saveModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="save_data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="saveModalLabel">Antwort speichern</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="save_name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="save_name" name="name" placeholder="Speichername eingeben">
                    </div>
                    <input type="hidden" name="save_val" id="save_val">
                    <input type="hidden" name="tooltype" id="tooltype">
                    <input type="hidden" name="type" id="type">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Schließen</button>
                    <button type="button" class="btn btn-primary" id="saveFormButton">Archivieren</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('saveModal').addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
        }
    });
</script>