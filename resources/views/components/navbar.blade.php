<header class="headerContainer navContainer">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">
                    <img src="{{ asset('asset/images/logo.png') }}" width="90" height="48" alt="StudyGenie Logo">
                </a>
                <button class="navbar-toggler navbar navbar-light" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0 CenterAnchorTagsContainer">
                        <li class="nav-item">
                            <a class="nav-link anchor {{ request()->is('/') ? 'active' : '' }}" aria-current="page" href="/">Home</a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a class="nav-link anchor {{ request()->is('tools') ? 'active' : '' }}" href="/tools">Tools</a>
                            </li>
                            <li class="nav-item profile_u" id="userprofile">
                                <a class="nav-link anchor {{ request()->is('profile') ? 'active' : '' }}" href="/profile">Profil</a>
                            </li>
                            <li class="nav-item archive" id="archive">
                                <a class="nav-link anchor {{ request()->is('archive') ? 'active' : '' }}" href="/archive">Archiv</a>
                            </li>
                            @if(Auth::user()->is_admin)
                                <li class="nav-item">
                                    <a class="nav-link anchor {{ request()->is('admin/feedbacks') ? 'active' : '' }}" href="{{ route('admin.feedbacks.index') }}">Admin Dashboard</a>
                                </li>
                            @endif
                        @endauth
                    </ul>
                    <div class="rightContainer">
                        @auth
                            <div class="logOutbutton">
                                <img style="cursor: pointer" src="{{ asset('asset/images/LogOut.svg') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();" alt="Log Out">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                            </div>
                        @else
                            <button class="plancardButton" data-bs-toggle="modal" data-bs-target="#loginModal" id="loginButton">Log In</button>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>