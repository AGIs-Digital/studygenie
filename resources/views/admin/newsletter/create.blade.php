@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="newsletter-container">
                <div class="newsletter-header">
                    <h2 class="newsletter-title">Newsletter erstellen</h2>
                    <p class="newsletter-subtitle">Erstellen und versenden Sie hier Ihren Newsletter</p>
                </div>

                <div class="newsletter-body">
                    @if(session('success'))
                        <div class="newsletter-alert-success">
                            {{ session('success') }}
                            <button type="button" class="newsletter-close-btn" data-bs-dismiss="alert">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="newsletter-alert-danger">
                            <ul class="newsletter-error-list">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('newsletter.send') }}" id="newsletterForm">
                        @csrf
                        <div class="newsletter-form-group">
                            <label class="newsletter-label">Betreff</label>
                            <input type="text" name="subject" class="newsletter-input" required 
                                   value="{{ old('subject') }}" placeholder="Geben Sie hier den Betreff ein">
                        </div>

                        <div class="newsletter-form-group">
                            <label class="newsletter-label">Inhalt</label>
                            <textarea name="content" id="editor" required>{{ old('content') }}</textarea>
                        </div>

                        <div class="newsletter-button-group">
                            <button type="button" class="newsletter-preview-btn" id="previewButton">
                                <i class="fas fa-eye"></i> Vorschau
                            </button>
                            <button type="submit" class="newsletter-submit-btn">
                                <i class="fas fa-paper-plane"></i> Newsletter versenden
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header newsletter-modal-header">
                <h5 class="modal-title">Newsletter Vorschau</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="previewContent"></div>
        </div>
    </div>
</div>

@push('styles')
<style>
.newsletter-container {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    margin-top: 2rem;
}

.newsletter-header {
    background: linear-gradient(135deg, #2D3E4E 0%, #1a252f 100%);
    color: #fff;
    padding: 2rem;
    text-align: center;
}

.newsletter-title {
    margin: 0;
    font-size: 2rem;
    font-weight: 600;
}

.newsletter-subtitle {
    margin: 0.5rem 0 0;
    opacity: 0.8;
    font-size: 1rem;
}

.newsletter-body {
    padding: 2rem;
}

.newsletter-form-group {
    margin-bottom: 1.5rem;
}

.newsletter-label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: #2D3E4E;
}

.newsletter-input {
    width: 100%;
    padding: 0.75rem;
    border: 2px solid #e1e1e1;
    border-radius: 8px;
    transition: border-color 0.3s ease;
}

.newsletter-input:focus {
    border-color: #2D3E4E;
    outline: none;
}

.newsletter-button-group {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    margin-top: 2rem;
}

.newsletter-preview-btn,
.newsletter-submit-btn {
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 8px;
    font-weight: 500;
    cursor: pointer;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.newsletter-preview-btn {
    background-color: #6c757d;
    color: #fff;
}

.newsletter-submit-btn {
    background-color: #2D3E4E;
    color: #fff;
}

.newsletter-preview-btn:hover,
.newsletter-submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.newsletter-alert-success,
.newsletter-alert-danger {
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
    position: relative;
}

.newsletter-alert-success {
    background-color: #d1e7dd;
    border: 1px solid #badbcc;
    color: #0f5132;
}

.newsletter-alert-danger {
    background-color: #f8d7da;
    border: 1px solid #f5c2c7;
    color: #842029;
}

.newsletter-close-btn {
    position: absolute;
    right: 0.75rem;
    top: 50%;
    transform: translateY(-50%);
    background: transparent;
    border: none;
    color: currentColor;
    opacity: 0.7;
    cursor: pointer;
}

.newsletter-modal-header {
    background: #2D3E4E;
    color: #fff;
}

.ck-editor__editable {
    min-height: 300px;
    max-height: 500px;
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<script>
let editor;

ClassicEditor
    .create(document.querySelector('#editor'), {
        toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'outdent', 'indent', '|', 'blockQuote', 'insertTable', 'undo', 'redo'],
    })
    .then(newEditor => {
        editor = newEditor;
    })
    .catch(error => console.error(error));

document.getElementById('previewButton').addEventListener('click', function() {
    const previewModal = new bootstrap.Modal(document.getElementById('previewModal'));
    
    document.getElementById('previewContent').innerHTML = `
        <div class="d-flex justify-content-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Lädt...</span>
            </div>
        </div>
    `;
    
    previewModal.show();

    const formData = new FormData();
    formData.append('subject', document.querySelector('input[name="subject"]').value);
    formData.append('content', editor.getData());
    formData.append('_token', '{{ csrf_token() }}');

    fetch('{{ route("newsletter.preview") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'text/html',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: formData
    })
    .then(response => response.text())
    .then(html => {
        document.getElementById('previewContent').innerHTML = html;
    })
    .catch(error => {
        document.getElementById('previewContent').innerHTML = `
            <div class="alert alert-danger">
                Fehler beim Laden der Vorschau: ${error.message}
            </div>
        `;
        console.error('Preview Error:', error);
    });
});
</script>
@endpush
@endsection 