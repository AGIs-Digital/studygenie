<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="login_sec p-4 position-relative">
                        <img class="login_m1" src="{{ asset('asset/images/m1.svg') }}" alt="" loading="lazy">
                        <img class="login_m2" src="{{ asset('asset/images/m2.svg') }}" alt="" loading="lazy">
                        <img class="login_m3" src="{{ asset('asset/images/m3.svg') }}" alt="" loading="lazy">
                        <img class="login_m4" src="{{ asset('asset/images/m4.svg') }}" alt="" loading="lazy">
                        <img class="close-icon" data-bs-dismiss="modal" aria-label="Close" src="{{ asset('asset/images/ic_close1.png') }}" alt="Close" loading="lazy">
                                               <div class="text-center">
                            <img src="{{ asset('asset/images/Logo_(2).png') }}" width="133" height="77" alt="Logo" loading="lazy">
                        </div>
                        <br />
                        <div class="main">
                            <div class="text-center">
                                <span id="haveaccountSpan">Kein Account?</span>
                                <a id="signupAnchor" class="loginAnchor" data-bs-toggle="modal" data-bs-target="#signupModal">Account anlegen</a>
                            </div>
                            <form method="POST" action="{{ route('login.post') }}" id="loginForm">
                                @csrf
                                <div id="errors-list2"></div>
                                <div class="emailInput">
                                    <div class="emailField">
                                        <label class="label" for="email">E-Mail:</label>
                                        <input type="email" placeholder="Deine E-Mailadresse" name="email" id="email_login" class="emailLogin" autocomplete="email" required>
                                    </div>
                                    <label class="label" for="password">Passwort:</label>
                                    <div class="password-field">
                                        <input type="password" placeholder="Dein Passwort" name="password" id="password_login" class="emailLogin" autocomplete="current-password" required>
                                        <span class="toggle-password" onclick="togglePasswordVisibility()">
                                            <img src="{{ asset('asset/images/eye.svg') }}" alt="Toggle Password Visibility" width="25" height="25">
                                        </span>
                                    </div>
                                    <div id="errors-list2"></div>
                                    <input type="submit" value="Login" class="emailLogin">
                                    <div class="or">
                                        oder anmelden über
                                        <a href="{{ url('login/google') }}" id="google-login">
                                            <img src="{{ asset('asset/images/google.svg') }}" alt="Google" loading="lazy">
                                        </a>
                                    </div>
                                    <div class="forgot-password text-center">
                                        <a href="#" id="forgotPasswordLink">Passwort vergessen?</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>