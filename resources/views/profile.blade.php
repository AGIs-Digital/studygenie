<!DOCTYPE html>
<html lang="de">

<head>
    <script src="https://www.paypal.com/sdk/js?client-id=Ae9G4SKK4gDuWY0Yw7J_6irXsfPepGSudxvUktzRQlYbdnOKTaDp2xmuC1mCWS6GTvalCH9Owt-HUl4S&currency=EUR"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @section('title', Auth::check() ? auth()->user()->name . ' - Profil' : 'Profil')
    @include('components.head')
</head>

@include('components.navbar')
@include('components.feedback')

<body class="MainContainer">
    <div class="headerSpacer"><br><br></div>
    @include('components.tooglePasswordVisibility')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h1>
                    {{ auth()->user()->name }} - Einstellungen
                    <img src="{{ asset('asset/images/profile.svg') }}">
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
        <form method="POST" action="{{ route('change.password') }}">
            @csrf
            <div class="content">
                <!-- Abonnement-Pläne -->
                <div class="row">
                    @include('components.plancards-section')
                </div>
                <br />

                <!-- Kontoeinstellungen und Passwort ändern -->
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <button id="changePasswordButton" type="button" class="btn btn-outline-primary mx-2">Passwort ändern</button>
                        <button id="deleteAccountButton" type="button" class="btn btn-outline-danger mx-2">Account löschen</button>
                    </div>

                    <div id="passwordChangeForm" class="hidden mt-4">
                        <div class="row changePasswordForm">
                            <div class="col-md-4">
                                <div class="emailField">
                                    <label class="label" for="old_password">Altes Passwort?</label>
                                    <input type="password" id="old_password" name="old_password" class="emailLogin">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="emailField">
                                    <label class="label" for="password">Neues Passwort:</label>
                                    <div class="password-field">
                                        <input type="password" id="password" name="password" class="emailLogin">
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
                                    <label class="label" for="new_confirm_password">Neues Passwort?</label>
                                    <input type="password" id="new_confirm_password" name="new_confirm_password" class="emailLogin">
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

    <!-- Zahlungs Modal -->
    <div class="modal fade" id="payment_modal" tabindex="-1" aria-labelledby="payment_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="button_payment_box d-flex justify-content-center align-items-center" style="height: 100%;">
                        <div id="paypal-button-container"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

                    if (plan === 'silber') {
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

                const password = document.getElementById('password').value;

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

            document.getElementById('password').addEventListener('input', updateCriteria);

            document.getElementById('changePasswordButton').addEventListener('click', function () {
                document.getElementById('passwordChangeForm').classList.toggle('hidden');
            });
        });

        // Bestätigungen
        function confirmSilberStatus(url) {
            $('#confirmSilberModal').modal('show');
            document.getElementById('confirmSilberButton').onclick = function () {
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ subscription_name: 'silber' })
                }).then(response => {
                    if (response.ok) {
                        showToast('Du hast jetzt den Silber Status', 'success');
                        localStorage.setItem('subscription_updated', 'true'); // Setze nur bei erfolgreicher Antwort
                        location.reload();
                    } else {
                        console.error('Failed to update subscription');
                    }
                }).catch(error => console.error('Error:', error));
            };
        }

        function confirmDeletion() {
            return confirm('ACHTUNG: Diese Aktion wird Ihren Account und alle damit verbundenen Daten dauerhaft löschen. Diese Aktion kann nicht rückgängig gemacht werden. Sind Sie sicher, dass Sie fortfahren möchten?');
        }
    </script>
</body>

</html>