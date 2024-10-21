<!DOCTYPE html>
<html lang="de">
<head>
    @section('title', 'Passwort zurücksetzen')
    @include('components.head')
</head>

<body class="MainContainer">
    <div class="headerSpacer"></div>
    @include('components.navbar')
    @include('components.feedback')
    @include('components.arrowupbutton')

    @guest
        @include('components.login-modal')
        @include('components.signup-modal')
        @include('components.tooglePasswordVisibility')
    @endguest

    <main class="blog_sec">
        <div class="container">
            <div class="reset-card">
                <div class="card-header reset-card-header">{{ __('Passwort zurücksetzen') }}</div>
                <div class="card-body reset-card-body">
                    <form method="POST" action="{{ route('password.update') }}" id="resetForm">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="emailInput">
                            <label class="label" for="email_reset">E-Mail:</label>
                            <input type="email" placeholder="Deine E-Mailadresse" name="email" id="email_reset" class="emailLogin" autocomplete="email">

                            <label class="label" for="password_reset">Passwort:</label>
                            <div class="password-field">
                                <input type="password" placeholder="Neues Passwort" name="password" id="password_reset" class="emailLogin">
                                <span class="toggle-password" onclick="togglePasswordVisibility(this)">
                                    <img src="{{ asset('asset/images/eye.svg') }}" alt="Toggle Password Visibility" width="25" height="25">
                                </span>
                            </div>

                            <div id="passwordCriteria" class="criteria-container mt-2">
                                <div class="criteria-row">
                                    <span id="lengthCriteria" class="text-danger">
                                        <span class="checkmark">✘</span> 8 Zeichen
                                    </span><br>
                                    <span id="uppercaseCriteria" class="text-danger"><span class="checkmark">✘</span> Großbuchstabe</span><br>
                                </div>
                                <div class="criteria-row">
                                    <span id="numberCriteria" class="text-danger"><span class="checkmark">✘</span> Zahl</span><br>
                                    <span id="specialCharCriteria" class="text-danger"><span class="checkmark">✘</span> Sonderzeichen</span><br>
                                </div>
                            </div>

                            <br />
                            <label class="label" for="password_confirm">Passwort bestätigen:</label>
                            <div class="password-field">
                                <input type="password" name="password_confirmation" id="password_confirm" class="emailLogin">
                            </div>

                            <input type="submit" value="Passwort zurücksetzen" class="emailLogin" id="submitButton" disabled>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    @include('components.footer')
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const resetForm = document.getElementById('resetForm');
            const passwordField = document.getElementById('password_reset');
            const submitButton = document.getElementById('submitButton');

            resetForm.addEventListener('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(resetForm);
                fetch('{{ route('password.update') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        showToast('Passwort erfolgreich zurückgesetzt.', 'success');
                        window.location.href = data.redirect;
                    } else {
                        const errorMessages = data.errors.join('<br>');
                        showToast(errorMessages, 'error');
                    }
                })
                .catch(() => showToast('Ein Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.', 'error'));
            });

            function updateCriteria() {
                const criteria = [
                    { id: 'lengthCriteria', regex: /.{8,}/, text: '8 Zeichen' },
                    { id: 'uppercaseCriteria', regex: /[A-Z]/, text: 'Großbuchstabe' },
                    { id: 'numberCriteria', regex: /[0-9]/, text: 'Zahl' },
                    { id: 'specialCharCriteria', regex: /[!@#$%^&*(),.?":{}|<>]/, text: 'Sonderzeichen' }
                ];

                const password = passwordField.value;
                let allCriteriaMet = true;

                criteria.forEach(({ id, regex, text }) => {
                    const element = document.getElementById(id);
                    if (regex.test(password)) {
                        element.className = 'text-success';
                        element.innerHTML = '<span class="checkmark">✔</span> ' + text;
                    } else {
                        element.className = 'text-danger';
                        element.innerHTML = '<span class="checkmark">✘</span> ' + text;
                        allCriteriaMet = false;
                    }
                });

                submitButton.disabled = !allCriteriaMet;
            }

            passwordField.addEventListener('input', updateCriteria);
            updateCriteria(); // Initialer Check
        });

        function togglePasswordVisibility(element) {
            const passwordField = element.closest('.password-field').querySelector('input');
            const img = element.querySelector('img');
            if (passwordField && img) {
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    img.src = "{{ asset('asset/images/eye-off.svg') }}";
                } else {
                    passwordField.type = 'password';
                    img.src = "{{ asset('asset/images/eye.svg') }}";
                }
            } else {
                console.warn('Passwortfeld oder Bild nicht gefunden.');
            }
        }
    </script>
</body>
</html>
