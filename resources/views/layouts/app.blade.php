<!DOCTYPE html>
<html lang="de">
<head>
    @section('title', 'StudyGenie')
    @include('components.head')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
 
</head>

<body class="MainContainer">
    <div class="headerSpacer"></div>
    @include('components.navbar')
    @include('components.feedback')
    @include('components.login-modal')
    @include('components.signup-modal')

    @yield('content')

    @include('components.footer')
</body>
</html>