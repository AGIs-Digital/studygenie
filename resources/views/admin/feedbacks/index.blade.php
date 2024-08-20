<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Feedbacks</title>
    @include('includes.head')
    <link rel="stylesheet" href="{{ asset('asset/css/HomePage.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
@include('includes.header')
<body class="MainContainer">
    <div class="headerSpacer"></div>
    <div class="container mt-5">
        <h1>Feedbacks</h1>
        <form method="GET" action="{{ route('admin.feedbacks.index') }}" class="mb-4">
            <div class="form-row">
                <div class="col">
                    <select name="page" class="form-control">
                        <option value="">Alle Seiten</option>
                        @foreach($pages as $page)
                            <option value="{{ $page->page }}" {{ request('page') == $page->page ? 'selected' : '' }}>{{ $page->page }}</option>
                        @endforeach
                    </select>
                </div>
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
                    <th>ID</th>
                    <th>Typ</th>
                    <th>Text</th>
                    <th>Seite</th>
                    <th>Erstellt am</th>
                </tr>
            </thead>
            <tbody>
                @forelse($feedbacks as $feedback)
                    <tr>
                        <td>{{ $feedback->id }}</td>
                        <td>{{ $feedback->type }}</td>
                        <td>{{ $feedback->text }}</td>
                        <td>{{ $feedback->page }}</td>
                        <td>{{ $feedback->created_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Keine Feedbacks gefunden</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $feedbacks->links() }}
    </div>
</body>
</html>