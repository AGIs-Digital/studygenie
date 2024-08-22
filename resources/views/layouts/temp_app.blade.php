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
    @include('components.scripts')

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>