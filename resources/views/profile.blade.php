<!DOCTYPE html>
<html lang="de">

<head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://www.paypal.com/sdk/js?client-id={{ config('services.paypal.client_id') }}&vault=true&intent=subscription&components=applepay" data-sdk-integration-source="button-factory"></script>
    @section('title', Auth::check() ? auth()->user()->name . ' - Profil' : 'Profil')
    @include('components.head')
</head>

@include('components.navbar')
@include('components.feedback')

<body class="MainContainer">
    <div class="headerSpacer"><br><br></div>
    @include('components.tooglePasswordVisibility')

    <div class="mainContent container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h1 class="d-flex align-items-center justify-content-center flex-wrap">
                    <img class="img-fluid" style="max-height: 70px; width: auto;" src="{{ asset('asset/images/blitzneu.png') }}" alt="Blitz">
                    <span class="mx-2 text-center">{{ auth()->user()->name }} - Einstellungen</span>
                    <img class="img-fluid" style="max-height: 70px; width: auto;" src="{{ asset('asset/images/blitzneu.png') }}" alt="Blitz">
                </h1>
            </div>
        </div>

        <!-- Fehler und Erfolgsmeldungen anzeigen -->
        @foreach ($errors->all() as $error)
            <p class="text-danger">{{ $error }}</p>
        @endforeach

        @if(Session::has('success'))
            <div class="alert alert-success mt-4">
                <strong>{{ Session::get('success') }}</strong>
            </div>
        @endif

        @if(Session::has('error'))
            <div class="alert alert-danger mt-4">
                <strong>{{ Session::get('error') }}</strong>
            </div>
        @endif

        <!-- Passwort ändern Formular -->
        <form id="passwordChangeForm" method="POST" action="{{ route('change.password') }}">
            @csrf
            <div class="content">
                <!-- Abonnement-Pläne -->
                <div class="row">
                    @include('components.plancards-section')
                </div>

                <!-- Kontoeinstellungen und Passwort ändern -->
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <button id="changePasswordButton" type="button" class="btn btn-outline-primary mx-2">Passwort ändern</button>
                        <button id="deleteAccountButton" type="button" class="btn btn-outline-danger mx-2">Account löschen</button>
                    </div>

                    <div id="passwordChangeFormFields" class="hidden mt-4">
                        <div class="row changePasswordForm">
                            <div class="col-md-4">
                                <div class="emailField">
                                    <label class="label" for="old_password">Altes Passwort?</label>
                                    <input type="password" id="old_password" name="old_password" class="emailLogin">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="emailField">
                                    <label class="label" for="new_password">Neues Passwort:</label>
                                    <div class="password-field">
                                        <input type="password" id="new_password" name="new_password" class="emailLogin">
                                        <span class="toggle-password" onclick="togglePasswordVisibility()">
                                            <img src="{{ asset('asset/images/eye.svg') }}" alt="Toggle Password Visibility" width="25" height="25">
                                        </span>
                                    </div>

                                    <div id="passwordCriteria" class="criteria-container mt-2">
                                        <div class="criteria-row">
                                            <span id="lengthCriteria" class="text-danger"><span class="checkmark">✘</span> 8 Zeichen</span><br>
                                            <span id="uppercaseCriteria" class="text-danger"><span class="checkmark">✘</span> Großbuchstabe</span><br>
                                        </div>
                                        <div class="criteria-row">
                                            <span id="numberCriteria" class="text-danger"><span class="checkmark">✘</span> Zahl</span><br>
                                            <span id="specialCharCriteria" class="text-danger"><span class="checkmark">✘</span> Sonderzeichen</span><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="emailField">
                                    <div class="password-field">
                                        <label class="label" for="new_confirm_password">Neues Passwort bestätigen:</label>
                                        <input type="password" id="new_confirm_password" name="new_confirm_password" class="emailLogin">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary mt-2">Änderung speichern</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @include('components.footer')

    <!-- Account löschen Modal -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAccountModalLabel">Account löschen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Bist du sicher, dass dein Account und alle damit verbundenen Daten dauerhaft gelöscht werden sollen? Das kann nicht rückgängig gemacht werden!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
                    <form method="POST" action="{{ route('user.destroy', ['user' => $user->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Account löschen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('asset/js/toast.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // PayPal Button Rendering
            function renderPayPalButton(route, plan) {
                paypal.Buttons({
                    createOrder: function (data, actions) {
                        return fetch(route, {
                            method: 'post',
                            headers: {
                                'content-type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ plan_id: plan })
                        }).then(res => res.json())
                            .then(subscriptionData => {
                                if (subscriptionData.plan_id) {
                                    return subscriptionData.plan_id;
                                } else {
                                    console.error('Subscription creation failed:', subscriptionData);
                                }
                            }).catch(err => console.error('createSubscription error:', err));
                    },
                    onApprove: function (data, actions) {
                        showToast('Aboplan erfolgreich erstellt');
                        $("#payment_modal").modal('hide');
                        location.reload();
                    }
                }).render('#paypal-button-container');
            }

            // Event Listener
            document.querySelectorAll('.plancardButton').forEach(button => {
                button.addEventListener('click', function (event) {
                    event.preventDefault();
                    const plan = button.getAttribute('data-paypal-plan');
                    const route = button.getAttribute('data-paypal-route');

                    if (plan === 'Silber') {
                        confirmSilberStatus(route);
                    } else if (plan) {
                        renderPayPalButton(route, plan);
                        $("#payment_modal").modal('show');
                    }
                });
            });

            document.getElementById('deleteAccountButton').addEventListener('click', function () {
                $("#deleteAccountModal").modal('show');
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

                const password = document.getElementById('new_password').value;

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

            document.getElementById('new_password').addEventListener('input', updateCriteria);

            document.getElementById('changePasswordButton').addEventListener('click', function () {
                document.getElementById('passwordChangeFormFields').classList.toggle('hidden');
            });

            document.getElementById('passwordChangeForm').addEventListener('submit', function (e) {
                e.preventDefault();

                const form = document.getElementById('passwordChangeForm');
                const formData = new FormData(form);

                fetch('{{ route('change.password') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        showToast(data.message, 'success');
                        document.getElementById('passwordChangeFormFields').classList.add('hidden');
                    } else {
                        showToast(data.message, 'error');
                    }
                })
                .catch(error => {
                    showToast('Ein Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.', 'error');
                });
            });
        });

        // Bestätigungen
        function confirmSilberStatus(url) {
            $('#confirmSilberModal').modal('show');
            const confirmButton = document.getElementById('confirmSilberButton');
            if (!confirmButton) {
                console.error('Confirm button not found');
                return;
            }
            confirmButton.onclick = function () {
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ subscription_name: 'Silber' })
                }).then(response => {
                    if (response.ok) {
                        showToast('Du hast jetzt wieder den Silber Status', 'success');
                        localStorage.setItem('subscription_updated', 'true');
                        location.reload();
                    } else {
                        console.error('Fehler beim Aktualisieren des Abonnements');
                    }
                }).catch(error => console.error('Fehler:', error));
            };
        }

        function confirmDeletion() {
            return confirm('ACHTUNG: Diese Aktion wird Ihren Account und alle damit verbundenen Daten dauerhaft löschen. Diese Aktion kann nicht rückgängig gemacht werden. Sind Sie sicher, dass Sie fortfahren möchten?');
        }
    </script>
</body>

</html>
