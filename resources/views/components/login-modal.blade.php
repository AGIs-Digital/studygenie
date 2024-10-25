<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="login_sec p-4 position-relative">
                    <img class="login_m1" src="{{ asset('asset/images/m1.svg') }}" alt="" loading="lazy">
                    <img class="login_m2" src="{{ asset('asset/images/m2.svg') }}" alt="" loading="lazy">
                    <img class="login_m3" src="{{ asset('asset/images/m3.svg') }}" alt="" loading="lazy">
                    <img class="login_m4" src="{{ asset('asset/images/m4.svg') }}" alt="" loading="lazy">
                    <img class="close-icon" data-bs-dismiss="modal" aria-label="Close" src="{{ asset('asset/images/ic_close.png') }}" alt="Close" loading="lazy">
                    <div class="text-center">
                        <img src="{{ asset('asset/images/Logo_(2).png') }}" width="133" height="77" alt="Logo" loading="lazy">
                    </div>
                    <br />
                    <div class="main">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab" aria-controls="login" aria-selected="true">Anmelden</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="forget-tab" data-bs-toggle="tab" data-bs-target="#forget" type="button" role="tab" aria-controls="forget" aria-selected="false">Passwort vergessen</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                                <form method="POST" action="{{ route('login.post') }}" id="loginForm">
                                    @csrf
                                    <div class="emailInput">
                                        <label class="label" for="email_login">E-Mail:</label>
                                        <input type="email" placeholder="Deine E-Mailadresse" name="email" id="email_login" class="emailLogin" autocomplete="email" required>
                                        <label class="label" for="password_login">Passwort:</label>
                                        <div class="password-field">
                                            <input type="password" placeholder="Dein Passwort" name="password" id="password_login" class="emailLogin" autocomplete="current-password" required>
                                            <span class="toggle-password" onclick="togglePasswordVisibility()">
                                                <img src="{{ asset('asset/images/eye.svg') }}" alt="Toggle Password Visibility" width="25" height="25">
                                            </span>
                                        </div>
                                        <input type="submit" value="Login" class="emailLogin">
                                        <div class="or">
                                            oder anmelden mit
                                            <a href="{{ route('google.redirect') }}" id="google-login">
                                                <img src="{{ asset('asset/images/google.svg') }}" alt="Google" loading="lazy">
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="forget" role="tabpanel" aria-labelledby="forget-tab">
                                <form method="POST" action="{{ route('password.email') }}" id="forgetForm">
                                    @csrf
                                    <div class="emailInput">
                                        <label class="label" for="email_reset_forget">E-Mail:</label>
                                        <input type="email" placeholder="Deine E-Mailadresse" name="email" id="email_reset_forget" class="emailLogin" autocomplete="email">
                                        <input type="submit" value="Zurücksetzen" class="emailLogin">
                                    </div>
                                </form>
                            </div>
                        </div>
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
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === true) {
                    window.location.href = data.redirect_url;
                } else {
                    showToast("Fehler beim Einloggen.", 'error');
                }
            })
            .catch(error => {
                console.error('Fehler:', error);
                showToast('Ein Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.', 'error');
            });
        });

        const loginModal = document.getElementById('loginModal');
        loginModal.addEventListener('hidden.bs.modal', function () {
            document.body.classList.remove('modal-open');
            const backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.remove();
            }
        });

        const forgetForm = document.getElementById('forgetForm');
        
        forgetForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(forgetForm);
            fetch('{{ route('password.email') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    showToast(data.message, 'success');
                } else {
                    showToast(data.message, 'error');
                }
            })
            .catch(error => showToast('Ein Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.', 'error'));
        });
    });
</script>
