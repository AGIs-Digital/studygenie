<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="login_sec p-4 position-relative">
                    <img class="login_m1" src="{{ asset('asset/images/m1.svg') }}" alt=""
                        loading="lazy"> <img class="login_m2" src="{{ asset('asset/images/m2.svg') }}"
                        alt="" loading="lazy"> <img class="login_m3"
                        src="{{ asset('asset/images/m3.svg') }}" alt="" loading="lazy">
                    <img class="login_m4" src="{{ asset('asset/images/m4.svg') }}" alt=""
                        loading="lazy"> <img class="close-icon" data-bs-dismiss="modal" aria-label="Close"
                        src="{{ asset('asset/images/ic_close1.png') }}" alt="Close" loading="lazy">
                    <div class="text-center">
                        <img src="{{ asset('asset/images/Logo_(2).png') }}" width="133" height="77"
                            alt="Logo" loading="lazy">
                    </div>
                    <div class="main">
                        <form method="POST" action="{{ route('register.post') }}" id="registerForm">
                            @csrf <br />

                            <div class="emailInput">
                                <div id="errors-list" class="mx-auto"></div>
                                <div class="emailField">
                                    <label class="label" for="name">Name:</label> <input type="text"
                                        placeholder="Wie heißt du?" name="name" id="name_register"
                                        class="emailLogin" autocomplete="name" required>
                                </div>

                                <div class="emailField">
                                    <label class="label" for="email">E-Mail:</label> <input type="email"
                                        placeholder="Deine E-Mailadresse" name="email" id="email_register"
                                        class="emailLogin" autocomplete="email" required>

                                </div>
                                <label class="label" for="password">Passwort:</label>
                                <div class="password-field">
                                    <input type="password" id="password_register" name="password"
                                        placeholder="Dein Wunschpasswort" class="emailLogin" required>
                                    <span class="toggle-password" onclick="togglePasswordVisibility()">
                                        <img src="{{ asset('asset/images/eye.svg') }}"
                                            alt="Toggle Password Visibility" width="25" height="25">
                                    </span>
                                </div>
                                <div id="passwordCriteria" class="criteria-container mt-2">
                                    <div class="criteria-row">
                                        <p id="lengthCriteria" class="text-danger"><span class="checkmark">✔</span> 8 Zeichen</p>
                                        <p id="uppercaseCriteria" class="text-danger"><span class="checkmark">✔</span> 1 Großbuchstabe</p>
                                    </div>
                                    <div class="criteria-row">
                                        <p id="numberCriteria" class="text-danger"><span class="checkmark">✔</span> 1 Zahl</p>
                                        <p id="specialCharCriteria" class="text-danger"><span class="checkmark">✔</span> 1 Sonderzeichen</p>
                                    </div>
                                </div>

                                <input type="submit" value="Registrieren" class="emailLogin">
                                <div class="or">
                                    oder registrieren mit
                                    <a href="{{ url('login/google') }}">
                                        <img src="{{ asset('asset/images/google.svg') }}" alt="Google"
                                            loading="lazy">
                                    </a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>