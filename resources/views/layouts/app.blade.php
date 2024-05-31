<!DOCTYPE html>
<html lang="de">
<head>
    @include('includes.head')
    <title>@yield('title', 'Default Title')</title> <!-- Dynamischer Titel -->
</head>
<body>
    @include('includes.header')
    <div class="container">
        @yield('content')
    </div>
    @include('includes.footer')
</body>
</html>
