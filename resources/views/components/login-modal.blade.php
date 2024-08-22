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
                            <a id="signupAnchor" data-bs-toggle="modal" data-bs-target="#signupModal" class="loginAnchor">Account erstellen</a>
                        </div>
                        <form method="POST" action="{{ route('login.post') }}" id="loginForm">
                            @csrf
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

<script src="{{ asset('asset/js/toast.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const loginForm = document.getElementById('loginForm');
        
        loginForm.addEventListener('submit', function(event) {
            event.preventDefault();
            
            const formData = new FormData(loginForm);
            fetch('{{ route('login.post') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (!data.status) {
                    showToast(data.errors.join(', '), 'error');
                } else {
                    window.location.href = data.redirect_url;
                }
            })
            .catch(error => showToast('Ein Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.', 'error'));
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const loginModal = document.getElementById('loginModal');
        const signupModal = document.getElementById('signupModal');

        loginModal.addEventListener('hidden.bs.modal', function () {
            document.body.classList.remove('modal-open');
            const backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.remove();
            }
        });

        signupModal.addEventListener('hidden.bs.modal', function () {
            document.body.classList.remove('modal-open');
            const backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.remove();
            }
        });
    });
</script>