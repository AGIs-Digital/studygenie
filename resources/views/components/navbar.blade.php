<header class="mainNavContainer">
    <div class="navContainer">
        <!-- Logo Bereich -->
        <div class="logoContainer">
            <a href="/">
                <img id="logo" src="{{ asset('asset/images/logo.png') }}" width="90" height="48" alt="StudyGenie Logo" loading="lazy">
            </a>
        </div>
        <div class="linkContainer">
            <a class="nav-link anchor {{ request()->is('/') ? 'active' : '' }}" aria-current="page" href="/">Home</a>
            @auth
                <a class="nav-link anchor {{ request()->is('tools') ? 'active' : '' }}" href="/tools">Tools</a>
                <a class="nav-link anchor {{ request()->is('profile') ? 'active' : '' }}" href="/profile">Profil</a>
                <a class="nav-link anchor {{ request()->is('archive') ? 'active' : '' }}" href="/archive">Archiv</a>
                @if(Auth::user()->is_admin)
                    <a class="nav-link anchor {{ request()->is('admin/feedbacks') ? 'active' : '' }}" href="{{ route('admin.feedbacks.index') }}">Admin Dashboard</a>
                @endif
            @endauth
        </div>
        <div class="buttonContainer">
            @auth
                <div class="logOutbutton">
                    <img style="cursor: pointer" src="{{ asset('asset/images/LogOut.svg') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();" alt="Log Out">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                </div>
            @else
                <button class="registerButton border-light-animation" data-bs-toggle="modal" data-bs-target="#signupModal" id="registerButton">Registrieren</button>
                <button class="loginButton" data-bs-toggle="modal" data-bs-target="#loginModal" id="loginButton">Log In</button>
            @endauth
        </div>
        <div class="burger-menu">☰</div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const burgerMenu = document.querySelector('.burger-menu');
        const navContainer = document.querySelector('.navContainer');
        burgerMenu.addEventListener('click', function() {
            navContainer.classList.toggle('open');
        });
    });
</script>
