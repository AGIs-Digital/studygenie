<!DOCTYPE html>
<html lang="de">

<head>
    @section('title', 'Admin Feedback')
    @include('components.head')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('asset/css/HomePage.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery hinzufügen -->
</head>

@include('components.navbar')
<body class="MainContainer">
    <div class="headerSpacer"></div>
    <div class="container mt-5">
        <h1>Feedbacks</h1>
        <form method="GET" action="{{ route('admin.feedbacks.index') }}" class="mb-4">
            <div class="form-row">
                <div class="col">
                    <select name="type" class="form-control">
                        <option value="">Alle Typen</option>
                        <option value="Bug" {{ request('type') == 'Bug' ? 'selected' : '' }}>Bug</option>
                        <option value="Lob" {{ request('type') == 'Lob' ? 'selected' : '' }}>Lob</option>
                        <option value="Kritik" {{ request('type') == 'Kritik' ? 'selected' : '' }}>Kritik</option>
                        <option value="Frage" {{ request('type') == 'Frage' ? 'selected' : '' }}>Frage</option>
                    </select>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary">Filtern</button>
                </div>
            </div>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><a href="{{ route('admin.feedbacks.index', ['sort' => 'id', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}">ID</a></th>
                    <th><a href="{{ route('admin.feedbacks.index', ['sort' => 'type', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}">Typ</a></th>
                    <th><a href="{{ route('admin.feedbacks.index', ['sort' => 'text', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}">Text</a></th>
                    <th><a href="{{ route('admin.feedbacks.index', ['sort' => 'page', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}">Seite</a></th>
                    <th><a href="{{ route('admin.feedbacks.index', ['sort' => 'created_at', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}">Erstellt am</a></th>
                    <th>Kill</th>
                </tr>
            </thead>
            <tbody>
                @forelse($feedbacks as $feedback)
                    <tr id="feedback-item-{{ $feedback->id }}">
                        <td>{{ $feedback->id }}</td>
                        <td>{{ $feedback->type }}</td>
                        <td>{{ $feedback->text }}</td>
                        <td>{{ $feedback->page }}</td>
                        <td>{{ $feedback->created_at }}</td>
                        <td>
                            <button class="btn delete-feedback" data-id="{{ $feedback->id }}"><i class="fas fa-trash-alt text-danger"></i></button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Keine Feedbacks gefunden</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $feedbacks->links() }}

        <!-- Toast Container -->
        <div class="toast-container position-fixed top-50 start-50 translate-middle p-3" style="z-index: 11">
            <div id="deleteToast" class="toast align-items-center text-white bg-success bg-opacity-75 border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        Das Feedback wurde erfolgreich gelöscht.
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script src="{{ asset('asset/js/toast.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.delete-feedback').click(function() {
            var deleteId = $(this).data('id');
            $.ajax({
                url: route('admin.feedbacks.destroy', deleteId),
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        $('#feedback-item-' + deleteId).fadeOut('slow', function() {
                            $(this).remove();
                        });
                        showToast('Das Feedback wurde erfolgreich gelöscht.');
                    } else {
                        alert('Fehler: ' + response.message);
                    }
                },
                error: function(xhr) {
                    alert('Ein Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.');
                }
            });
        });
    });
</script>