<!DOCTYPE html>
<html lang="de">
<head>
    @include('components.head')
    <title>@yield('title', 'Default Title')</title> <!-- Dynamischer Titel -->
</head>
<body>
    @include('components.navbar')
    <div class="container">
        @yield('content')
    </div>
    @include('includes.footer')

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>