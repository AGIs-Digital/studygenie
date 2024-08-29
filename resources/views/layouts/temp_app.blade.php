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
    SKRIPTE!!
</body>
</html>