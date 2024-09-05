<!DOCTYPE html>
<html lang="de">
<head>
    @section('title', 'StudyGenie')
    @include('components.head') 
</head>

<body class="MainContainer">
    <div class="headerSpacer"></div>
    @include('components.navbar')
    @include('components.feedback')
    @include('components.arrowupbutton')
    @include('components.login-modal')
    @include('components.signup-modal')
    @include('components.tooglePasswordVisibility')

    @yield('content')

    @include('components.footer')
</body>
</html>