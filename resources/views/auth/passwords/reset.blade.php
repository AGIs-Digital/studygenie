<!DOCTYPE html>
<html lang="de">
<head>
    @section('title', 'Passwort zurücksetzen')
    @include('components.head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
@include('components.navbar')
@include('components.feedback')
<body class="MainContainer">
    <div class="headerSpacer"></div>
        @include('components.login-modal')
        @include('components.tooglePasswordVisibility')
    @include('components.signup-modal')


    <div class="container mt-5">
            <div class="reset-card">
                <div class="card-header reset-card-header">{{ __('Passwort zurücksetzen') }}</div>
                <div class="card-body reset-card-body">
                    <form method="POST" action="{{ route('password.update') }}" id="passwordChangeForm">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <label class="label" for="email_reset">E-Mail:</label>
                            <input type="email" placeholder="Deine E-Mailadresse" name="email" id="email_reset" class="emailLogin" autocomplete="email" value="{{ $email ?? old('email') }}">

                        <div class="emailField">
                            
                            <label class="label" for="new_password">Passwort:</label>
                            <div class="password-field">
                                <input type="password" id="new_password" name="new_password" class="emailLogin">
                                <span class="toggle-password" onclick="togglePasswordVisibility()">
                                    <img src="{{ asset('asset/images/eye.svg') }}" alt="Toggle Password Visibility" width="25" height="25">
                                </span>
                            </div>

                            <div id="passwordCriteria" class="criteria-container">
                                <div class="criteria-row">
                                    <span id="lengthCriteria" class="text-danger">
                                        8 Zeichen + Großbuchstabe + Zahl + Sonderzeichen
                                    </span>
                                
                                </div>

                            </div>
                        </div>

                        <br />
                        <div class="emailField">
                            <div class="password-field">
                                <label class="label" for="new_password_confirm">Neues Passwort bestätigen:</label>
                                <input type="password" name="new_password_confirm" id="new_password_confirm" class="emailLogin">
                            </div>
                        </div>
                        <button type="submit" class="emailLogin">Passwort zurücksetzen</button>
                    </form>
                </div>
            </div>
        </div>

    <footer class="fixed-bottom">
        @include('components.footer')
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const passwordField = document.getElementById('new_password');
            const confirmPasswordField = document.getElementById('new_password_confirm');
            
            if (!passwordField || !confirmPasswordField) {
                console.error('Password fields not found');
                return;
            }

            document.getElementById('passwordChangeForm').addEventListener('submit', function (e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                formData.set('password', formData.get('new_password'));
                formData.set('password_confirmation', formData.get('new_password_confirm'));

                fetch('{{ route('password.update') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        showToast('Passwort wurde erfolgreich zurückgesetzt', 'success');
                        setTimeout(() => {
                            window.location.href = '/';
                        }, 1500);
                    } else {
                        showToast(data.message || 'Ein Fehler ist aufgetreten', 'error');
                    }
                })
                .catch(error => {
                    showToast('Ein Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.', 'error');
                });
            });
        });
    </script>
</body>
</html>
