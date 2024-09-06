@extends('layouts.app')

@section('content')
    @include('components.tooglePasswordVisibility')
    <div class="container mt-5 d-flex justify-content-center">
        <div class="col-md-8">
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
                                <span class="toggle-password" onclick="togglePasswordVisibility()">
                                    <img src="{{ asset('asset/images/eye.svg') }}" alt="Toggle Password Visibility" width="25" height="25">
                                </span>
                            </div>
                            <div id="passwordCriteria" class="criteria-container mt-2">
                                <div class="criteria-row">
                                    <p id="lengthCriteria" class="text-danger"><span class="checkmark">✘</span> 8 Zeichen</p>
                                    <p id="uppercaseCriteria" class="text-danger"><span class="checkmark">✘</span> Großbuchstabe</p>
                                </div>
                                <div class="criteria-row">
                                    <p id="numberCriteria" class="text-danger"><span class="checkmark">✘</span> Zahl</p>
                                    <p id="specialCharCriteria" class="text-danger"><span class="checkmark">✘</span> Sonderzeichen</p>
                                </div>
                            </div>
                            <br />
                            <label class="label" for="password_confirm">Passwort bestätigen:</label>
                            <div class="password-field">
                                <input type="password" name="password_confirmation" id="password_confirm" class="emailLogin">
                            </div>

                            <input type="submit" value="Passwort zurücksetzen" class="emailLogin">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .reset-card {
            margin: 0 auto; /* Zentriert die Karte horizontal */
            float: none; /* Entfernt das floaten */
            padding: 0;
        }

        .reset-card-header {
            background-color: #d8dcdf; /* Hintergrundfarbe für die Überschrift */
            padding: 10px; /* Innenabstand */
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const resetForm = document.querySelector('form[action="{{ route('password.update') }}"]');

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
                        $('#loginModal').modal('show');
                    } else {
                        const errorMessages = data.errors.join('<br>');
                        showToast(errorMessages, 'error');
                    }
                })
                .catch(error => showToast('Ein Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.', 'error'));
            });

            function togglePasswordVisibility() {
                const passwordFields = document.querySelectorAll('.password-field input');
                const toggleIcons = document.querySelectorAll('.toggle-password img');

                passwordFields.forEach((field, index) => {
                    const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
                    field.setAttribute('type', type);
                    toggleIcons[index].src = type === 'password' ? "{{ asset('asset/images/eye.svg') }}" : "{{ asset('asset/images/eye-off.svg') }}";
                });
            }

            function updateCriteria() {
                const criteria = [
                    { id: 'specialCharCriteria', regex: /[!@#$%^&*(),.?":{}|<>]/ },
                    { id: 'uppercaseCriteria', regex: /[A-Z]/ },
                    { id: 'numberCriteria', regex: /[0-9]/ },
                    { id: 'lengthCriteria', regex: /.{8,}/ }
                ];

                const password = document.getElementById('password_reset').value;

                criteria.forEach(({ id, regex }) => {
                    const element = document.getElementById(id);
                    if (regex.test(password)) {
                        element.classList.remove('text-danger');
                        element.classList.add('text-success');
                        element.querySelector('.checkmark').textContent = '✔';
                    } else {
                        element.classList.remove('text-success');
                        element.classList.add('text-danger');
                        element.querySelector('.checkmark').textContent = '✘';
                    }
                });
            }

            document.getElementById('password_reset').addEventListener('input', updateCriteria);
        });
    </script>
@endsection
